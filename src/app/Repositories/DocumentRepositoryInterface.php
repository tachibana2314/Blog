<?php

namespace App\Repositories;

use Illuminate\Http\Request;

interface DocumentRepositoryInterface
{
    public function storeThumbnail(Request $request, String $key, String $path);
    public function storeImage(Request $request, String $key, String $path);
    public function storeImageWithCompression(Request $request, String $key, String $path);
    public function storeFile(Request $request, String $key, String $path, String $visibility);
    public function deleteFile(String $path);
}
