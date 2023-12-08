<?php

namespace App\Services\Api\V1;

use App\Services\Api\BaseServices;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class RestaurantService extends BaseServices
{
    public function __construct()
    {
        $this->searchableColumns = [
            'fantasy_name',
            'company_name',
        ];
    }


    public function index(): LengthAwarePaginator|Collection
    {
        $this->searchableColumns = [
            'fantasy_name',
            'company_name',
        ];

        $this->searchableBy = [
            'Category' => ['name'],
            'Food' => ['name', 'description'],
        ];

        $query = $this->defaultQuery();
        if (request()->include) {
            $relations = explode(',', request()->include);

            if ($diff = array_diff($relations, $this->defaultModel->allowedIncludes)) {
                return throw new \Exception("The following includes are not allowed: '".implode(',', $diff)."', enabled: '".implode(',', $this->defaultModel->allowedIncludes)."'");
            }
            $query->with($relations ?? []);
        }

        if (!empty(request()->search) && count($this->searchableColumns) > 0) {
            $query->where(function ($subQuery) {
                foreach ($this->searchableColumns as $column) {
                    $searchString = str_replace(' ', '%', trim(request()->search));
                    $subQuery->orWhere($column, 'LIKE', "%{$searchString}%");
                }
            });
            $result = $query->get();
            $find = false;
            if (empty($result->all())) {
                foreach ($this->searchableBy as $key => $Models) {
                    $model = app("App\Models\\".$key);

                    $search = request()->search;

                    foreach ($Models as $item) {
                        if ($find === false) {
                            $result = $model::where($item, 'LIKE', "%{$search}%");

                            if (!empty($result->get()->all())) {
                                $find = true;
                            }
                        }
                    }
                    if ($find) {
                        $query = $result;
                    }
                }
            }
        } elseif (!empty(request()->search) && 0 === count($this->searchableColumns)) {
            return throw new \Exception('Parameter search not enabled this route.');
        }

        return $query->get();
    }
}
