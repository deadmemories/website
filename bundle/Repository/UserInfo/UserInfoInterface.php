<?php

namespace Bundle\Repository\UserInfo;

interface UserInfoInterface
{
    public function getUser($data, string $column);

    public function update(array $data);

    public function insert(array $data);

    public function delete($data, string $column);
}