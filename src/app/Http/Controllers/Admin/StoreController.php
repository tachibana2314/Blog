<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Models\Store;
use App\Models\StoreSearch;
use Illuminate\Support\Arr;
use App\Libraries\MyFunc;
use App\Repositories\StoreRepositoryInterface;
use Storage;

class StoreController extends Controller
{

    public function __construct(StoreRepositoryInterface $storeRepository)
    {
        $this->storeRepository = $storeRepository;
    }

    public function index(Request $request)
    {
        $search = new StoreSearch();
        $store = new Store;
        $params = $request->query();
        $store = $this->storeRepository->search($search->fill($params))
            ->sortable()
            ->orderBy('status', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.store.index', [
            'title' => '店舗管理',
            'store' => $store,
            'search' => $search,
        ]);
    }

    public function add()
    {
        return view('admin.store.add.index', [
            'title' => '店舗追加',
        ]);
    }

    public function store(StoreRequest $request)
    {
        $store = new Store;
        //postデータ取得
        $data = $request->all();
        //画像保存
        if($request->has('pic_path')){
            $disk = Storage::disk('s3');
            $file = $request->file('pic_path');
            // s3に保存。
            $path = $disk->put('store', $file, 'public');
            $data['pic_path'] = $path;
        }

        $store->fill($data)->save();
        return redirect()->route('admin.store')->with('message', "店舗情報を追加しました。");;
    }

    public function detail(Store $store)
    {
        $address = $store->address1 . $store->address2  . $store->address3;

        return view('admin.store.detail.index', [
            'title' => '店舗詳細',
            'store' => $store,
            'address' => $address,
        ]);
    }

    public function edit(Store $store)
    {

        return view('admin.store.detail.edit.index', [
            'title' => '店舗情報編集',
            'store' => $store,
        ]);
    }

    public function update(Store $store, StoreRequest $request)
    {
        $data = $request->all();


        //画像保存
        if ($request->has('pic_path')) {
            $disk = Storage::disk('s3');
            // 既存のS3写真を削除
            $image = $store->pic_path;
            $disk->delete('store', $image);
            $file = $request->file('pic_path');
            // s3に保存。
            $path = $disk->put('store', $file, 'public');
            $data['pic_path'] = $path;
        }

        //画像削除
        if (!$request->has('pic_path')) {
            $disk = Storage::disk('s3');
            // 既存のS3写真を削除
            $image = $store->pic_path;
            $disk->delete('store', $image);
            // DBを削除
            $data['pic_path'] = null;
        }



        if (empty($data['cafe_flg'])) {
            $data['cafe_flg'] = null;
        }
        if (empty($data['wine_flg'])) {
            $data['wine_flg'] = null;
        }
        if (empty($data['oven_flg'])) {
            $data['oven_flg'] = null;
        }

        $store->fill($data)->save();
        return redirect()->route('admin.store.detail', $store)->with('message', "店舗情報を更新しました。");
    }

    public function delete($id)
    {
        $store = Store::find($id);

        $store->delete($id);
        return redirect()->route('admin.store')->with('message', "店舗情報を削除しました");
    }
}
