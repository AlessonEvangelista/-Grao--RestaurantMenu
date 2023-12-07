<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\BaseController;
use App\Http\Resources\Api\V1\UserResources;
use App\Models\User;
use App\Services\Api\V1\UserServices;

class UserController extends BaseController
{
    public function __construct()
    {
        $this->defaultResource = UserResources::class;
        $this->defaultService = (new UserServices())
            ->setModel(User::class);
    }
}
