<?php

namespace  App\Repositories;

use App\Models\Movie;
use App\Repositories\Interfaces\MovieRepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Redis;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class MovieRepository implements MovieRepositoryInterface
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
        return Movie::class;
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
        $this->setMovieListInCatch();

        return $result;
    }

    /**
     * update
     *
     * @param array $attributes
     * @param int $id
     * @param bool $withTrashed
     * @return Model
     */
    public function update(array $attributes, int $id, bool $withTrashed = false): Model
    {
        $record = $this->find($id, withTrashed: $withTrashed);
        $record->update($attributes);

        $this->setMovieListInCatch();

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
        $this->setMovieListInCatch();

        return $result;
    }

    /**
     * find
     *
     * @param int $id
     * @param array|string[] $columns
     * @param bool $withTrashed
     * @return Model|null
     */
    public function find(int $id, array $columns = ['*'], bool $withTrashed = false): ?Model
    {
        if ($withTrashed) {
            return $this->model->withTrashed()->where('id', $id)->first($columns);
        }
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
     * @param bool $withTrashed
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 15, array $columns = ['*'], array $where = [], array $orWhere = [], array $orderBy = [], bool $withTrashed = false): LengthAwarePaginator
    {
        $query = $this->model->newQuery();

        if ($withTrashed) {
            $query->withTrashed();
        }

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
     * setMovieListInCatch
     *
     * @return LengthAwarePaginator
     */
    public function setMovieListInCatch(): LengthAwarePaginator
    {
        $movies = $this->paginate(
            perPage: config('settings.global.item_per_page'),
            orderBy: ['created_at', 'desc'],
        );
        Redis::set('movie_list', serialize($movies));
        return $movies;
    }
}
