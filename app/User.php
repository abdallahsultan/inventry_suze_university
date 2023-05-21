<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Cache;

class User extends Authenticatable {
	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password','phone','faculty_id',
	];
	protected $appends=['is_online',];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	public function receiver_stock()
    {
        return $this->belongsTo(Faculty::class,'receiver_stock');
    }
	public function senter_stock()
    {
        return $this->belongsTo(Faculty::class,'senter_stock');
    }

	public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }
	public function getIsOnlineAttribute()
    {
       
		if (Cache::has('is_online' . $this->id))
			// return  $this->name . " is online. <br>";
			return 1;
		else
			return 0;
			// return $this->name . " is offline <br>";
        
    }
	
	

}
