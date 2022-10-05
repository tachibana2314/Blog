<?php

namespace App\Repositories;

use App\Models\InformationSearch;

interface InformationRepositoryInterface
{
    public function search(InformationSearch $search);
}
