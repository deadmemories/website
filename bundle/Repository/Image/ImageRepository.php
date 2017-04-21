<?php

namespace Bundle\Repository\Image;

use App\Eloquent\Image;
use App\Eloquent\User;

class ImageRepository implements ImageRepositoryInterface
{
    /**
     * @var Image
     */
    protected $eloquent;

    /**
     * ImageEntity constructor.
     * @param Image $eloquent
     */
    public function __construct(Image $eloquent)
    {
        $this->eloquent = $eloquent;
    }

    /**
     * @param $data
     * @param string $column
     * @return mixed
     */
    public function getImage($data, string $column)
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
     * @param string $data
     * @param string $column
     * @return mixed
     */
    public function delete($data, string $column)
    {
        return $this->eloquent->where($column, $data)->delete();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getUserImage(int $id)
    {
        return $this->eloquent->where('bundle', User::class)->where('entity_id', $id)->first();
    }
}