<?php

namespace App\Repositories;

use App\Models\Shop;
use App\Models\ShopImage;
use App\Models\MShopGroup;
use App\Repositories\DocumentRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Storage;
use Illuminate\Support\Carbon;
use Image;
use Illuminate\Support\Facades\Auth;

class ShopRepository implements ShopRepositoryInterface
{
    public function __construct(
        DocumentRepositoryInterface $document_repository
    ) {
        $this->document_repository = $document_repository;
    }

    public function search(Request $request, $is_virtual = false)
    {
        if (!$is_virtual) {
            $query = Shop::select('shops.*')
                //バーチャル店舗除く
                ->exceptVirturalShop();
        } else {
            $query = Shop::select('shops.*')
                //バーチャル店舗
                ->virtural();
        }

        if ($request->get('keyword')) {
            $search_array = space_array_conversion($request->get('keyword'));
            foreach ($search_array as $search_word) {
                $query->where(function($q) use ($search_word) {
                    $q->where('shops.shop_id', 'like', "%$search_word%")
                        ->orWhere('shops.name', 'like', "%$search_word%")
                        ->orWhere('shops.name_abbreviation', 'like', "%$search_word%")
                        ->orWhere('shops.tel', 'like', "%$search_word%");
                });
            }
        }

        if ($request->get('shop_group_id') && !empty($request->input('shop_group_id'))) {
            $query = $query->where('shops.shop_group_id', $request->get('shop_group_id'));
        }

        if ($request->get('shop_type') && !empty($request->input('shop_type'))) {
            $query = $query->where('shops.shop_type', $request->get('shop_type'));
        }

        if (Auth::user()->authority == \App\Models\Staff::AUTHORITY_3){
            $query = $query->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('jurisdiction_shops')
                    ->whereRaw('shops.id = jurisdiction_shops.shop_id')
                    ->where('jurisdiction_shops.staff_id', Auth::id());
            });
        }


        return $query;
    }

    public function store(Request $request)
    {

        $data = $request->all();
        //画像保存
        if($request->has('main_photo')){
            $disk = Storage::disk('s3');
            $file = $request->file('main_photo');
            // s3に保存。
            $path = $disk->put('shops', $file, 'public');
            $data['main_photo'] = $path;
        }

        if($request->has('lp_photo')){
            $disk = Storage::disk('s3');
            $file = $request->file('lp_photo');
            // s3に保存。
            $path = $disk->put('shops', $file, 'public');
            $data['lp_photo'] = $path;
        }



        //データ保存
        $shop = new Shop();
        $shop->fill($request->except('_token', 'password'));
        //パスワード入力があった際
        if ($request->has('password') && !empty($request->input('password'))) {
            $shop->password = Hash::make($request->input('password'));
        }
        $shop->created_staff_id = Auth::id();
        $shop->fill($data)->save();
        return $shop;
    }

    public function update(Shop $shop, Request $request)
    {
         //画像保存
        $data = $request->all();
        if($request->hasFile('main_photo')){
            $disk = Storage::disk('s3');
            $file = $request->file('main_photo');
            // s3に保存。
            $path = $disk->put('shops', $file, 'public');
            $data['main_photo'] = $path;
        }

        if($request->hasFile('lp_photo')){
            $disk = Storage::disk('s3');
            $file = $request->file('lp_photo');
            // s3に保存。
            $path = $disk->put('shops', $file, 'public');
            $data['lp_photo'] = $path;
        }

        //データ保存
        $shop = Shop::firstOrNew(['id' => $shop->id]);
        $shop->fill($request->except('_token', 'password'));
        //パスワード入力があった際
        if ($request->has('password') && !empty($request->input('password'))) {
            $shop->password = Hash::make($request->input('password'));
        }

        $shop->updated_staff_id = Auth::id();
        $shop->fill($data)->save();

        $shop_image_data_list = $request->get('shop_images');
        if ($shop_image_data_list) {
            $order = array(0, 1, 2, 3, 4 ,5);
            $new_shop_image_data_list = array_combine($order, $shop_image_data_list);
            foreach ($new_shop_image_data_list as  $i => $shop_image_data) {
                $shop_image = new ShopImage;

                if ($shop_image_data['id']) {
                    $_shop_image = ShopImage::where('id', $shop_image_data['id'])->first();
                    if ($_shop_image) {
                        $shop_image = $_shop_image;
                    }
                }
                $shop_image_data['order'] =  ++$i;

                $shop_image->fill($shop_image_data);
                $shop_image->save();
            }
        }

        return $shop;
    }

    public function destroy(Shop $shop)
    {
    }

    public function get(Request $request)
    {
    }

    //店舗グループマスタ取得
    public function getMShopGroups()
    {
        return MShopGroup::query()
            ->orderBy('seq', 'asc')
            ->get()
            ->pluck('name', 'id')
            ->toArray();
    }
}
