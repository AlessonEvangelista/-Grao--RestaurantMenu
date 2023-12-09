<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\BaseController;
use App\Http\Resources\Api\V1\FoodResources;
use App\Models\Food;
use App\Services\Api\V1\FoodService;
use App\Traits\HttpResponses;

class FoodController extends BaseController
{
    use HttpResponses;

    public $validated;

    public function __construct()
    {
        $this->validator();
        $this->defaultResource = FoodResources::class;
        $this->defaultService = (new FoodService())
            ->setModel(Food::class);
    }

    public function validator()
    {
        $this->validated = [
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required|numeric',
            'value' => 'required|numeric|between:1,9999.99',
            'status' => 'nullable',
        ];
    }
}
