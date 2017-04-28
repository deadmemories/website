<?php

namespace Bundle\Model\Anime;

use Bundle\ParseForResponse\ParseAnime;
use Bundle\Repository\Anime\AnimeRepositoryInterface;

class AnimeModel
{
    /**
     * @var AnimeRepositoryInterface
     */
    protected $repository;

    /**
     * AnimeModel constructor.
     * @param AnimeRepositoryInterface $repository
     */
    public function __construct(AnimeRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $skip
     * @param int $take
     * @return mixed
     */
    public function allAnime(int $skip = 0, int $take = 20)
    {
        $anime = ParseAnime::parseAllAnime($this->repository->allAnime($skip, $take));

        return $anime;
    }

    /**
     * @param $data
     * @param string $column
     * @return \Illuminate\Foundation\Application|mixed
     */
    public function getAnime($data, string $column = 'id')
    {
        $anime = app(
            'MakeSingle', [
                $this->repository->getAnime($data, $column),
            ]
        );

//        $array = [
//            'userImage' => ['user.avatar', ['name']],
//            'preview' => ['preview', ['name']],
//        ];

//        $a = $anime->all()->replace($array, 'images')->result();
//        dd($a);

        return $anime;
    }
}