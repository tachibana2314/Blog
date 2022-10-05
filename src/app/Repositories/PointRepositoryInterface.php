<?php

namespace App\Repositories;

use App\Models\PointSearch;

interface PointRepositoryInterface
{
    public function search(PointSearch $search);
}
