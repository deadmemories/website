<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';

    public $fillable = ['notifitable_id', 'notifitable_type', 'body'];
}