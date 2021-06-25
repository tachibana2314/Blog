<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Content;
use App\Repositories\DocumentRepositoryInterface;
use App\Repositories\ContentRepositoryInterface;

class ContentController extends Controller
{

    public function __construct(
        DocumentRepositoryInterface $document_repository,
        ContentRepositoryInterface $content_repository
    ) {
        $this->document_repository = $document_repository;
        $this->content_repository = $content_repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $contents = $this->content_repository
        ->search($request)
        ->orderBy('contents.id', 'desc')
        ->paginate(20);

        return view('admin.content.index', [
            'request' => $request,
            'contents' => $contents,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $content = new Content;

        return view('admin.content.create', [
            'content' => $content,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $content = $this->content_repository->store($request);
        if (!$content) {
            return redirect()
                ->back()
                ->with('status', 'failed')
                ->with('message', '登録に失敗しました。');
        }
        return redirect()
            ->back()
            ->with('status', 'success')
            ->with('message', 'コンテンツを登録しました。');
    }


    public function edit(Content $content)
    {

        return view('admin.news.edit ', [
            'content' => $content,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param News $news
     * @param StoreNewsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(Content $content, Request $request)
    {
        if (!$this->content_repository->update($content, $request)) {
            return redirect()
                ->back()
                ->with('status', 'failed')
                ->with('message', '更新に失敗しました。');
        }
        return redirect()
            ->back()
            ->with('status', 'success')
            ->with('message', '更新が完了しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
