<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['privacy', 'links']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * プライバシーポリシー
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function privacy()
    {
        return view('privacy');
    }

    /**
     * ユニバーサルリンク用
     */
    public function links(Request $request)
    {
        $page = $request->get('page');
        $id = $request->get('id');
        $link = "chateraise-app-sg://?page={$page}&id={$id}";

        return view('links', [
            'link' => $link,
        ]);
    }
}
