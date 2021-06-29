<?php

namespace App\Repositories;

use App\Models\Content;
use App\Repositories\DocumentRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;
use Illuminate\Support\Carbon;
use Image;

class ContentRepository implements ContentRepositoryInterface
{
    public function __construct(
        DocumentRepositoryInterface $document_repository
    ) {
        $this->document_repository = $document_repository;
    }

    public function search(Request $request)
    {
        $query = Content::select('contents.*');

        if ($request->get('keyword')) {
            $search_array = space_array_conversion($request->get('keyword'));
            foreach ($search_array as $search_word) {
                $query->where(function($q) use ($search_word) {
                    $q->where('contents.title', 'like', "%$search_word%")
                        ->orWhere('contents.body', 'like', "%$search_word%");
                });
            }
        }
        if ($request->get('text_category_id')) {
            $query = $query->where('contents.text_category_id', $request->get('text_category_id'));
        }

        return $query;
    }

    public function store(Request $request)
    {
        $data = $request->all();
        //画像保存
        if($request->has('image_path')){
            $disk = Storage::disk('s3');
            $file = $request->file('image_path');
           // s3に保存。
            $path = $disk->put('content', $file, 'public');
            $data['image_path'] = $path;
        }


        $content = new Content;
        $content->fill($data)->save();


        return $content;
    }

    public function update(Content $content, Request $request)
    {
        $data = $request->all();
        //画像保存
        if($request->has('image_path')){
            $disk = Storage::disk('s3');
            $file = $request->file('image_path');
           // s3に保存。
            $path = $disk->put('content', $file, 'public');
            $data['image_path'] = $path;
        }

        $content->fill($data)->save();

        return $content;
    }

    public function destroy(Content $content)
    {
        $content->delete();

        return $content;
    }

    public function get(Request $request)
    {
        if ($request->id) {
            $news = News::where('id', $request->id)->first();
        }

        return $news;
    }
}
