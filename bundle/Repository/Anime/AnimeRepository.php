<?php

namespace Bundle\Repository\Anime;

use App\Eloquent\Anime;

class AnimeRepository implements AnimeRepositoryInterface
{
    /**
     * @var User
     */
    protected $eloquent;

    /**
     * UserEntity constructor.
     * @param Anime $eloquent
     */
    public function __construct(Anime $eloquent)
    {
        $this->eloquent = $eloquent;
    }

    /**
     * @param int $skip
     * @param int $take
     * @return mixed
     */
    public function allAnime(int $skip, int $take)
    {
        return $this->eloquent->skip($skip)->take($take)->get();
    }

    /**
     * @param $data
     * @param string $column
     * @return mixed
     */
    public function getAnime($data, string $column)
    {
        return $this->eloquent->where($column, $data)->first();
    }


    /**
     * @param array $data
     * @return bool
     */
    public function update(array $data)
    {
        return $this->eloquent->update($data);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function insert(array $data)
    {
        return $this->eloquent->insert($data);
    }

    /**
     * @param null|string $data
     * @param string $column
     * @return mixed
     */
    public function delete($data, string $column)
    {
        return $this->eloquent->where($column, $data)->delete();
    }
}