<?php

namespace App\Repositories;

use App\Models\Staff;
use Illuminate\Http\Request;

interface StaffRepositoryInterface
{
    public function search(Request $request);
    public function store(Request $request);
    public function update(Staff $staff, Request $request);
    public function destroy(Staff $staff);
    public function get(Request $request);
    public function show(Staff $staff, Request $request);
    public function export($session);
}
