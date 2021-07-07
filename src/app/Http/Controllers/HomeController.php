<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $contents = Content::published()->paginate(1);
        $tag = null;

        return view('web.home.index',[
            'contents' => $contents,
            'tag' => $tag
        ]);
    }


    public function profile()
    {
        $content = Content::find(1);
        $contents = Content::all();

        return view('web.single.index',[
            'content' => $content,
            'contents' => $contents
        ]);
    }


    public function contact()
    {
        $content = Content::find(1);
        $contents = Content::all();
        return view('web.contact.index',[
            'content' => $content,
            'contents' => $contents
        ]);
    }

}
