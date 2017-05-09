<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class AdminNotifications extends Model
{
    protected $table = 'notifications';

    public $fillable = ['user_id', 'type', 'body'];
}