<?php

namespace  App\Repositories;

use App\Models\Movie;
use App\Repositories\Interfaces\MovieRepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Model;
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
        return $this->model->create($attributes);
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
        return $this->find($id)->delete();
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
}
