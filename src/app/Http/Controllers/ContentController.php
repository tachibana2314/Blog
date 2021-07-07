<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $contents = $this->search($request)
            ->published()
            ->recently()
            ->paginate(6);

        $tag = Arr::get( config('const.PROGRAMMING_CATEGORY'), $data['tag_id'], null);

        $recommend_contents = Content::published()
            ->recommendation()
            ->recently()
            ->take(5)
            ->get();

        return view('web.content.index',[
            'request' => $request,
            'tag' => $tag,
            'contents' => $contents,
            'recommend_contents' => $recommend_contents,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Column  $column
     * @return \Illuminate\Http\Response
     */
    public function show(Content $content)
    {
        $contents = Content::published()
            ->recently()
            ->paginate(6);

        $recommend_contents = Content::published()
            // ->recommendation()
            ->recently()
            ->take(5)
            ->get();


        $prev_content = Content::prev($content['id'])->first();
        $next_content =  Content::next($content['id'])->first();

        return view('web.content.show',[
            'content' => $content,
            'recommend_contents' => $recommend_contents,
            'prev_content' => $prev_content,
            'next_content' => $next_content,
            'contents' => $contents
        ]);
    }

    // 絞り込み
    public function search(Request $request)
    {
        $query = Content::select('contents.*');

        if ($request->get('tag_id')) {
            $query = $query->where('contents.tag_id', $request->get('tag_id'));
        }

        return $query;
    }


}
