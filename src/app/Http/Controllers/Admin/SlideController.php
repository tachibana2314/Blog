<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SlideRequest;
use App\Http\Requests\UpdateSlideRequest;
use App\Models\Slide;
use App\Models\Product;
use App\Models\Coupon;
use App\Models\Store;
use App\Models\Information;
use App\Models\StampCard;
use Illuminate\Support\Arr;
use Storage;
use DB;

class SlideController extends Controller
{
    public function index()
    {
        $slide = new Slide;

        // $slide_w = $slide
        // ->where('status', 2)
        // ->orderBy('created_at', 'desc')
        // ->get();

        $slide = $slide
            ->displayOrder()
            ->get();

        return view('admin.slide.index', [
            'title' => 'スライド管理',
            'slide' => $slide,
            // 'slide_w' => $slide_w,
        ]);
    }

    public function add()
    {
        return view('admin.slide.add.index', [
            'title' => 'スライド追加',
            'all_products' => Product::where('status', '1')->pluck('name', 'id')->toArray(),
            'all_stores' => Store::where('status', '1')->pluck('name', 'id')->toArray(),
            'all_coupons' => Coupon::where('status', '1')->pluck('title', 'id')->toArray(),
            'all_informations' => Information::where('status', '1')->pluck('title', 'id')->toArray(),
            'all_stamps' => StampCard::where('status', '1')->pluck('title', 'id')->toArray(),
        ]);
    }

    public function store(SlideRequest $request)
    {
        $count_slide = Slide::where('status', 1)->count();

        DB::beginTransaction();
        try {
            $slide = new Slide;
            //postデータ取得
            $data = $request->all();

            //画像保存
            $request->has('pic_path');
            $disk = Storage::disk('s3');
            $file = $request->file('pic_path');
            // s3に保存。
            $path = $disk->put('slide', $file, 'public');
            $data['pic_path'] = $path;

            $slide->fill($data)->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect(url()->previous())->with('message_error', 'エラーが発生しました');
        }

        return redirect()->route('admin.slide')->with('message', "スライドを追加しました。");
    }

    public function edit(Slide $slide)
    {
        $slide = Slide::find($slide->id);
        $url = Storage::disk('s3')->url($slide->pic_path);;
        return view('admin.slide.detail.edit.index', [
            'title' => 'スライド編集',
            'url' => $url,
            'slide' => $slide,
            'all_products' => Product::where('status', '1')->pluck('name', 'id')->toArray(),
            'all_stores' => Store::where('status', '1')->pluck('name', 'id')->toArray(),
            'all_coupons' => Coupon::where('status', '1')->pluck('title', 'id')->toArray(),
            'all_informations' => Information::where('status', '1')->pluck('title', 'id')->toArray(),
            'all_stamps' => StampCard::where('status', '1')->pluck('title', 'id')->toArray(),
        ]);
    }

    public function update(Slide $slide, UpdateSlideRequest $request)
    {
        $count_slide = Slide::where('status', 1)->count();

        // if ($request->input('old_status') == 1) {
            DB::beginTransaction();
            try {
                $data = $request->all();
                //画像保存
                if ($request->has('pic_path')) {
                    $disk = Storage::disk('s3');
                    // 既存のS3写真を削除
                    $image = $slide->pic_path;
                    $disk->delete('slide', $image);

                    $file = $request->file('pic_path');
                    // s3に保存。
                    $path = $disk->put('slide', $file, 'public');
                    $data['pic_path'] = $path;
                }
                $slide->fill($data)->save();
                DB::commit();
            } catch (\Exception $e) {
                dd($e);
                DB::rollBack();
                return redirect(url()->previous())->with('message_error', 'エラーが発生しました');
            }
            return redirect()->route('admin.slide')->with('message', "スライドを更新しました。");
        // // } elseif ($request->input('status') != 1 || $count_slide < 5) {
        //     DB::beginTransaction();
        //     try {
        //         $data = $request->all();
        //         //画像保存
        //         if ($request->has('pic_path')) {
        //             $disk = Storage::disk('s3');
        //             // 既存のS3写真を削除
        //             $image = $slide->pic_path;
        //             $disk->delete('slide', $image);

        //             $file = $request->file('pic_path');
        //             // s3に保存。
        //             $path = $disk->put('slide', $file, 'public');
        //             $data['pic_path'] = $path;
        //         }
        //         $slide->fill($data)->save();
        //         DB::commit();
        //     } catch (\Exception $e) {
        //         DB::rollBack();
        //         return redirect(url()->previous())->with('message_error', 'エラーが発生しました');
        //     }
        //     return redirect()->route('admin.slide')->with('message', "スライドを更新しました。");
        // }
        // return redirect(url()->previous())->withInput()->with('message_error', '公開中のスライドが既に5枚存在します');
    }

    public function delete(Slide $slide)
    {
        //S3写真を削除
        $disk = Storage::disk('s3');
        $image = $slide->pic_path;
        $disk->delete('slide', $image);
        $slide->delete($slide->id);
        return redirect()->route('admin.slide')->with('message', "スライドを削除しました");
    }

    public function sortSlide()
    {
        $sort_slide = Slide::where('status', 1)->orderBy('order', 'ASC')->get();

        return view('admin.news.sort_pickup_news', ['sort_slide' => $sort_slide]);
    }


    public function sortSlideDone(Request $request)
    {
        if ($request->sort_slide) {
            Slide::whereNotNull('order')->update([
                'order' => null
            ]);
            foreach ($request->sort_slide as $i => $e) {
                Slide::where('id', $e)->update([
                    'order' => ++$i
                ]);
            }
            $slide_w = Slide::where('status', 2)->get();
        }
        return redirect()->back()->with('message', '表示順序を更新しました。');
    }
}
