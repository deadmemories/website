<?php

namespace Bundle\Traits;

use App\Eloquent\Image;
use Bundle\Model\Image\InfoForImage;

trait ImagesHelper
{
    /**
     * @param $str
     * @return string
     */
    public function checkName($str): string
    {
        $data = Image::pluck('name', 'id')
                     ->toArray();
        $path = $str;
        if ($data) {
            if (in_array($path, $data)) {
                for ($i = 0; $i < 100; $i++) {
                    $path = "{$str}-{$i}";
                    if (! in_array($path, $data)) {
                        break;
                    }
                }
            }
        }

        return $path;
    }

    /**
     * @param string $title
     * @param int $id
     * @param string $service
     * @param string $path
     * @return string
     */
    public function generateName(string $title, int $id, string $service, string $path = ''): string
    {
        $path = 0 != strlen($path) ? $path : InfoForImage::getInfo($service, 'path');

        return InfoForImage::SRC.$path.'/'.$title.$id;
    }
}