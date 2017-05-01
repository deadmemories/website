<?php

namespace Bundle\Model\Image;

use Bundle\Traits\ImagesHelper;
use Illuminate\Support\Facades\Storage;

class CloudImage
{
    use ImagesHelper;

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
        $src = InfoForImage::SRC;
        $response = [];

        foreach ($images as $k => $v) {
            $cloudImageName = $this->checkName(
                $v->getClientOriginalName().time().'.'.explode('/', $v->getMimetype())[1]
            );

            \LImage::make($v->getRealPath())
                   ->resize($width, $height)
                   ->save(public_path($src.$path.'/'.$cloudImageName));

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
    public function deleteImage(string $name, string $dir): bool
    {
        return Storage::delete(InfoForImage::SRC.$dir.'/'.$name);
    }

    /**
     * @param string $oldName
     * @param string $newName
     * @param string $dir
     * @return bool
     */
    public function renameImage(string $oldName, string $newName, string $dir): bool
    {
        return Storage::move($oldName, InfoForImage::SRC.$dir.'/'.$newName);
    }
}