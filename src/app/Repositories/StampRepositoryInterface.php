<?php

namespace App\Repositories;

use App\Models\StampCouponSearch;
use App\Models\StampCardSearch;

interface StampRepositoryInterface
{
    public function search(StampCouponSearch $search_coupon);
    public function searchCard(StampCardSearch $search_card);
    public function stampExport();
}
