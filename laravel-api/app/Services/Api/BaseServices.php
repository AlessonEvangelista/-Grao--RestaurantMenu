<?php

namespace App\Services\Api;

use App\Services\Api\Contracts\BaseServicesInterface;
use App\Traits\PerpageTrait;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BaseServices implements BaseServicesInterface
{
    use PerpageTrait;

    protected ?Model $defaultModel;
    /**
     * Query applied to specified request.
     */
    private ?Builder $customQuery = null;
    protected bool $paginationEnabled = true;
    protected array $data = [];
    protected array $searchableColumns = [];
    protected array $searchableBy = [];

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

        return $this->paginationEnabled ? $query->paginate($this->getPerPage()) : $query->get();
    }

    public function show(int $id): Model|Builder
    {
        $query = $this->defaultQuery();

        if (request()->include) {
            $relations = explode(',', request()->include);
            if ($diff = array_diff($relations, array_keys($this->defaultModel->allowedIncludes))) {
                throw new \Exception("The following includes are not allowed: '".implode(',', $diff)."', enabled: '".implode(',', array_keys($this->defaultModel->allowedIncludes))."'");
            }
            $query->with($relations ?? []);
        }

        return $query->findOrfail($id);
    }

    public function store(array $data): Model
    {
        $transaction = DB::transaction(function () use ($data) {
            $callback = $this->defaultModel->create($data);

            foreach ($data as $indice => $value) {
                if (is_array($value)) {
                    $callback->$indice()->sync($value);
                }
            }

            return $callback->refresh();
        });

        return $transaction;
    }

    public function update(array $data, int $id): Model|Builder
    {
        $model = $this->show($id);

        $transaction = DB::transaction(function () use ($data, $model) {
            $model->update($data);

            foreach ($data as $indice => $value) {
                if (is_array($value)) {
                    $model->$indice()->sync($value, false);
                }
            }

            return $model->refresh();
        });

        return $transaction;
    }

    public function destroy(int $id): bool
    {
        $element = $this->show($id);

        /*
         * Get relaptions
         */
        foreach ($this->defaultModel->allowedIncludes as $relapted) {
            /*
             * Get Models to Relaption
             */
            foreach ($element->$relapted->all() as $item) {
                /*
                 * Models contains relaptions
                 */
                if ($item->allowedIncludes) {
                    /*
                     * Get relaptions
                     */
                    foreach ($item->allowedIncludes as $secondRelaption) {
                        if (!empty($item->$secondRelaption)) {
                            /*
                             * Get Models to relaptions
                             */
                            foreach ($item->$secondRelaption->all() as $seconditem) {
                                $seconditem->delete();
                            }
                        }
                    }
                }

                $item->delete();
            }
        }

        return $element->delete();
    }

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
