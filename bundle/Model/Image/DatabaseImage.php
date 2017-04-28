<?php

namespace Bundle\Model\Image;

use Bundle\Repository\Image\ImageRepositoryInterface;

class DatabaseImage
{
    protected const SRC = 'images/';

    /**
     * @var ImageRepositoryInterface
     */
    protected $entity;

    /**
     * DatabaseImage constructor.
     * @param ImageRepositoryInterface $entity
     */
    public function __construct(ImageRepositoryInterface $entity)
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
     * @param bool $system
     * @return array
     */
    public function insert(array $photos, string $service, bool $system = true): array
    {
        $response = [];
        $bundle = InfoForImage::getInfo($service, 'bundle');
        $path = InfoForImage::getInfo($service, 'path');

        foreach ($photos as $k => $v) {
            $v['imagetable_type'] = $bundle;
            $v['name'] = $system
                ? self::SRC.$path.'/'.$v['name']
                : self::SRC.$v['name'];

            $response[] = $this->entity->insert($v);
        }

        return $response;
    }

    /**
     * @param int $user
     * @param string $service
     * @return array
     */
    public function insertCommon(int $user, string $service): array
    {
        return $this->insert(
            [
                'imagetable_id' => $user,
                'name' => 'default.jpg',
                'mimetype' => 'image/jpeg',
            ],
            $service, false
        );
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