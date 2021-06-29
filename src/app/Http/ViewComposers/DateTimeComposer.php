<?php

namespace App\Http\ViewComposers;


use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Carbon;

class DateTimeComposer
{
    protected $login_user;
    /**
     * @param View $view
     */

    public function __construct()
    {
        Carbon::setLocale('ja');
        $this->now = Carbon::now();
        $this->week = Carbon::now()->isoFormat('ddd');
        $this->today = Carbon::now()->isoFormat('YYYY.MM.DD');
        $this->this_month = Carbon::now()->isoFormat('YYYY.MM');
        $this->time =  Carbon::now()->nowWithSameTz()->format('H:i');

    }

    public function compose(View $view)
    {
        $view->with('now',$this->now);
        $view->with('today',$this->today);
        $view->with('time',$this->time);
        $view->with('week',$this->week);
        $view->with('this_month',$this->this_month);
    }

}
