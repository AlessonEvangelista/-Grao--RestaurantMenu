<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\BaseController;
use App\Http\Resources\Api\V1\UserResources;
use App\Models\User;
use App\Services\Api\V1\UserServices;

class UserController extends BaseController
{
    public $validated;

    public function __construct()
    {
        $this->validator();
        $this->defaultResource = UserResources::class;
        $this->defaultService = (new UserServices())
            ->setModel(User::class);
        $this->permissionAuthenticated();
    }

    public function validator()
    {
        $this->validated = [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ];
    }
}
