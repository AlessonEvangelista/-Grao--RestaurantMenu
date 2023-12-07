<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\BaseController;
use App\Http\Resources\Api\V1\RestaurantResources;
use App\Models\Restaurant;
use App\Services\Api\V1\RestaurantService;

class RestaurantController extends BaseController
{
    public function __construct()
    {
        $this->defaultResource = RestaurantResources::class;
        $this->defaultService = (new RestaurantService())
            ->setModel(Restaurant::class);
    }
}
