<?php

namespace App\Services\User\Booking;

use App\Models\Booking;
use App\Services\Base\BaseService;

class BookingService extends BaseService
{
    public function __construct()
    {
        parent::__construct(Booking::class);
    }
}
