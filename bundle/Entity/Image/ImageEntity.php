<?php

namespace Bundle\Entity\Image;

use App\Eloquent\Image;
use App\Eloquent\User;

class ImageEntity implements ImageEntityInterface
{
    /**
     * @var Image
     */
    protected $image;

    /**
     * ImageEntity constructor.
     * @param Image $image
     */
    public function __construct(Image $image)
    {
        $this->image = $image;
    }

    /**
     * @param string $column
     * @param null|string $data
     * @return mixed
     */
    public function getImage(string $column = 'id', ?string $data)
    {
        return $this->image->where($column, $data)->first();
    }


    /**
     * @param array $data
     * @return bool
     */
    public function update(array $data)
    {
        return $this->image->update($data);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function insert(array $data)
    {
        return $this->image->insert($data);
    }

    /**
     * @param string $column
     * @param null|string $data
     * @return mixed
     */
    public function delete(string $column = 'id', ?string $data)
    {
        return $this->image->where($column, $data)->delete();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getUserImage(int $id)
    {
        return $this->image->where('bundle', User::class)->where('entity_id', $id)->first();
    }
}