<?php

namespace Bundle\Token\Repository;

use Illuminate\Database\Eloquent\Collection;

interface TokenRepositoryInterface
{
    public function get(string $column, $data): Collection;

    public function remove(string $column, $data): bool;

    public function update(array $data): Collection;

    public function insert(array $data): bool;
}