<?php

namespace App\Services\Api;

use App\Services\Api\Contracts\BaseServicesInterface;
use App\Traits\PerpageTrait;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseServices implements BaseServicesInterface
{
    // use PerpageTrait;

    protected ?Model $defaultModel;
    /**
     * Query applied to specified request.
     */
    private ?Builder $customQuery = null;

    protected bool $paginationEnabled = true;

    protected array $searchableColumns = [];

    public function index(): LengthAwarePaginator|Collection
    {
        // return $this->getModel()->all();
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
        } elseif (!empty(request()->search) && 0 === count($this->searchableColumns)) {
            return throw new \Exception('Parameter search not enabled this route.');
        }
        $perpage = new PerpageTrait();

        return $this->paginationEnabled ? $query->paginate($perpage->getPerPage()) : $query->get();
    }

    // public function show(int $id): Model
    // {
    // }

    // public function store(): Model
    // {
    // }

    // public function update(int $id): Model
    // {
    // }

    // public function destroy(int $id): bool
    // {
    // }

    public function setModel(string|Model $value): self
    {
        $this->defaultModel = $value instanceof Model ? $value : new $value();

        return $this;
    }

    public function getModel(): Model
    {
        return $this->defaultModel;
    }

    protected function defaultQuery(): Builder
    {
        $query = $this->customQuery ?? $this->defaultModel::query();

        return $query;
    }
}
