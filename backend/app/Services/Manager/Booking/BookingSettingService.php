<?php

namespace App\Services\Manager\Booking;

use App\Models\BookingSetting;
use App\Services\Base\BaseService;

class BookingSettingService extends BaseService
{
    public function __construct()
    {
        parent::__construct(BookingSetting::class);
    }
}
