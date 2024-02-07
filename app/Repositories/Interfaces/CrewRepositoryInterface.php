<?php
namespace  App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface CrewRepositoryInterface
{
    public function create(array $attributes): Model;

    public function update(array $attributes, int $id): Model;

    public function delete(int $id): bool;

    public function find(int $id, array $columns = ['*']): ?Model;

    public function paginate(int $perPage = 15, array $columns = ['*'], array $where = [], array $orWhere = [], array $orderBy = [] ): LengthAwarePaginator;

}
