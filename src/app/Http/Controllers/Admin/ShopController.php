<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ShopRequest;
use App\Http\Controllers\Controller;
use App\Models\GpsLogs;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Repositories\DocumentRepositoryInterface;
use App\Repositories\ShopRepositoryInterface;
use App\Models\Shop;
use App\Models\ShopImage;
use App\Models\Staff;
use App\Models\MShopGroup;
use App\Models\VirtualShopUser;
use DB;
use Storage;
use Illuminate\Support\Carbon;
use Image;

class ShopController extends Controller
{
    public $is_virtual = false;

    public function __construct(
        DocumentRepositoryInterface $document_repository,
        ShopRepositoryInterface $shop_repository
    ) {
        $this->document_repository = $document_repository;
        $this->shop_repository = $shop_repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //店舗一覧取得
        $shops = $this->shop_repository
            ->search($request, $this->is_virtual)
            ->withCount('virtural_shop_users')
            ->paginate(50);

        //マスタ・リスト取得
        $shopTypes = Shop::SHOP_TYPE_LIST;
        $mShopGroups = $this->shop_repository->getMShopGroups();

        return view('admin.shop.index', [
            'shops' => $shops,
            'request' => $request,
            'shopTypes' => $shopTypes,
            'mShopGroups' => $mShopGroups,
            'is_virtual' => $this->is_virtual,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shop = new Shop;

        $mShopGroups = $this->shop_repository->getMShopGroups();

        return view('admin.shop.create', [
            'shop' => $shop,
            'mShopGroups' => $mShopGroups,
            'is_virtual' => $this->is_virtual,
            'shop' => $shop,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShopRequest $request)
    {
        $shop = $this->shop_repository->store($request);
        if (!$shop) {
            return redirect()
                ->back()
                ->withInput()
                ->with('status', 'failed')
                ->with('message', '登録に失敗しました。');
        }
        if (!$this->is_virtual) {
            return redirect()
                ->route('admin.shop.show', $shop)
                ->with('status', 'success')
                ->with('message', '店舗を登録しました。');
        } else {
            return redirect()
                ->route('admin.virtual_shop.show', $shop)
                ->with('status', 'success')
                ->with('message', '店舗を登録しました。');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        $user = Auth::user();
        if (!$user->can('view', $shop)){
            return redirect()->route('admin.home')
                ->with('error', '閲覧権限がありません。');
        }
        $shop = Shop::where('id', $shop->id)
            ->select('shops.*')
            ->selectRaw('X(geometry) as lng')
            ->selectRaw('Y(geometry) as lat')
            ->first();

        $mShopGroups = $this->shop_repository->getMShopGroups();

        if (!$this->is_virtual) {
            //従業員取得
            $shopStaffs = Staff::query()
                ->with('shop')
                ->where('shop_id', $shop['id'])
                ->get();
        } else {
            //申込者
            $shopStaffs = VirtualShopUser::query()
                ->with('shop')
                ->where('shop_id', $shop['id'])
                ->get();
        }

        // GPSログ
        $gpsLogs = GpsLogs::where('shop_id', $shop->id)
            ->select('gps_logs.*')
            ->selectRaw('X(geometry) as lng')
            ->selectRaw('Y(geometry) as lat')
            ->get();

        return view('admin.shop.show', [
            'shop' => $shop,
            'shopStaffs' => $shopStaffs,
            'mShopGroups' => $mShopGroups,
            'is_virtual' => $this->is_virtual,
            'gpsLogs' => $gpsLogs,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //店舗取得
        $shop = Shop::find($id);
        
        $user = Auth::user();
        if (!$user->can('view', $shop)){
            return redirect()->route('admin.home')
                ->with('error', '閲覧権限がありません。');
        }
        $mShopGroups = $this->shop_repository->getMShopGroups();

        return view('admin.shop.edit', [
            'shop' => $shop,
            'mShopGroups' => $mShopGroups,
            'is_virtual' => $this->is_virtual,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShopRequest $request, Shop $shop)
    {
        $shop = $this->shop_repository->update($shop, $request);
        if (!$shop) {
            return redirect()
                ->back()
                ->withInput()
                ->with('status', 'failed')
                ->with('message', '更新に失敗しました。');
        }
        if (!$this->is_virtual) {
            return redirect()
                ->route('admin.shop.index', $shop)
                ->with('status', 'success')
                ->with('message', '店舗を更新しました。');
        } else {
            return redirect()
                ->route('admin.virtual_shop.show', $shop)
                ->with('status', 'success')
                ->with('message', '店舗を更新しました。');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function geolocation(Request $request, Shop $shop)
    {
        $longitude = is_numeric($request->get('lng')) ? $request->get('lng') : null;
        $latitude = is_numeric($request->get('lat')) ? $request->get('lat') : null;

        if ($longitude && $latitude) {
            $shop->geometry = \DB::raw("(GeomFromText('POINT({$longitude} {$latitude})'))");
            $shop->save();
        }

        return redirect()
            ->back()
            ->with('status', 'success')
            ->with('message', '座標を登録しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Shop $shop)
    {
        if (!$shop->isVirtual()) {
            $shop->delete();
            return redirect()
                ->route('admin.shop.index')
                ->with('status', 'success')
                ->with('message', "店舗を削除しました。");
        }else{
            $shop->delete();
            return redirect()
                    ->route('admin.virtual_shop.index')
                    ->with('status', 'success')
                    ->with('message', "店舗を削除しました。");
        }
    }
}
