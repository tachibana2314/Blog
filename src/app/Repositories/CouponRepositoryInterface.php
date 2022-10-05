<?php

namespace App\Repositories;

use App\Models\CouponSearch;

interface CouponRepositoryInterface
{
    public function search(CouponSearch $search);
    public function couponExport();
}
