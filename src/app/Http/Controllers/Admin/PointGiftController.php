<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PointGiftRequest;
use App\Models\PointGift;
use App\Models\PointGiftPicture;
use App\Models\PointGiftSearch;
use App\Repositories\PointGiftRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Storage;
use Session;

class PointGiftController extends Controller
{
    public function __construct(PointGiftRepositoryInterface $pointGiftRepository)
    {
        $this->pointGiftRepository = $pointGiftRepository;
    }

    public function index(Request $request)
    {

        $url = request()->fullUrl();
        $request->session()->put('back_url', $url);

        $search = new PointGiftSearch();
        $params = $request->query();

        $point_gifts = $this->pointGiftRepository
            ->search($search->fill($params))
            ->sortable()
            ->orderBy('status', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.point_gift.index', [
            'title' => 'ポイント景品管理',
            'point_gifts' => $point_gifts,
            'search' => $search,
        ]);
    }

    public function add()
    {
        return view('admin.point_gift.add.index', [
            'title' => 'ポイント景品追加',
        ]);
    }

    public function store(PointGiftRequest $request)
    {
        DB::beginTransaction();
        try {
            $point_gift = new PointGift;
            //postデータ取得
            $data = $request->all();
            $point_gift->fill($data)->save();
            // 画像保存
            $new_images = $data['path'];
            // ２枚の画像を保存しない場合 $max_image_count = 1
            // ２枚の画像を保存する場合 $max_image_count = 1 or 2
            $max_image_count = Arr::get($request, 'delete_flg') ? 1 : count($new_images);
            $disk = Storage::disk('s3');
            for ($i = 0; $i < $max_image_count; $i++) {
                if (array_key_exists($i, $new_images)) {
                    if ($new_images[$i]) {
                        $imagefile = $new_images[$i];
                        $path = $disk->putFile('point_gift', $imagefile, 'public');
                        $paths = PointGiftPicture::create([
                            // s3の保存先のパスを生成
                            'point_gift_id' => $point_gift->id,
                            // アップロードした画像のパスをpostデータにDBカラムに保存
                            'path' => $path,
                        ]);
                    }
                }
            }
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->with('message', "ポイント景品の追加に失敗しました。");
        }
        DB::commit();
        return redirect()->route('admin.point_gift.index')->with('message', "ポイント景品情報を追加しました。");
    }


    public function detail(Request $request, PointGift $point_gift)
    {
        $url = $request->session()->get('back_url');

        return view('admin.point_gift.detail.index', [
            'title' => 'ポイント景品情報詳細',
            'url' => $url,
            'point_gift' => $point_gift,
        ]);
    }

    public function edit(PointGift $point_gift)
    {
        $point_gift = PointGift::find($point_gift->id);
        $image = $point_gift->point_gift_pictures;

        return view('admin.point_gift.detail.edit.index', [
            'title' => 'ポイント景品情報編集',
            'point_gift' => $point_gift,
            'image' => $image,
        ]);
    }

    public function update(PointGift $point_gift, PointGiftRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            $point_gift->fill($data)->save();
            if ($request->has('path')) {
                $disk = Storage::disk('s3');
                $images = $request->file('path');
                //DB上にある画像情報
                $point_gift_pictures = PointGiftPicture::where([
                    'point_gift_id' => $point_gift->id,
                ])->get();
                foreach ((array)$images as $key => $image_path) {
                    // s3に保存。
                    $path = $disk->putFile('point_gift', $image_path, 'public');
                    if (!isset($point_gift_pictures[$key])) {
                        $picture = new PointGiftPicture();
                        $picture->point_gift_id = $point_gift->id;
                    } else {
                        $picture  = $point_gift_pictures[$key];
                    }
                    $picture->path = $path;
                    $picture->save();
                }
            }
            if (!empty($request['delete_image_id'])) {
                $target_picture = PointGiftPicture::find($request['delete_image_id']);
                Storage::disk('s3')->delete('point_gift', $target_picture->path);
                $target_picture->delete();
            }
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->with('message', "ポイント景品の編集に失敗しました。");
        }
        DB::commit();
        return redirect()->route('admin.point_gift.detail', $point_gift)->with('message', "ポイント景品情報を更新しました。");
    }

    public function delete($id)
    {
        $point_gift = PointGift::find($id);
        $disk = Storage::disk('s3');
        $images = $point_gift->point_gift_pictures;
        foreach ($images as $image) {
            $file = $image->path;
            $disk->delete('point_gift', $file);
        }

        $point_gift->delete($id);
        return redirect()->route('admin.point_gift.index')->with('message', "ポイント景品情報を削除しました");
    }
}
