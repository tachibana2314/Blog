<?php

namespace App\Repositories;

use App\Models\PointGiftSearch;

interface PointGiftRepositoryInterface
{
    public function search(PointGiftSearch $search);
}
