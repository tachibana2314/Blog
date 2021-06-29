<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $contents = Content::all();
        return view('web.home.index',[
            'contents' => $contents
        ]);
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

    public function content(Content $content)
    {
        return view('web.content.show',[
            'content' => $content
        ]);
    }

}
