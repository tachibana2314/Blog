<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\ViewComposers\LoginUserComposer;
use App\Http\ViewComposers\ContactNotification;
use App\Http\ViewComposers\DateTimeComposer;
use App\Http\ViewComposers\MExpenceAccountItemComposer;
use App\Http\ViewComposers\MTransPortationComposer;
use App\Http\ViewComposers\StaffExpenceHistoryComposer;
use App\Http\ViewComposers\StaffExpenceMasterComposer;
use App\Http\ViewComposers\StaffTransPortationMasterComposer;
use App\Http\ViewComposers\AllStaffListComposer;
use App\Http\ViewComposers\AllShopListComposer;



class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['admin.*', 'attendance.*'], LoginUserComposer::class);
        View::composer(['admin.layout._sidebar'], ContactNotification::class);
    }
}
