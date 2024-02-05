<?php
namespace  App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface MovieRepositoryInterface
{
    public function create(array $attributes): Model;

    public function update(array $attributes, int $id, bool $withTrashed = false): Model;

    public function delete(int $id): bool;

    public function find(int $id, array $columns = ['*'], bool $withTrashed = false): ?Model;
}
