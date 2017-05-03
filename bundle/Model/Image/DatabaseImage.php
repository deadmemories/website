<?php

namespace Bundle\Model\Image;

use Bundle\Repository\Image\ImageRepositoryInterface;
use Bundle\Traits\ImagesHelper;

class DatabaseImage
{
    use ImagesHelper;

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
    public function getImage(string $column = 'id', $data)
    {
        return $this->entity->getImage($column, $data);
    }

    /**
     * @param array $photos
     * @param string $service
     * @param bool $system
     * @return array
     */
    public function insert(array $photos, string $service, bool $system = false): array
    {
        $response = [];
        $path = InfoForImage::getInfo($service, 'path');
        $bundle = InfoForImage::getInfo($service, 'bundle');
        $src = InfoForImage::SRC;

        foreach ($photos as $k => $v) {
            $v['imagetable_type'] = $bundle;
            $v['name'] = ! $system
                ? $src.$path.'/'.$v['name']
                : $src.$v['name'];

            $response[] = $this->entity->save($v);
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
                'key' => [
                    'imagetable_id' => $user,
                    'name' => 'default.jpg',
                    'mimetype' => 'image/jpeg',
                ],
            ],
            $service, true
        );
    }

    /**
     * @param string $column
     * @param null|string $data
     * @return mixed
     */
    public function delete(string $column = 'id', $data)
    {
        return $this->entity->delete($column, $data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data)
    {
        $eloquent = $this->getImage('id', $id);

        if ($eloquent) {
            foreach ($data as $k => $v) {
                $eloquent->$k = $v;
            }

            $eloquent->save();

            return $eloquent;
        }

        return false;
    }
}