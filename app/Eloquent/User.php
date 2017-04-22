<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    /**
     * @return mixed
     */
    public function avatar()
    {
        return $this->morphOne(Image::class, 'imagetable')->where('status', 1);
    }
}