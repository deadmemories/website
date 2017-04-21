<?php

namespace Bundle\Repository\Image;

interface ImageRepositoryInterface
{
    public function update(array $data);

    public function delete($data, string $column);

    public function insert(array $data);

    public function getUserImage(int $id);
}