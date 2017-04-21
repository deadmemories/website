<?php

namespace Bundle\Entity\Image;

interface ImageEntityInterface
{
    public function update(array $data);

    public function delete(string $column = 'id', ?string $data);

    public function insert(array $data);

    public function getUserImage(int $id);
}