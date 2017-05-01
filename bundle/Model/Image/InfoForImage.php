<?php

namespace Bundle\Model\Image;

use App\Eloquent\Anime;
use App\Eloquent\User;

final class InfoForImage
{
    public const SRC = 'images/';

    protected static $infoImage = [
        'user' => [
            'width' => 500,
            'height' => 400,
            'path' => 'user',
            'bundle' => User::class,
        ],
        'anime' => [
            'width' => 800,
            'height' => 700,
            'path' => 'anime',
            'bundle' => Anime::class,
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