<?php

namespace Bundle\Model\Image;

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
     * @return array
     */
    public function saveImage(array $images, string $service): array
    {
        $width = InfoForImage::getInfo($service, 'width');
        $height = InfoForImage::getInfo($service, 'height');
        $path = InfoForImage::getInfo($service, 'path');
        $response = [];

        foreach ($images as $k => $v) {
            $cloudImageName = strOther(
                    $v->getClientOriginalName(), 'image'
                ).time().'.'.explode('/', $v->getMimetype())[1];

            LImage::make($v->getRealPath())
                  ->resize($width, $height)
                  ->save(public_path('images/'.$path.'/'.$cloudImageName));

            $response[$k]['name'] = $cloudImageName;
            $response[$k]['mimetype'] = $v->getMimeType();
        }

        return $response;
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