<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $table = 'user_info';

    public $timestamps = false;

    protected $fillable = ['user_id', 'login', 'vk', 'twitter', 'skype', 'facebook'];
}