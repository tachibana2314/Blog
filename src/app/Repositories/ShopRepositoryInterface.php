<?php

namespace App\Repositories;

use App\Models\Shop;
use Illuminate\Http\Request;

interface ShopRepositoryInterface
{
    public function search(Request $request, $is_virtual = false);
    public function store(Request $request);
    public function update(Shop $shop, Request $request);
    public function destroy(Shop $shop);
    public function get(Request $request);
}
