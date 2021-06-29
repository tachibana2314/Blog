<?php

namespace App\Http\Controllers\Admin;

use App\Models\TextCategory;
use App\Models\News;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNewsRequest;
use App\Repositories\DocumentRepositoryInterface;
use App\Repositories\NewsRepositoryInterface;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function __construct(
        DocumentRepositoryInterface $document_repository,
        NewsRepositoryInterface $news_repository
    ) {
        $this->document_repository = $document_repository;
        $this->news_repository = $news_repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $newses = $this->news_repository
            ->search($request)
            ->orderBy('newses.id', 'desc')
            ->paginate(20);

        $textCategories = TextCategory::all()->pluck('name', 'id')->toArray();

        return view('admin.news.index', [
            'request' => $request,
            'newses' => $newses,
            'textCategories' => $textCategories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $news = new News;

        $textCategories = TextCategory::all()->pluck('name', 'id')->toArray();

        return view('admin.news.create', [
            'news' => $news,
            'textCategories' => $textCategories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreNewsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNewsRequest $request)
    {
        $news = $this->news_repository->store($request);
        if (!$news) {
            return redirect()
                ->back()
                ->with('status', 'failed')
                ->with('message', '登録に失敗しました。');
        }
        return redirect()
            ->route('admin.news.edit', $news)
            ->with('status', 'success')
            ->with('message', 'コンテンツを登録しました。');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param News $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        $textCategories = TextCategory::all()->pluck('name', 'id')->toArray();

        return view('admin.news.edit ', [
            'news' => $news,
            'textCategories' => $textCategories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param News $news
     * @param StoreNewsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(News $news, StoreNewsRequest $request)
    {
        if (!$this->news_repository->update($news, $request)) {
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
     * @param News $news
     * @return \Illuminate\Http\Response
     */
    public function delete(News $news)
    {
        $news->delete();
        return redirect()
                ->route('admin.news.index')
                ->with('status', 'success')
                ->with('message', "コンテンツを削除しました。");
    }
}
