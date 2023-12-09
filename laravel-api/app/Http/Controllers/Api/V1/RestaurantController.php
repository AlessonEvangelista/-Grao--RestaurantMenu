<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\BaseController;
use App\Http\Resources\Api\V1\CategoryResources;
use App\Http\Resources\Api\V1\FoodResources;
use App\Http\Resources\Api\V1\RestaurantResources;
use App\Models\Restaurant;
use App\Services\Api\V1\RestaurantService;
use App\Traits\HttpResponses;
use Illuminate\Http\JsonResponse;

class RestaurantController extends BaseController
{
    use HttpResponses;

    public $validated;

    public function __construct()
    {
        $this->validator();
        $this->defaultResource = RestaurantResources::class;
        $this->defaultService = (new RestaurantService())
            ->setModel(Restaurant::class);
        $this->permissionAuthenticated();
    }

    public function validator()
    {
        $this->validated = [
            'fantasy_name' => 'required',
            'company_name' => 'required',
            'identification_doc' => 'required',
            'describe' => 'nullable',
            'address' => 'nullable',
            'opening_hours' => 'nullable',
        ];
    }

    public function index(): JsonResponse
    {
        $data = $this->defaultService->index();
        $class = explode('\\', get_class($data->first()));
        switch ($class[2]) {
            case 'Category':
                $response = CategoryResources::collection($data);
                break;
            case 'Food':
                $response = FoodResources::collection($data);
                break;

            default:
                $response = RestaurantResources::collection($data);
                break;
        }

        return response()->json(
            data: $response
        );
    }
}
