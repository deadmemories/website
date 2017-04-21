<?php

namespace Bundle\Entity\User;

interface UserEntityInterface
{
    public function getUsers(int $skip = 0, int $take = 20);

    public function getUser(?string $data, string $column = 'id');

    public function update(array $data);

    public function delete(?string $data, string $column = 'id');

    public function insert(array $data);
}