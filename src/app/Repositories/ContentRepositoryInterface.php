<?php

namespace App\Repositories;

use App\Models\Content;
use Illuminate\Http\Request;

interface ContentRepositoryInterface
{
    public function search(Request $request);
    public function store(Request $request);
    public function update(Content $content, Request $request);
    public function destroy(Content $content);
    public function get(Request $request);
}
