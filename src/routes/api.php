<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('Api')
    ->name('api.')
    ->group(function () {

        // クーポン
        Route::group([
            'prefix' => 'coupon',
        ], function () {
            // 一覧
            Route::match(['get'], 'index', 'CouponController@index');
            // クーポン使用
            Route::match(['post'], 'onUse', 'CouponController@onUse');
        });

        // 商品
        Route::group([
            'prefix' => 'product',
        ], function () {
            // 商品一覧
            Route::match(['get'], 'index', 'ProductController@index');
            // お気に入り
            Route::match(['post'], 'onFavorite', 'ProductController@onFavorite');
            // お気に入り一覧
            Route::match(['get'], 'favorite', 'ProductController@favorite');
        });

        // ユーザー
        Route::group([
            'prefix' => 'user',
        ], function () {
            // ログインユーザー取得
            Route::match(['get'], 'me', 'UserController@me');
            // サインイン
            Route::match(['get'], 'signIn', 'UserController@signIn');
            // サインアップ
            Route::match(['post'], 'signUp', 'UserController@signUp');
            // アップデート
            Route::match(['post'], 'update', 'UserController@update');
            // 退会
            Route::match(['post'], 'quit', 'UserController@quit');
        });

        // ホーム
        Route::match(['get'], 'home', 'HomeController@index');
        Route::match(['get'], 'product', 'HomeController@getProduct');

        // お知らせ
        Route::group([
            'prefix' => 'information',
        ], function () {
            // 一覧
            Route::match(['get'], 'index', 'InformationController@index');
            // 詳細
            Route::match(['post'], 'onRead', 'InformationController@onRead');
            // 未読があるかチェック
            Route::match(['get'], 'ifAllRead', 'InformationController@ifAllRead');
        });

        // 店舗
        Route::match(['get'], 'store', 'StoreController@index')->name('api.store.index');

        // スタンプクーポン
        Route::group([
            'prefix' => 'stampCoupon',
        ], function () {
            // 一覧
            Route::match(['get'], 'index', 'StampCouponController@index');
            Route::match(['get'], 'index2', 'StampCouponController@index2');
            // ユーザースタンプHistory情報
            Route::match(['get'], 'getStampHistory', 'StampCouponController@getStampHistory');
            // スタンプカード情報
            Route::match(['get'], 'getStampCard', 'StampCouponController@getStampCard');
            // QR情報送信
            Route::match(['get'], 'qrReader', 'StampCouponController@qrReader');
            // スタンプ登録
            Route::match(['post'], 'getStamp', 'StampCouponController@getStamp');
            // クーポン使用
            Route::match(['post'], 'onUse', 'StampCouponController@onUse');
            // スタンプ使用履歴情報
            Route::match(['get'], 'checkScan', 'StampCouponController@checkScan');
            // スタンプ登録
            Route::match(['post'], 'couponLog', 'StampCouponController@couponLog');
            // スタンプ登録
            Route::match(['get'], 'getStampLog', 'StampCouponController@getStampLog');

            // スタンプ削除
            Route::match(['post'], 'deleteStamp', 'StampCouponController@deleteStamp');
        });

        // ポイント
        Route::group([
            'prefix' => 'point',
        ], function () {
            // 一覧
            Route::match(['get'], 'index', 'PointController@index');
            // 合計
            Route::match(['get'], 'total', 'PointController@total');
        });
        
        // ポイント景品
        Route::group([
            'prefix' => 'point_gift',
        ], function () {
            // 一覧
            Route::match(['get'], 'index', 'PointGiftController@index');
        });

        // 購入履歴
        Route::group([
            'prefix' => 'purchase',
        ], function () {
            // 一覧
            Route::match(['get'], '/index', 'PurchaseController@index');
        });
    });
