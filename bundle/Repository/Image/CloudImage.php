<?php

namespace Bundle\Repository\Image;

use Bundle\Entity\Image\InfoForImage;
use Illuminate\Support\Facades\Storage;

class CloudImage
{
    /**
     * @var Storage
     */
    protected $storage;

    /**
     * CloudImage constructor.
     * @param Storage $storage
     */
    public function __construct(Storage $storage)
    {
        $this->storage = $storage;
    }

    /**
     * @param array $images
     * @param string $service
     * @return bool
     */
    public function saveImage(array $images, string $service): bool
    {
        $width = InfoForImage::getInfo($service, 'width');
        $height = InfoForImage::getInfo($service, 'height');
        $path = InfoForImage::getInfo($service, 'path');

        foreach ($images as $k => $v) {
            $cloudImageName = strOther(
                    $v->getClientOriginalName(), 'image'
                ).time().'.'.explode('/', $v->getMimetype())[1];

            LImage::make($v->getRealPath())
                  ->resize($width, $height)
                  ->save(public_path('images/'.$path.'/'.$cloudImageName));
        }

        return true;
    }

    /**
     * @param string $name
     * @param string $dir
     * @return bool
     */
    public function deleteImageDir(string $name, string $dir): bool
    {
        return $this->storage->delete('/images/'.$dir.'/'.$name);
    }

    /**
     * @param string $oldName
     * @param string $newName
     * @param string $dir
     * @return bool
     */
    public function renameImageDir(string $oldName, string $newName, string $dir): bool
    {
        return $this->storage->move('images/'.$dir.'/'.$oldName, 'images/'.$dir.'/'.$newName);
    }
}