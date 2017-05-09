<?php

namespace Bundle\Repository\Notification;

interface NotifyInterface
{
    public function getAll(int $skip, int $take);

    public function getRow($data, string $column);

    public function update(array $data);

    public function save(array $data);

    public function delete($data, string $column);
}