<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\BaseController;
use App\Http\Resources\Api\V1\CategoryResources;
use App\Models\Category;
use App\Services\Api\V1\CategoryService;
use App\Traits\HttpResponses;

class CategoryController extends BaseController
{
    use HttpResponses;

    public $validated;

    public function __construct()
    {
        $this->validator();
        $this->defaultResource = CategoryResources::class;
        $this->defaultService = (new CategoryService())
            ->setModel(Category::class);
    }

    public function validator()
    {
        $this->validated = [
            'name' => 'required',
            'category_id' => 'nullable|numeric',
            'restaurant_id' => 'required|numeric',
        ];
    }
}
