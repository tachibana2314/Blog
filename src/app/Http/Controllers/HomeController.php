<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('web.home.index');
    }


    public function show()
    {
        $content = Content::find(1);

        return view('web.single.index',[
            'content' => $content
        ]);
    }


    public function contact()
    {
        $content = Content::find(1);
        return view('web.contact.index',[
            'content' => $content
        ]);
    }
}
