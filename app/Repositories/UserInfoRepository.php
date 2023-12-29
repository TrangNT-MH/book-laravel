<?php

namespace App\Repositories;

use App\Models\UserInfo;
use App\Repositories\EloquentRepository;

class UserInfoRepository extends EloquentRepository
{

    function getModel()
    {
        return UserInfo::class;
    }
}
