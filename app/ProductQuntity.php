<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ProductQuntity extends Model
{
    protected $guarded = ['id'];
    protected $appends=['month'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getMonthAttribute()
    {
        // return $this->hasMany(Product::class)->where('is_active',true);
        
        return Carbon::parse($this->created_at)->format('F');
    
       
    }

}
