<?php

namespace Bundle\Model\Anime;

use Bundle\ParseForResponse\ParseAnime;
use Bundle\Repository\Anime\AnimeRepository;

class AnimeModel
{
    /**
     * @var AnimeRepository
     */
    protected $repository;

    /**
     * AnimeRepository constructor.
     * @param AnimeRepository $repository
     */
    public function __construct(AnimeRepository $repository)
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