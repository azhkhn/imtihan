<?php

namespace App\Services\Manager\User;

use App\Helper\Helper;
use App\Models\User;
use App\Services\Base\BaseService;

class TeacherService extends BaseService
{
    public function __construct()
    {
        parent::__construct(User::class);
    }

    public function list(array $with = [], array $where = [])
    {
        return $this->model::with($with)->where($where)->whereRelation('info', 'company_id', Helper::userInfo()->company_id)->latest()->get();
    }
}
