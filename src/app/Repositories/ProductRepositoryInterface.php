<?php

namespace App\Repositories;

use App\Models\ProductSearch;

interface ProductRepositoryInterface
{
    public function search(ProductSearch $search);
    public function productExport();
}
