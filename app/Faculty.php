<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $guarded = ['id'];

    public function notifications()
    {
        return $this->morphMany(Notification::class,'notifiable');
        
    }
    // public function get_notifications()
    // {
    //     return $this->hasMany(Notification::class,'faculty_id');
        
    // }
    
}
