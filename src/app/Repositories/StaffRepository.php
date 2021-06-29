<?php

namespace App\Repositories;


use App\Models\Staff;
use App\Repositories\DocumentRepositoryInterface;
use Illuminate\Support\Carbon;
use Goodby\CSV\Export\Standard\Exporter;
use Goodby\CSV\Export\Standard\ExporterConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Hash;
use Storage;
use Image;
use Illuminate\Support\Facades\Auth;

class StaffRepository implements StaffRepositoryInterface
{
    public function __construct(
        DocumentRepositoryInterface $document_repository
    ) {
        $this->document_repository = $document_repository;
    }

    public function search(Request $request)
    {

        $query = Staff::select('staffs.*');

        if ($request->get('keyword')) {
            $search_array = space_array_conversion($request->get('keyword'));
            foreach ($search_array as $search_word) {
                $query->where(function($q) use ($search_word) {
                    $q->where('staffs.last_name', 'like', "%$search_word%")
                        ->orWhere('staffs.first_name', 'like', "%$search_word%")
                        ->orWhere(DB::raw("CONCAT(staffs.last_name, staffs.first_name)"), 'like', "%$search_word%")
                        ->orWhere('staffs.last_name_kana', 'like', "%$search_word%")
                        ->orWhere('staffs.first_name_kana', 'like', "%$search_word%")
                        ->orWhere(DB::raw("CONCAT(staffs.last_name_kana, staffs.first_name_kana)"), 'like', "%$search_word%");
                });
            }
        }


        if ($request->get('shop_id')) {
            $query = $query->where('staffs.shop_id', $request->get('shop_id'));
        }

        if ($request->get('trans_month')) {
            $query = $query->where('staffs.shop_id', $request->get('shop_id'));
        }

        if (Auth::user()->authority == \App\Models\Staff::AUTHORITY_3){
            $query = $query->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('jurisdiction_shops')
                    ->whereRaw('staffs.shop_id = jurisdiction_shops.shop_id')
                    ->where('jurisdiction_shops.staff_id', Auth::id());
            });
        }

        return $query;
    }

    public function store(Request $request)
    {
        $staff = new Staff;
        $data = $request->all();
         //画像保存
        if($request->hasFile('photo')){
            $disk = Storage::disk('s3');
            $file = $request->file('photo');
            // s3に保存。
            $path = $disk->put('staffs', $file, 'public');
            $data['photo'] = $path;
        }
        $staff->approval1_staff_id = data_get($data, 'approval_staff_id.0');
        $staff->approval2_staff_id = data_get($data, 'approval_staff_id.1');
        $staff->approval3_staff_id = data_get($data, 'approval_staff_id.2');

        $data['password'] = Hash::make($data['password']);

        $staff->fill($data)->save();

        // 管轄店舗の登録
        $staff->jurisdictionShops()->delete();
        if(!empty(data_get($data, 'shop_ids')) ){
            $newJurisdictionShops = [];
            foreach (data_get($data, 'shop_ids') as $shop_id){
                $newJurisdictionShops[] = new \App\Models\JurisdictionShop(['shop_id' => $shop_id]);
            }
            $staff->jurisdictionShops()->saveMany($newJurisdictionShops);
        }

        return $staff;
    }

    public function update(Staff $staff, Request $request)
    {
        $data = $request->all();
        // dd($data);
         //画像保存
        if($request->hasFile('photo')){
            $disk = Storage::disk('s3');
            $file = $request->file('photo');
            // s3に保存。
            $path = $disk->put('staffs', $file, 'public');
            $data['photo'] = $path;
        }

        if (!isset($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($data['password']);
        }
        $staff->approval1_staff_id = data_get($data, 'approval_staff_id.0');
        $staff->approval2_staff_id = data_get($data, 'approval_staff_id.1');
        $staff->approval3_staff_id = data_get($data, 'approval_staff_id.2');

        $staff->fill($data)->save();

        // 管轄店舗の登録
        $staff->jurisdictionShops()->delete();
        if(!empty(data_get($data, 'shop_ids')) ){
            $newJurisdictionShops = [];
            foreach (data_get($data, 'shop_ids') as $shop_id){
                $newJurisdictionShops[] = new \App\Models\JurisdictionShop(['shop_id' => $shop_id]);
            }
            $staff->jurisdictionShops()->saveMany($newJurisdictionShops);
        }
        
        return $staff;
    }

    public function destroy(Staff $staff)
    {
        $staff->delete();

        return $staff;
    }

    public function get(Request $request)
    {
        if ($request->id) {
            $staff = Staff::where('id', $request->id)->first();
        }

        return $staff;
    }


    public function show(Staff $staff, Request $request)
    {
        $query = $staff->select('staffs.*')
                ->groupBy('staffs.id')
                ->leftJoin('expense_histories', 'staffs.id', '=', 'expense_histories.staff_id')
                ->leftJoin('commuting_histories', 'staffs.id', '=', 'commuting_histories.staff_id')
                ->where('staffs.id',  $staff['id']);


        if ($request->get('shop_id')) {
            $query = $query->where('staffs.shop_id', $request->get('shop_id'));
        }

        return $query;
    }


    public function export($session)
    {
        if($session){
            $staffs = $this->query($session)
                        ->orderBy('staff_code', 'asc')
                        ->get();
        }else{
            $staffs = Staff::select('staffs.*')
                        ->orderBy('staff_code', 'asc')
                        ->get();
        }

        // ファイル名
        $file_name = '従業員リスト_' . \Carbon\Carbon::now()->format('Y-m-d');
        // HTTPヘッダ定義
        date_default_timezone_set('Asia/Tokyo');
        header('Content-Disposition: attachment; filename*=UTF-8\'\''.rawurlencode($file_name).'.csv');
        header('Cache-Control: public');
        header('Pragma: public');
        header('Content-Type: application/octet-stream');
        // エクスポートデータの生成
        $data = [];
        $fields = [];
       // セッションデータあれば
        foreach ($staffs as $key => $staff) {
            if ($key == 0) :
                // 項目を追加
                $data[0] = [
                    '',
                    '社員番号',
                    '氏名',
                    '氏名（ふりがな）',
                    '性別',
                    '生年月日',
                    '雇用形態',
                    '所属店舗',
                    '在職区分',
                    '権限',
                    '役職',
                    '郵便番号',
                    '住所',
                    'email',
                    '電話番号',
                    '入社日',
                    '雇用保険番号',
                    '年金番号',
                    '口座名義カナ',
                    '銀行名',
                    '銀行コード',
                    '支店名',
                    '支店コード',
                    '口座種別',
                    '口座番号',
                ];
                // 項目の取得
                $fields = [
                    '順番',
                    '社員番号',
                    '氏名',
                    '氏名（ふりがな）',
                    '性別',
                    '生年月日',
                    '雇用形態',
                    '所属店舗',
                    '在職区分',
                    '権限',
                    '役職',
                    '郵便番号',
                    '住所',
                    'email',
                    '電話番号',
                    '入社日',
                    '雇用保険番号',
                    '年金番号',
                    '口座名義カナ',
                    '銀行名',
                    '銀行コード',
                    '支店名',
                    '支店コード',
                    '口座種別',
                    '口座番号',
                ];
            endif;

            if ($fields) :
                foreach ($fields as $l => $w) :
                    if ($w == '順番') :
                        $data[$key + 1][$l] = $key+1;
                    endif;
                    if ($w == '社員番号') :
                        $data[$key + 1][$l] = $staff['staff_code'];
                    endif;
                    if ($w == '氏名') :
                        $data[$key + 1][$l] = $staff['full_name'];
                    endif;
                    if ($w == '氏名（ふりがな）') :
                        $data[$key + 1][$l] = $staff['full_name_kana'];
                    endif;
                    if ($w == '性別') :
                        $data[$key + 1][$l] = $staff['gender_label'];
                    endif;
                    if ($w == '生年月日') :
                        $data[$key + 1][$l] = $staff['birthday_label'];
                    endif;
                    if ($w == '雇用形態') :
                        $data[$key + 1][$l] = $staff['employment_status_label'];
                    endif;
                    if ($w == '所属店舗') :
                        $data[$key + 1][$l] = $staff['belong_shop_name'];
                    endif;
                    if ($w == '在職区分') :
                        $data[$key + 1][$l] = $staff['enrolled_type_label'];
                    endif;
                    if ($w == '権限') :
                        $data[$key + 1][$l] = $staff['authority_label'];
                    endif;
                    if ($w == '役職') :
                        $data[$key + 1][$l] = $staff['position'];
                    endif;
                    if ($w == '郵便番号') :
                        $data[$key + 1][$l] = $staff['zipcode'];
                    endif;
                    if ($w == '住所') :
                        $data[$key + 1][$l] = $staff['address'];
                    endif;
                    if ($w == 'email') :
                        $data[$key + 1][$l] = $staff['email'];
                    endif;
                    if ($w == '電話番号') :
                        $data[$key + 1][$l] = $staff['tell'];
                    endif;
                    if ($w == '入社日') :
                        $data[$key + 1][$l] = $staff['join_date'];
                    endif;
                    if ($w == '雇用保険番号') :
                        $data[$key + 1][$l] = $staff['employment_insurance_number'];
                    endif;
                    if ($w == '年金番号') :
                        $data[$key + 1][$l] = $staff['annuity_number'];
                    endif;
                    if ($w == '口座名義カナ') :
                        $data[$key + 1][$l] = $staff['account_full_name'];
                    endif;
                    if ($w == '銀行名') :
                        $data[$key + 1][$l] = $staff['bank_name'];
                    endif;
                    if ($w == '銀行コード') :
                        $data[$key + 1][$l] = $staff['bank_code'];
                    endif;
                    if ($w == '支店名') :
                        $data[$key + 1][$l] = $staff['branch_name'];
                    endif;
                    if ($w == '支店コード') :
                        $data[$key + 1][$l] = $staff['branch_code'];
                    endif;
                    if ($w == '口座種別') :
                        $data[$key + 1][$l] = $staff['deposit_type_label'];
                    endif;
                    if ($w == '口座番号') :
                        $data[$key + 1][$l] = $staff['account_number'];
                    endif;
                endforeach;
            endif;
        }

        $config = new ExporterConfig();
        $config->setToCharset('SJIS-win')->setFromCharset('UTF-8');
        $exporter = new Exporter($config);
        $exporter->export('php://output', $data);
        exit;
    }

    // csv用
    public function query($session)
    {
        $today = Carbon::now();

        $query = Staff::select('staffs.*');

        if ($session['keyword']) {
            $search_array = space_array_conversion($session['keyword']);
            foreach ($search_array as $search_word) {
                $query->where(function($q) use ($search_word) {
                    $q->where('staffs.last_name', 'like', "%$search_word%")
                        ->orWhere('staffs.first_name', 'like', "%$search_word%")
                        ->orWhere(DB::raw("CONCAT(staffs.last_name, staffs.first_name)"), 'like', "%$search_word%")
                        ->orWhere('staffs.last_name_kana', 'like', "%$search_word%")
                        ->orWhere('staffs.first_name_kana', 'like', "%$search_word%")
                        ->orWhere(DB::raw("CONCAT(staffs.last_name_kana, staffs.first_name_kana)"), 'like', "%$search_word%");
                });
            }
        }

        if ($session['shop_id']) {
            $query = $query->where('staffs.shop_id',$session['shop_id']);
        }

        return $query;
    }

}
