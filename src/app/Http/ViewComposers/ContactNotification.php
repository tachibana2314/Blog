<?php

namespace App\Http\ViewComposers;

use App\Models\Contact;
use Illuminate\View\View;
class ContactNotification
{
    protected $schools;
    /**
     * @param View $view
     */

    public function compose(View $view)
    {
        $view->with('contact_cnt', Contact::where('status', 1)->count());
    }

}
