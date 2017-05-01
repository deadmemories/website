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
     * @param string $column
     * @param $data
     * @return mixed
     */
    public function getImage(string $column, $data)
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
    public function save(array $data)
    {
        return $this->eloquent->create($data);
    }

    /**
     * @param string $column
     * @param $data
     * @return mixed
     */
    public function delete(string $column, $data)
    {
        return $this->eloquent->where($column, $data)->delete();
    }
}