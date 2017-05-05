<?php

namespace App\Http\Controllers\Anime;

use Bundle\Repository\Anime\AnimeRepositoryInterface;

class AnimeApi
{
    /**
     * @var AnimeRepositoryInterface
     */
    protected $repository;

    /**
     * AnimeApi constructor.
     * @param AnimeRepositoryInterface $repository
     */
    public function __construct(AnimeRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
}