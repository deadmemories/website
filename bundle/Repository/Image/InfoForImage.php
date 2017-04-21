<?php

namespace Bundle\Entity\Image;

final class InfoForImage
{
    protected static $infoImage = [
        'user' => [
            'width' => 500,
            'height' => 400,
            'path' => 'user',
            'bundle' => User::class,
        ],
    ];

    /**
     * @param string $service
     * @param string $key
     * @return mixed
     */
    public static function getInfo(string $service, string $key = '')
    {
        if (0 != strlen($key)) {
            return self::$infoImage[$service][$key];
        }

        return self::$infoImage[$service];
    }
}