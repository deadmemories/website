<?php

namespace Bundle\Repository\Anime;

interface AnimeRepositoryInterface
{
    public function allAnime(int $skip, int $take);

    public function getAnime($data, string $column);

    public function update(array $data);

    public function insert(array $data);

    public function delete($data, string $column);
}