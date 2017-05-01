<?php

namespace Bundle\Token\Repository;

use Bundle\Token\Eloquent\Token;

interface TokenRepositoryInterface
{
    public function get(string $column, $data);

    public function remove(string $column, $data): bool;

    public function update(array $data);

    public function save(array $data): Token;
}