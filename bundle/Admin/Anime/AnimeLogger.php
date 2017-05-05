<?php

namespace Bundle\Admin\Anime;

use Admin\Logger;
use App\Eloquent\UpdatesAnime;

class AnimeLogger
{
    /**
     * @param UpdatesAnime $eloquent
     * @param array $data
     */
    public function save(UpdatesAnime $eloquent, array $data)
    {
        // example
        $data = [
            'user_id' => 1,
            'anime_id' => 50,
            'change' => 'photo', // title, description, etc
            'type' => Logger::$data['change']
        ];
    }
}