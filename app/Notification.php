<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $guarded = ['id'];
    public  $incrementing = true;
    public  $timestamps = false;

    public $table = 'notifications';


    public function notifications()
    {
        return $this->morphTo();
    }
}
