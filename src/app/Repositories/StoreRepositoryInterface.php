<?php

namespace App\Repositories;

use App\Models\StoreSearch;

interface StoreRepositoryInterface
{
    public function search(StoreSearch $search);
}
