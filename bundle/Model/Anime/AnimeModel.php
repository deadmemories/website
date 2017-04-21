<?php

namespace Bundle\Model\Anime;

use Bundle\Repository\Anime\AnimeRepository;
use Bundle\ResponseApi\Response;

class AnimeModel
{
    /**
     * @var AnimeRepository
     */
    protected $entity;

    /**
     * @var Response
     */
    protected $response;

    /**
     * AnimeRepository constructor.
     * @param AnimeRepository $entity
     * @param Response $response
     */
    public function __construct(AnimeRepository $entity, Response $response)
    {
        $this->entity = $entity;
        $this->response = $response;
    }

    /**
     * @param int $skip
     * @param int $take
     * @return \Illuminate\Http\JsonResponse
     */
    public function allAnime(int $skip = 0, int $take = 20): \Illuminate\Http\JsonResponse
    {
        $anime = $this->entity->allAnime($skip, $take);

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
        $anime = '';
//        $make = app()->make('MakeSingle');

        return response()->json(
            $this->response->add('response', $anime)->response(), 200
        );
    }
}