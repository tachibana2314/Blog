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
         //????????????
        if($request->hasFile('photo')){
            $disk = Storage::disk('s3');
            $file = $request->file('photo');
            // s3????????????
            $path = $disk->put('staffs', $file, 'public');
            $data['photo'] = $path;
        }
        $staff->approval1_staff_id = data_get($data, 'approval_staff_id.0');
        $staff->approval2_staff_id = data_get($data, 'approval_staff_id.1');
        $staff->approval3_staff_id = data_get($data, 'approval_staff_id.2');

        $data['password'] = Hash::make($data['password']);

        $staff->fill($data)->save();

        // ?????????????????????
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
         //????????????
        if($request->hasFile('photo')){
            $disk = Storage::disk('s3');
            $file = $request->file('photo');
            // s3????????????
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

        // ?????????????????????
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

        // ???????????????
        $file_name = '??????????????????_' . \Carbon\Carbon::now()->format('Y-m-d');
        // HTTP???????????????
        date_default_timezone_set('Asia/Tokyo');
        header('Content-Disposition: attachment; filename*=UTF-8\'\''.rawurlencode($file_name).'.csv');
        header('Cache-Control: public');
        header('Pragma: public');
        header('Content-Type: application/octet-stream');
        // ????????????????????????????????????
        $data = [];
        $fields = [];
       // ?????????????????????????????????
        foreach ($staffs as $key => $staff) {
            if ($key == 0) :
                // ???????????????
                $data[0] = [
                    '',
                    '????????????',
                    '??????',
                    '????????????????????????',
                    '??????',
                    '????????????',
                    '????????????',
                    '????????????',
                    '????????????',
                    '??????',
                    '??????',
                    '????????????',
                    '??????',
                    'email',
                    '????????????',
                    '?????????',
                    '??????????????????',
                    '????????????',
                    '??????????????????',
                    '?????????',
                    '???????????????',
                    '?????????',
                    '???????????????',
                    '????????????',
                    '????????????',
                ];
                // ???????????????
                $fields = [
                    '??????',
                    '????????????',
                    '??????',
                    '????????????????????????',
                    '??????',
                    '????????????',
                    '????????????',
                    '????????????',
                    '????????????',
                    '??????',
                    '??????',
                    '????????????',
                    '??????',
                    'email',
                    '????????????',
                    '?????????',
                    '??????????????????',
                    '????????????',
                    '??????????????????',
                    '?????????',
                    '???????????????',
                    '?????????',
                    '???????????????',
                    '????????????',
                    '????????????',
                ];
            endif;

            if ($fields) :
                foreach ($fields as $l => $w) :
                    if ($w == '??????') :
                        $data[$key + 1][$l] = $key+1;
                    endif;
                    if ($w == '????????????') :
                        $data[$key + 1][$l] = $staff['staff_code'];
                    endif;
                    if ($w == '??????') :
                        $data[$key + 1][$l] = $staff['full_name'];
                    endif;
                    if ($w == '????????????????????????') :
                        $data[$key + 1][$l] = $staff['full_name_kana'];
                    endif;
                    if ($w == '??????') :
                        $data[$key + 1][$l] = $staff['gender_label'];
                    endif;
                    if ($w == '????????????') :
                        $data[$key + 1][$l] = $staff['birthday_label'];
                    endif;
                    if ($w == '????????????') :
                        $data[$key + 1][$l] = $staff['employment_status_label'];
                    endif;
                    if ($w == '????????????') :
                        $data[$key + 1][$l] = $staff['belong_shop_name'];
                    endif;
                    if ($w == '????????????') :
                        $data[$key + 1][$l] = $staff['enrolled_type_label'];
                    endif;
                    if ($w == '??????') :
                        $data[$key + 1][$l] = $staff['authority_label'];
                    endif;
                    if ($w == '??????') :
                        $data[$key + 1][$l] = $staff['position'];
                    endif;
                    if ($w == '????????????') :
                        $data[$key + 1][$l] = $staff['zipcode'];
                    endif;
                    if ($w == '??????') :
                        $data[$key + 1][$l] = $staff['address'];
                    endif;
                    if ($w == 'email') :
                        $data[$key + 1][$l] = $staff['email'];
                    endif;
                    if ($w == '????????????') :
                        $data[$key + 1][$l] = $staff['tell'];
                    endif;
                    if ($w == '?????????') :
                        $data[$key + 1][$l] = $staff['join_date'];
                    endif;
                    if ($w == '??????????????????') :
                        $data[$key + 1][$l] = $staff['employment_insurance_number'];
                    endif;
                    if ($w == '????????????') :
                        $data[$key + 1][$l] = $staff['annuity_number'];
                    endif;
                    if ($w == '??????????????????') :
                        $data[$key + 1][$l] = $staff['account_full_name'];
                    endif;
                    if ($w == '?????????') :
                        $data[$key + 1][$l] = $staff['bank_name'];
                    endif;
                    if ($w == '???????????????') :
                        $data[$key + 1][$l] = $staff['bank_code'];
                    endif;
                    if ($w == '?????????') :
                        $data[$key + 1][$l] = $staff['branch_name'];
                    endif;
                    if ($w == '???????????????') :
                        $data[$key + 1][$l] = $staff['branch_code'];
                    endif;
                    if ($w == '????????????') :
                        $data[$key + 1][$l] = $staff['deposit_type_label'];
                    endif;
                    if ($w == '????????????') :
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

    // csv???
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
