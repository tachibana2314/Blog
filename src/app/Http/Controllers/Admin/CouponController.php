<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\Http\Requests\UpdateCouponRequest;
use App\Repositories\CouponRepositoryInterface;
use App\Models\Coupon;
use Storage;
use App\Models\Product;
use App\Models\CouponSearch;

class CouponController extends Controller
{
    public function __construct(CouponRepositoryInterface $couponRepository)
    {
        $this->couponRepository = $couponRepository;
    }

    public function index(Request $request)
    {
        $coupon = new Coupon;
        $search = new CouponSearch();
        $params = $request->query();

        $coupon = $this->couponRepository->search($search->fill($params))
            ->sortable()
            ->orderBy('status', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.coupon.index', [
            'title' => 'クーポン管理',
            'coupon' => $coupon,
            'search' => $search,
        ]);
    }

    public function add()
    {
        $all_products = Product::pluck('name', 'id')->toArray();
        return view('admin.coupon.add.index', [
            'title' => 'クーポン追加',
            'all_products' => $all_products,
        ]);
    }

    public function store(CouponRequest $request)
    {
        $coupon = new Coupon;
        //postデータ取得
        $data = $request->all();
        //画像保存
        $request->has('barcode');
        $disk = Storage::disk('s3');
        $file = $request->file('barcode');
        // s3に保存。
        $path = $disk->put('barcode', $file, 'public');
        $data['barcode'] = $path;

        $coupon->fill($data)->save();


        return redirect()->route('admin.coupon')->with('message', "クーポンを追加しました。");;
    }


    public function detail(Coupon $coupon)
    {
        if($coupon->barcode){
            $url = Storage::disk('s3')->url($coupon->barcode);
        }else{
            $url = null;
        }
        return view('admin.coupon.detail.index', [
            'title' => 'クーポン詳細',
            'coupon' => $coupon,
            'url' => $url,
        ]);
    }

    public function edit(Coupon $coupon)
    {
        $coupon = Coupon::find($coupon->id);
        $all_products = Product::pluck('name', 'id')->toArray();
        if($coupon->barcode){
            $url = Storage::disk('s3')->url($coupon->barcode);
        }else{
            $url = null;
        }
        return view('admin.coupon.detail.edit.index', [
            'title' => 'クーポン情報編集',
            'coupon' => $coupon,
            'all_products' => $all_products,
            'url' => $url,
        ]);
    }

    public function update(Coupon $coupon, UpdateCouponRequest $request)
    {
        $data = $request->all();
        //画像保存
        $disk = Storage::disk('s3');
        if ($request->has('barcode')) {
            // 既存のs3写真を削除
            $image = $coupon->barcode;
            $disk->delete('barcode', $image);
            $file = $request->file('barcode');
            // s3に保存。
            $path = $disk->put('barcode', $file, 'public');
            $data['barcode'] = $path;
        }

        //バーコード画像保存
        if($request->filled('delete_flg')){
            $image = $coupon->barcode;
            $disk->delete('barcode', $image);
            $data['barcode'] = null;
        }

        $coupon->fill($data)->save();

        return redirect()->route('admin.coupon.detail', $coupon)->with('message', "クーポン情報を更新しました。");
    }

    public function delete($id)
    {
        $coupon = Coupon::find($id);
        $image = $coupon->barcode;
        $disk = Storage::disk('s3');
        $disk->delete('barcode', $image);
        $coupon->delete($id);
        return redirect()->route('admin.coupon')->with('message', "クーポン情報を削除しました");
    }

    public function couponExport()
    {
        $this->couponRepository->couponExport();
    }
}
