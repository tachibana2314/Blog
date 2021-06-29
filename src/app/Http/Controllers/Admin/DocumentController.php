<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function upload(Request $request, $pathname)
    {
        $filePath = '/'.$pathname;
        $image = $request->file('up_file');
        $access = $request->get('access', 'private');
        $t = Storage::disk('s3')->putFile($filePath, $image, $access);
        if ($access === "public") {
            $url = Storage::disk('s3')->url($t);
        } else {
            $url = Storage::disk('s3')->temporaryUrl($t, now()->addMinutes(10));
        }

        $document = (new Document)->fill([
            'file_name' => $image->getClientOriginalName(),
            'mime_type' => $image->getClientMimeType(),
            'size' => $image->getSize(),
            'path' => $t,
        ]);

        if (!$document->save()) {
            return response()->json([
                'message' => 'ok',
                'document_id' => null,
                'url' => null,
            ], 200, [], JSON_UNESCAPED_UNICODE);
        }

        return response()->json([
            'message' => 'ok',
            'document_id' => $document->id,
            'url' => $url,
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }
}
