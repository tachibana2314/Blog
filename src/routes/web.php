<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/content', [ContentController::class, 'index'])->name('content');
Route::get('/content/{content}', [ContentController::class, 'show'])->name('content.show');
Route::get('/carrier', [HomeController::class, 'carrier'])->name('carrier');
Route::get('/event', [HomeController::class, 'event'])->name('event');
Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');


Route::get('/dashboard', [AdminHomeController::class, 'index'])->name('admin.home');


// ログイン認証後
// Route::middleware(['auth.admin:admin'])->group(function () {
    Route::group([
        'namespace' => 'Admin',
        'prefix' => 'dashboard',
        'as' => 'admin.',
    ], function () {
        // ログアウト
        Route::get('logout', 'Auth\LoginController@logout')->name('logout');
        // ダッシュボード
        Route::view('/', 'admin.home')->name('home');

        // 顧客管理
        Route::group([
            'prefix' => 'customer',
            'as' => 'customer.',
        ], function () {
            Route::get('/', 'CustomerController@index')->name('index');
            Route::get('/', 'CustomerController@virtual')->name('virtual');
            Route::get('/new', 'CustomerController@add')->name('add');
            Route::get('/detail', 'CustomerController@show')->name('show');
            Route::get('/history/', 'CustomerController@history')->name('history');
            Route::get('/other/', 'CustomerController@other')->name('other');
            Route::get('/edit/{user}', 'CustomerController@edit')->name('edit');
        });



        // コンテンツ管理
        Route::group([
            'prefix' => 'content',
            'as' => 'content.',
        ], function () {
            Route::get('/', 'ContentController@index')->name('index');
            Route::get('/add', 'ContentController@add')->name('add');
            Route::post('/add', 'ContentController@store');
            Route::get('/edit/{content}', 'ContentController@edit')->name('edit');
            Route::post('/edit/{content}', 'ContentController@update');
            Route::delete('/destroy/{content}', 'ContentController@destroy')->name('destroy');
            Route::delete('/delete/{content}', 'ContentController@delete')->name('delete');
        });


        // 売上/入金管理
        Route::group([
            'prefix' => 'sales',
            'as' => 'sales.',
        ], function () {
            Route::get('/', 'SalesController@index')->name('index');
            Route::get('/new', 'SalesController@add')->name('create');
            Route::get('/detail/{sales}', 'SalesController@detail')->name('detail');
            Route::get('/edit/{sales}', 'SalesController@edit')->name('edit');
        });


        Route::group([
            'prefix' => 'staff',
            'as' => 'staff.',
        ], function () {
            Route::get('/', 'StaffController@index')->name('index');
            Route::group(['middleware' => 'can:admin'], function () {
                Route::get('/create', 'StaffController@create')->name('create');
                Route::post('/create', 'StaffController@store');
            });
            Route::get('/export', 'StaffController@export')->name('export');
            Route::get('/show/{staff}', 'StaffController@show')->name('show');
            Route::get('/edit/{staff}', 'StaffController@edit')->name('edit');
            Route::post('/edit/{staff}', 'StaffController@update');
            Route::post('/approvalUpdate/{staff}', 'StaffController@approvalUpdate')->name('approvalUpdate');
            Route::get('/other/{staff}', 'StaffController@other')->name('other');
            Route::post('/other/{staff}', 'StaffController@memo')->name('memo');
            Route::delete('/delete/{staff}', 'StaffController@delete')->name('delete');
            // API
            Route::get('/updateAttendance/{staff}', 'StaffController@updateAttendance')->name('updateAttendance');
            Route::get('/getAttendanceDetail/{staff}', 'StaffController@getAttendanceDetail')->name('getAttendanceDetail');
        });

        // 店舗管理
        Route::group([
            'prefix' => 'shop',
            'as' => 'shop.',
        ], function () {
            Route::get('/', 'ShopController@index')->name('index');
            Route::group(['middleware' => 'can:admin'], function () {
                Route::get('/new', 'ShopController@create')->name('create');
                Route::post('/new', 'ShopController@store');
            });
            Route::get('/show/{shop}', 'ShopController@show')->name('show');
            Route::get('/edit/{shop}', 'ShopController@edit')->name('edit');
            Route::post('/edit/{shop}', 'ShopController@update');
            Route::delete('/delete/{shop}', 'ShopController@delete')->name('delete');
            Route::get('/geolocation/{shop}', 'ShopController@geolocation')->name('geolocation');
        });

        // お問い合わせ管理
        Route::group([
            'prefix' => 'contact',
            'as' => 'contact.',
        ], function () {
            Route::get('/', 'ContactController@index')->name('index');
            Route::get('/new', 'ContactController@add')->name('create');
            Route::post('/status/{contact}', 'ContactController@status')->name('status');
            Route::get('/detail/{contact}', 'ContactController@detail')->name('detail');
            Route::get('/edit/{contact}', 'ContactController@edit')->name('edit');
            Route::delete('/delete/{contact}', 'ContactController@delete')->name('delete');
        });

        // 画像アップロード
        Route::post('admin/uploadImage/{pathname}', 'ImageController@upload')->name('uploadImage');
        Route::post('admin/uploadDocument/{pathname}', 'DocumentController@upload')->name('uploadDocument');
    });
// });
