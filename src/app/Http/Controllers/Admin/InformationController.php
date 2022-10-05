<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\InfoRequest;
use App\Models\Information;
use App\Models\InformationSearch;
use App\Repositories\InformationRepositoryInterface;
use App\Repositories\NotificationRepositoryInterface;
use Illuminate\Support\Arr;
use Storage;
use Artisan;
use Carbon\Carbon;

class InformationController extends Controller
{
    public function __construct(
        InformationRepositoryInterface $informationRepository,
        NotificationRepositoryInterface $notificationRepositoryInterface
    )
    {
        $this->informationRepository = $informationRepository;
        $this->notificationRepositoryInterface = $notificationRepositoryInterface;
    }

    public function index(Request $request)
    {
        $search = new InformationSearch();
        $information = new Information;
        $params = $request->query();
        $information = $this->informationRepository->search($search->fill($params))
            ->sortable()
            ->orderBy('status', 'asc')
            ->orderBy('release_date', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(20);

        return view('admin.information.index', [
            'title' => 'お知らせ管理',
            'information' => $information,
            'search' => $search,
        ]);
    }

    public function add()
    {
        return view('admin.information.add.index', [
            'title' => 'お知らせ追加',
        ]);
    }

    public function store(InfoRequest $request)
    {
        $information = new Information;
        //postデータ取得
        $data = $request->all();
        //画像保存
        if($request->has('pic_path')){
            $disk = Storage::disk('s3');
            $file = $request->file('pic_path');
            // s3に保存。
            $path = $disk->put('information', $file, 'public');
            $data['pic_path'] = $path;
        }
        $information->fill($data)->save();

        if( $request->has('push_flg')){
            $information->fill([
                'release_date' => Carbon::today(),
                'status' => 1,
            ]);
            $information->save();
            $this->notificationRepositoryInterface->send($information);
        }

        return redirect()->route('admin.information')->with('message', "お知らせを追加しました。");;
    }


    public function detail(Information $information)
    {
        return view('admin.information.detail.index', [
            'title' => 'お知らせ詳細',
            'information' => $information,
        ]);
    }

    public function edit(Information $information)
    {
        return view('admin.information.detail.edit.index', [
            'title' => 'お知らせ情報編集',
            'information' => $information,
        ]);
    }

    public function update(Information $information, InfoRequest $request)
    {
        $data = $request->all();

        //画像保存
        if ($request->has('pic_path')) {
            $disk = Storage::disk('s3');
            // 既存のS3写真を削除
            $image = $information->pic_path;
            $disk->delete('information', $image);
            $file = $request->file('pic_path');
            // s3に保存。
            $path = $disk->put('information', $file, 'public');
            $data['pic_path'] = $path;
        }

        $information->fill($data)->save();

        return redirect()->route('admin.information.detail', $information)->with('message', "お知らせを更新しました。");
    }

    public function delete($id)
    {
        $information = Information::find($id);
        //S3写真を削除
        $disk = Storage::disk('s3');
        $image = $information->pic_path;
        $disk->delete('information', $image);

        $information->delete($id);
        return redirect()->route('admin.information')->with('message', "お知らせを削除しました");
    }
}
