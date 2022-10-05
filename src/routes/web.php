<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 読み込みファイルのhttps化
if (config('app.env') === 'staging' || config('app.env') === 'live') {
    URL::forceScheme('https');
}

// メール確認関連のルーティング
Auth::routes(['verify' => true]);

//メール認証の社員だけに見せるページ
Route::get('register/verify/{token}', 'Admin\RegisterController@showForm')->name('admin.member.register');
Route::post('register/verify/{token}', 'Admin\RegisterController@firstUpdate')->name('admin.member.register');

// ログイン
// Route::group(['middleware' => [
//     'App\Http\Middleware\AdminIpMiddleware',
// ]], function() {
//     Route::get('admin/login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
//     Route::post('admin/login', 'Admin\Auth\LoginController@login')->name('admin.login');
// });
// ip制限解除
Route::get('admin/login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
Route::post('admin/login', 'Admin\Auth\LoginController@login')->name('admin.login');

Route::get('admin/logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');


// プライバシーポリシー
Route::get('privacy', 'HomeController@privacy')->name('home.privacy');

// ユニバーサルリンク
Route::get('links', 'HomeController@links')->name('home.links');

/*
|--------------------------------------------------------------------------
| 管理者ページ
|--------------------------------------------------------------------------
*/
Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'namespace' => 'Admin',
    'middleware' => 'auth:admin'
], function () {
    // トップページ
    Route::get('home', 'DashboardController@index')->name('home')->middleware('verified');
    // 会員数推移グラフデータ取得
    Route::get('_getGraphDataForCustomerCount', 'DashboardController@_getGraphDataForCustomerCount')
        ->name('_getGraphDataForCustomerCount');

    // 仮登録ページ
    Route::post('register', 'RegisterController@register')->name('register');
    // 顧客管理
    Route::get('user', 'UserController@index')->name('user');
    Route::get('user/add', 'UserController@add')->name('user.add');
    Route::get('user/userExport', 'UserController@userExport')->name('user.userExport');
    Route::post('user/add', 'UserController@store');
    Route::get('user/detail/{user}', 'UserController@detail')->name('user.detail');
    Route::get('user/edit/{user}', 'UserController@edit')->name('user.edit');
    Route::post('user/edit/{user}', 'UserController@update');
    Route::delete('user/delete/{user}', 'UserController@delete')->name('user.delete');


    // 商品管理
    Route::get('product', 'ProductController@index')->name('product');
    Route::get('product/productExport', 'ProductController@productExport')->name('product.productExport');
    Route::get('product/add', 'ProductController@add')->name('product.add');
    Route::post('product/add', 'ProductController@store');
    Route::get('product/detail/{product}', 'ProductController@detail')->name('product.detail');
    Route::get('product/edit/{product}', 'ProductController@edit')->name('product.edit');
    Route::post('product/edit/{product}', 'ProductController@update');
    Route::delete('product/delete/{product}', 'ProductController@delete')->name('product.delete');
    Route::get('product/order', 'ProductController@order')->name('product.order');
    Route::post('product/order/store', 'ProductController@orderStore')->name('product.orderStore');
    Route::get('product/qrGenerate/{product}', 'ProductController@qrGenerate')->name('product.qrGenerate');

    // ポイント景品管理
    Route::group([
        'prefix' => 'point_gift',
        'as' => 'point_gift.',
    ], function () {
        Route::get('', 'PointGiftController@index')->name('index');
        Route::get('add', 'PointGiftController@add')->name('add');
        Route::post('add', 'PointGiftController@store');
        Route::get('detail/{point_gift}', 'PointGiftController@detail')->name('detail');
        Route::get('edit/{point_gift}', 'PointGiftController@edit')->name('edit');
        Route::post('edit/{point_gift}', 'PointGiftController@update');
        Route::delete('delete/{point_gift}', 'PointGiftController@delete')->name('delete');
    });

    // ポイント管理
    Route::group([
        'prefix' => 'point',
        'as' => 'point.',
    ], function () {
        Route::get('', 'PointController@index')->name('index');
    });

    // 店舗管理
    Route::get('store', 'StoreController@index')->name('store');
    Route::get('store/add', 'StoreController@add')->name('store.add');
    Route::post('store/add', 'StoreController@store');
    Route::get('store/detail/{store}', 'StoreController@detail')->name('store.detail');
    Route::get('store/edit/{store}', 'StoreController@edit')->name('store.edit');
    Route::post('store/edit/{store}', 'StoreController@update');
    Route::delete('store/delete/{store}', 'StoreController@delete')->name('store.delete');

    // クーポン管理
    Route::get('coupon', 'CouponController@index')->name('coupon');
    Route::get('coupon/add', 'CouponController@add')->name('coupon.add');
    Route::post('coupon/add', 'CouponController@store');
    Route::get('coupon/detail/{coupon}', 'CouponController@detail')->name('coupon.detail');
    Route::get('coupon/edit/{coupon}', 'CouponController@edit')->name('coupon.edit');
    Route::post('coupon/edit/{coupon}', 'CouponController@update');
    Route::delete('coupon/delete/{coupon}', 'CouponController@delete')->name('coupon.delete');
    Route::get('coupon/couponExport', 'CouponController@couponExport')->name('coupon.couponExport');


    // お知らせ管理
    Route::get('information', 'InformationController@index')->name('information');
    Route::get('information/add', 'InformationController@add')->name('information.add');
    Route::post('information/add', 'InformationController@store');
    Route::get('information/detail/{information}', 'InformationController@detail')->name('information.detail');
    Route::get('information/edit/{information}', 'InformationController@edit')->name('information.edit');
    Route::post('information/edit/{information}', 'InformationController@update');
    Route::delete('information/delete/{information}', 'InformationController@delete')->name('information.delete');

    // スライド管理
    Route::get('slide', 'SlideController@index')->name('slide');
    Route::get('slide/add', 'SlideController@add')->name('slide.add');
    Route::post('slide/add', 'SlideController@store');
    Route::get('slide/detail/{slide}', 'SlideController@detail')->name('slide.detail');
    Route::get('slide/edit/{slide}', 'SlideController@edit')->name('slide.edit');
    Route::post('slide/edit/{slide}', 'SlideController@update');
    Route::delete('slide/delete/{slide}', 'SlideController@delete')->name('slide.delete');
    // スライド並び替え
    Route::post('slide', 'SlideController@sortSlideDone')->name('slide');


    // 管理者管理
    Route::get('member', 'MemberController@index')->name('member');
    Route::get('member/add', 'MemberController@add')->name('member.add');
    Route::get('member/detail/{admin}', 'MemberController@detail')->name('member.detail');
    Route::get('member/edit/{admin}', 'MemberController@edit')->name('member.edit');
    Route::post('member/edit/{admin}', 'MemberController@update');
    Route::delete('member/delete/{admin}', 'MemberController@delete')->name('member.delete');

    // スタンプクーポン管理
    Route::get('stamp', 'StampController@index')->name('stamp');
    Route::get('stamp/addCoupon', 'StampController@addCoupon')->name('stamp.addCoupon');
    Route::post('stamp/addCoupon', 'StampController@store');
    Route::get('stamp/addCard', 'StampController@addCard')->name('stamp.addCard');
    Route::post('stamp/addCard', 'StampController@storeCard');
    Route::get('stamp/coupon_detail/{stamp_coupon}', 'StampController@couponDetail')->name('stamp.coupon_detail');
    Route::get('stamp/card_detail/{stamp_card}', 'StampController@cardDetail')->name('stamp.card_detail');
    Route::get('stamp/coupon_edit/{stamp_coupon}', 'StampController@couponEdit')->name('stamp.coupon_edit');
    Route::post('stamp/coupon_edit/{stamp_coupon}', 'StampController@couponUpdate');
    Route::get('stamp/card_edit/{stamp_card}', 'StampController@cardEdit')->name('stamp.card_edit');
    Route::post('stamp/card_edit/{stamp_card}', 'StampController@cardUpdate');
    Route::delete('stamp/delete/{stamp_coupon}', 'StampController@couponDelete')->name('stamp.coupon_delete');
    Route::delete('stamp/card_delete/{stamp_card}', 'StampController@cardDelete')->name('stamp.card_delete');
    Route::get('stamp/stampExport', 'StampController@stampExport')->name('stamp.stampExport');
});
