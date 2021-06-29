<?php

namespace App\Repositories;

use App\Http\Requests\CommonProductRequest;
use App\Models\CommonProduct;
use Illuminate\Http\Request;

interface CommonProductRepositoryInterface
{
    public function search(Request $request);
    public function store(CommonProductRequest $request);
    public function update(CommonProduct $common_product, CommonProductRequest $request);
    public function destroy(CommonProduct $common_product);
}
