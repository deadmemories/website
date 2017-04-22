<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function image()
    {
        return $this->morphTo();
    }
}