<?php

namespace Bundle\Token\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $table = 'token';

    public $timestamps = false;

    protected $fillable = ['user_id'];
}