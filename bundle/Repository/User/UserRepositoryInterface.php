<?php

namespace Bundle\Repository\User;

interface UserRepositoryInterface
{
    public function getUsers(int $skip, int $take);

    public function getUser($data, string $column);

    public function update(array $data);

    public function delete($data, string $column);

    public function insert(array $data);
}