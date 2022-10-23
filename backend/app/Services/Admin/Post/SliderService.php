<?php

namespace App\Services\Admin\Post;

use App\Models\Slider;
use App\Services\Base\BaseService;

class SliderService extends BaseService
{
    public function __construct()
    {
        parent::__construct(Slider::class);
    }
}
