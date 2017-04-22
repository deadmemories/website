<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    /**
     * @var string
     */
    protected $table = 'anime';

    /**
     * @return mixed
     */
    public function preview()
    {
        return $this->morphOne(Image::class, 'imagetable')->where('status', 1);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}