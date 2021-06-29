<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function upload(Request $request, $pathname)
    {
        $filePath = '/'.$pathname;
        $image = $request->file('up_file');
        $access = $request->get('access', 'private');
        $t = Storage::disk('s3')->putFile($filePath, $image, $access);
        if ($access === "public") {
            $imagePath = Storage::disk('s3')->url($t);
        } else {
            $imagePath = Storage::disk('s3')->temporaryUrl($t, now()->addMinutes(1));
        }

        return response()->json([
            'message' => 'ok',
            'path' => $imagePath,
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }
}
