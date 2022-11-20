<?php

namespace App\Services\Manager\Notification;

use App\Models\Notification;
use App\Services\Base\BaseService;

class NotificationService extends BaseService
{
    public function __construct()
    {
        parent::__construct(Notification::class);
    }
}
