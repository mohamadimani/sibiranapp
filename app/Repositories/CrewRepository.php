<?php

namespace  App\Repositories;

use App\Models\Crew;
use App\Repositories\Interfaces\CrewRepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Redis;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class CrewRepository implements CrewRepositoryInterface
{
    protected Model $model;

    public function __construct(public Application $app)
    {
        $this->makeModel();
    }

    /**
     * @throws BadRequestException
     */
    public function makeModel()
    {
        $model = $this->app->make($this->model());
        if (!$model instanceof Model) {
            throw new BadRequestException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }
        return $this->model = $model;
    }

    protected function model(): string
    {
        return Crew::class;
    }

    /**
     * create
     *
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model
    {
        $result = $this->model->create($attributes);
        $this->setCrewListInCatch();

        return $result;
    }

    /**
     * update
     *
     * @param array $attributes
     * @param int $id
     * @return Model
     */
    public function update(array $attributes, int $id): Model
    {
        $record = $this->find($id);
        $record->update($attributes);

        $this->setCrewListInCatch();

        return $record;
    }

    /**
     * delete
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $result = $this->find($id)->delete();
        $this->setCrewListInCatch();

        return $result;
    }

    /**
     * find
     *
     * @param int $id
     * @param array|string[] $columns
     * @return Model|null
     */
    public function find(int $id, array $columns = ['*']): ?Model
    {
        return $this->model->find($id, $columns);
    }

    /**
     * paginate
     *
     * @param int $perPage
     * @param array|string[] $columns
     * @param array $where
     * @param array $orWhere
     * @param array $orderBy
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 15, array $columns = ['*'], array $where = [], array $orWhere = [], array $orderBy = []): LengthAwarePaginator
    {
        $query = $this->model->newQuery();

        foreach ($orWhere as $field => $value) {
            if (is_array($value)) {
                $query->orWhere($field, $value[0], $value[1]);
                continue;
            }

            $query->orWhere($field, $value);
        }

        foreach ($where as $field => $value) {
            if (is_array($value)) {
                $query->where($field, $value[0], $value[1]);
                continue;
            }

            $query->where($field, $value);
        }

        $orderByColumn = $orderBy[0] ?? 'created_at';
        $orderByType = $orderBy[1] ?? 'desc';

        return $query->orderBy($orderByColumn, $orderByType)->paginate($perPage, $columns);
    }

    /**
     * setCrewListInCatch
     *
     * @return LengthAwarePaginator
     */
    public function setCrewListInCatch(): LengthAwarePaginator
    {
        $crews = $this->paginate(
            perPage: config('settings.global.item_per_page'),
            orderBy: ['created_at', 'desc'],
        );
        Redis::set('crew_list', serialize($crews));
        return $crews;
    }
}
