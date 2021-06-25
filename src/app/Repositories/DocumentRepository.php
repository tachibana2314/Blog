<?php

namespace App\Repositories;

use DB;
use Image;
use Storage;
use App\Models\Document;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use League\Flysystem\FileExistsException;

class DocumentRepository implements DocumentRepositoryInterface
{
    public function __construct(
        Storage $storage
    ) {
        $this->storage = $storage;
    }

    public function storeThumbnail(Request $request, String $key, String $path)
    {
        if ($file = $request->file($key)) {
            $file_path = $this->uploadThumbnail($file, $path);
            return $file_path;
        }
    }

    /**
     * 画像保存
     * サムネイルを作成せず、そのままのサイズでS3に保存する
     *
     * @param Request $request
     * @param String $path
     *
     * @return String $file_path
     */
    public function storeImage(Request $request, String $key, String $path)
    {
        $now = date_format(Carbon::now(), 'YmdHis');
        $file = $request->file($key);
        $file_name = $now.'_'.uniqid(rand()).'.'.$file->getClientOriginalExtension();
        $extension = $file->getClientOriginalExtension();

        $image = Image::make($file)->orientate()->encode($extension, 100);
        $file_path = $path.'/'.$file_name;
        Storage::disk('s3')->put($file_path, (string)$image, 'public');

        return $file_path;
    }

    /**
     * 画像保存
     * 圧縮してS3に保存する
     *
     * @param Request $request
     * @param String $path
     *
     * @return String $file_path
     */
    public function storeImageWithCompression(Request $request, String $key, String $path)
    {
        $now = date_format(Carbon::now(), 'YmdHis');
        $file = $request->file($key);
        $file_name = $now.'_'.uniqid(rand()).'.'.$request->file('file')->getClientOriginalExtension();
        $extension = $file->getClientOriginalExtension();

        $originalSize = $request->file->getSize();
        $quarity = min(100, round(1000000 / $originalSize) * 100);

        $image = Image::make($file)->orientate()->encode($extension, $quarity);
        $file_path = $path.'/'.$file_name;
        Storage::disk('s3')->put($file_path, (string)$image, 'public');

        return $file_path;
    }

    private function uploadThumbnail($file, String $path)
    {
        $now = date_format(Carbon::now(), 'YmdHis');
        $name = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();

        // 画像を横幅300px・縦幅アスペクト比維持の自動サイズへリサイズして一時ファイル保存先へ格納
        $file_name = $now . '_' . uniqid(rand()) .'_' . $name;
        $image = Image::make($file)
            ->orientate()
            ->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->encode($extension);
        $file_path = $path.'/'.$file_name;
        Storage::disk('s3')->put($file_path, (string)$image, 'public');

        $attributes = [
            'file_name' => $file->getClientOriginalName(),
            'mime_type' => $file->getClientMimeType(),
            'size' => $image->filesize(),
            'path' => $file_path,
        ];

        return $file_path;
    }

    /**
     * ファイル保存
     *
     * @param Request $request
     * @param String $key
     * @param String $path
     * @param String $visibility
     *
     * @return String $file_path
     */
    public function storeFile(Request $request, String $key, String $path, String $visibility = 'public')
    {
        $result = null;

        $now = date_format(Carbon::now(), 'YmdHis');

        $folder = $now.'_'.uniqid(rand());
        $file_path = $path.'/'.$file_name;
        $upload = $this->storage::disk('s3')->putFileAs(
            $file_path,
            $request->file($key),
            $request->$key->getClientOriginalName()
        );
        $this->storage::disk('s3')->setVisibility($upload, $visibility);

        return $file_path;
    }

    public function deleteFile(String $path)
    {
        return $this->storage::disk('s3')->delete([$path]);
    }
}
