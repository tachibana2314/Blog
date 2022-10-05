<?php

namespace App\Repositories;

use App\Models\Information;

interface NotificationRepositoryInterface
{
    public function send(Information $information);
}
