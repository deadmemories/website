<?php

namespace Bundle\Repository\Image;

interface ImageRepositoryInterface
{
    public function update(array $data);

    public function delete(string $column, $data);

    public function save(array $data);

    public function getImage(string $column, $data);
}