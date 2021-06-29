<?php

namespace App\Repositories;

use App\Models\Staff;
use Illuminate\Http\Request;

interface ContactRepositoryInterface
{
    public function search(Request $request);
}
