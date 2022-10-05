<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StampCardRequest;
use App\Http\Requests\StampCouponRequest;
use App\Repositories\StampRepositoryInterface;
use App\Models\StampCoupon;
use App\Models\StampCard;
use Storage;
use App\Models\StampCouponSearch;
use App\Models\StampCardSearch;

class StampController extends Controller
{
    public function __construct(StampRepositoryInterface $stampRepository)
    {
        $this->stampRepository = $stampRepository;
    }

    public function index(Request $request)
    {
        $stamp_coupon = new StampCoupon;
        $search_coupon = new StampCouponSearch();
        $params = $request->query();
        $stamp_coupon = $this->stampRepository->search($search_coupon->fill($params))
        ->orderBy('created_at', 'ASC')
        ->paginate(5);

        $stamp_card = new StampCard;
        $search_card = new StampCardSearch();
        $stamp_card = $this->stampRepository->searchCard($search_card->fill($params))
        ->orderBy('created_at', 'ASC')
        ->paginate(5);

        return view('admin.stamp.index', [
            'title' => 'スタンプクーポン管理',
            'stamp_coupon' => $stamp_coupon,
            'search_coupon' => $search_coupon,
            'stamp_card' => $stamp_card,
            'search_card' => $search_card,
        ]);
    }

    public function addCoupon()
    {
        $all_card = StampCard::pluck('title', 'id')->toArray();

        return view('admin.stamp.add.coupon', [
            'title' => 'クーポン追加',
            'all_card' => $all_card,
        ]);
    }

    public function store(StampCouponRequest $request)
    {
        $stamp_coupon = new StampCoupon;
        //postデータ取得
        $data = $request->all();
        // S3
        $disk = Storage::disk('s3');
        //クーポン画像保存
        if( $request->has('path_main')){
            $file_path_main = $request->file('path_main');
            $path_main = $disk->put('stamp_coupon', $file_path_main, 'public');
            $data['path_main'] = $path_main;
        }

        //バーコード画像保存
        if( $request->has('barcode')){
            $file = $request->file('barcode');
            $path_barcode = $disk->put('stamp_barcode', $file, 'public');
            $data['barcode'] = $path_barcode;
        }
        $stamp_coupon->fill($data)->save();

        return redirect()->route('admin.stamp')->with('message', "クーポンを追加しました。");;
    }

    public function addCard()
    {
        $all_coupon = StampCoupon::pluck('title', 'id')->toArray();
        return view('admin.stamp.add.card', [
            'title' => 'スタンプカード追加',
            'all_coupon' => $all_coupon,
        ]);
    }

    public function storeCard(StampCardRequest $request)
    {
        $stamp_card = new StampCard;
        $data = $request->all();
        $stamp_card->fill($data)->save();

        return redirect()->route('admin.stamp')->with('message', "クーポンを追加しました。");;
    }

    public function cardDetail(StampCard $stamp_card)
    {
        return view('admin.stamp.detail.card', [
            'title' => 'スタンプカード詳細',
            'stamp_card' => $stamp_card,
        ]);
    }


    public function couponDetail(StampCoupon $stamp_coupon)
    {
        $stamp_card = StampCard::where('id', $stamp_coupon->card_id)->first();
        if($stamp_coupon->path_main){
            $main_url = Storage::disk('s3')->url($stamp_coupon->path_main);
        }else{
            $main_url = null;
        }
        if($stamp_coupon->barcode){
            $barcode_url = Storage::disk('s3')->url($stamp_coupon->barcode);
        }else{
            $barcode_url = null;
        }
        return view('admin.stamp.detail.coupon', [
            'title' => 'クーポン詳細',
            'stamp_coupon' => $stamp_coupon,
            'stamp_card' => $stamp_card,
            'main_url' => $main_url,
            'barcode_url' => $barcode_url,
        ]);
    }

    public function cardEdit(StampCard $stamp_card)
    {
        $all_coupon = StampCoupon::pluck('title', 'id')->toArray();
        return view('admin.stamp.detail.edit.card', [
            'title' => 'スタンプカード編集',
            'stamp_card' => $stamp_card,
            'all_coupon' => $all_coupon,
        ]);
    }

    public function cardUpdate(StampCard $stamp_card, StampCardRequest $request)
    {
        $data = $request->all();
        $stamp_card->fill($data)->save();

        return redirect()->route('admin.stamp.card_detail', $stamp_card)->with('message', "スタンプカード情報を更新しました。");
    }

    public function cardDelete($stamp_card)
    {
        $stamp_card = StampCard::where('id', $stamp_card)->first();
        $stamp_card->delete();
        return redirect()->route('admin.stamp')->with('message', "カード情報を削除しました");
    }

    public function couponEdit(StampCoupon $stamp_coupon)
    {
        $all_card = StampCard::pluck('title', 'id')->toArray();
        if($stamp_coupon->path_main){
            $main_url = Storage::disk('s3')->url($stamp_coupon->path_main);
        }else{
            $main_url = NULL;
        }
        if($stamp_coupon->barcode){
            $barcode_url = Storage::disk('s3')->url($stamp_coupon->barcode);
        }else{
            $barcode_url = null;
        }
        return view('admin.stamp.detail.edit.coupon', [
            'all_card' => $all_card,
            'stamp_coupon' => $stamp_coupon,
            'main_url' => $main_url,
            'barcode_url' => $barcode_url,
            'title' => 'クーポン情報編集',
        ]);
    }

    public function couponUpdate(StampCoupon $stamp_coupon, Request $request)
    {
        $data = $request->all();
        $disk = Storage::disk('s3');
        //画像保存
        if ($request->has('path_main')) {
            // 既存のs3写真を削除
            $image_main = $stamp_coupon->path_main;
            $disk->delete('stamp_coupon', $image_main);
            $file_main = $request->file('path_main');
            // s3に保存。
            $path_main = $disk->put('stamp_coupon', $file_main, 'public');
            $data['path_main'] = $path_main;
        }
        if($request->filled('delete_flg')){
            $image_main = $stamp_coupon->path_main;
            $disk->delete('stamp_coupon', $image_main);
            $data['path_main'] = null;
        }

        if ($request->has('barcode')) {
            // 既存のs3写真を削除
            $image_barcode = $stamp_coupon->barcode;
            $disk->delete('stamp_barcode', $image_barcode);
            $file_barcode = $request->file('barcode');
            // s3に保存。
            $path_barcode = $disk->put('barcode', $file_barcode, 'public');
            $data['barcode'] = $path_barcode;
        }

        $stamp_coupon->fill($data)->save();

        return redirect()->route('admin.stamp.coupon_detail', $stamp_coupon)->with('message', "クーポン情報を更新しました。");
    }

    public function couponDelete($stamp_coupon)
    {
        $stamp_coupon = StampCoupon::where('id', $stamp_coupon)->first();
        $disk = Storage::disk('s3');
        // S3写真削除
        $image_main = $stamp_coupon->path_main;
        $disk->delete('stamp_coupon', $image_main);

        $image_sub = $stamp_coupon->path_sub;
        $disk->delete('stamp_coupon', $image_sub);

        $image_barcode = $stamp_coupon->barcode;
        $disk->delete('stamp_barcode', $image_barcode);
        $stamp_coupon->delete();
        return redirect()->route('admin.stamp')->with('message', "クーポン情報を削除しました");
    }

    public function stampExport()
    {
        $this->stampRepository->stampExport();
    }
}
