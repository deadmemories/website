<?php

namespace Bundle\Repository\Image;

use Bundle\Entity\Image\ImageEntity;
use Bundle\Entity\Image\InfoForImage;

class DatabaseImage
{
    /**
     * @var ImageEntity
     */
    protected $entity;

    /**
     * DatabaseImage constructor.
     * @param ImageEntity $entity
     */
    public function __construct(ImageEntity $entity)
    {
        $this->entity = $entity;
    }

    /**
     * @param string $column
     * @param null|string $data
     * @return mixed
     */
    public function getImage(string $column = 'id', ?string $data)
    {
        return $this->entity->getImage($column, $data);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getUserAvatar(int $id)
    {
        return $this->entity->getUserImage($id);
    }

    /**
     * @param array $photos
     * @param string $service
     * @return array
     */
    public function save(array $photos, string $service): array
    {
        $response = [];
        $bundle = InfoForImage::getInfo($service, 'bundle');

        foreach ($photos as $k => $v) {
            $v['bundle'] = $bundle;
            $response[] = $this->entity->insert($v);
        }

        return $response;
    }

    /**
     * @param string $column
     * @param null|string $data
     * @return mixed
     */
    public function delete(string $column = 'id', ?string $data)
    {
        return $this->entity->delete($column, $data);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function update(array $data)
    {
        return $this->entity->update($data);
    }
}