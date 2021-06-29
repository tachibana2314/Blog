<?php

namespace App\Http\ViewComposers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class LoginUserComposer
{
    protected $login_user;
    /**
     * @param View $view
     */

    public function __construct()
    {
        if (Route::is('admin.*')) {
            $this->login_user = Auth::guard('admin')->user();
        } else {
            $this->login_user = Auth::guard('employee')->user();
        }

    }

    public function compose(View $view)
    {
        $view->with('login_user',$this->login_user);
    }

}
