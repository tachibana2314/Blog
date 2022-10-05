<?php

namespace App\Repositories;

use App\Models\AdminSearch;

interface AdminRepositoryInterface
{
    public function search(AdminSearch $search);
}
