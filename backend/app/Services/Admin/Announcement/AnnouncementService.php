<?php

namespace App\Services\Admin\Announcement;

use App\Models\Announcement;
use App\Services\Base\BaseService;

class AnnouncementService extends BaseService
{
    public function __construct()
    {
        parent::__construct(Announcement::class);
    }
}
