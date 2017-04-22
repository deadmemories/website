<?php

namespace Bundle\Model\Anime;

use Bundle\ParseForResponse\ParseAnime;
use Bundle\Repository\Anime\AnimeRepository;
use Bundle\ResponseApi\Response;

class AnimeModel
{
    /**
     * @var AnimeRepository
     */
    protected $repository;

    /**
     * @var Response
     */
    protected $response;

    /**
     * AnimeRepository constructor.
     * @param AnimeRepository $repository
     * @param Response $response
     */
    public function __construct(AnimeRepository $repository, Response $response)
    {
        $this->repository = $repository;
        $this->response = $response;
    }

    /**
     * @param int $skip
     * @param int $take
     * @return \Illuminate\Http\JsonResponse
     */
    public function allAnime(int $skip = 0, int $take = 20): \Illuminate\Http\JsonResponse
    {
        $anime = ParseAnime::parseAllAnime($this->repository->allAnime($skip, $take));

        return response()->json(
            $this->response->add('response', $anime)->response(), 200
        );
    }

    /**
     * @param $data
     * @param string $column
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAnime($data, string $column = 'id'): \Illuminate\Http\JsonResponse
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

        return response()->json(
            $this->response->add('response', $anime)->response(), 200
        );
    }
}