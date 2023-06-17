<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ProductQuntity extends Model
{
    protected $guarded = ['id'];
    protected $appends=['month','month_number','category_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getMonthAttribute()
    {
        // return $this->hasMany(Product::class)->where('is_active',true);
        
        return Carbon::parse($this->created_at)->format('F');
    
       
    }
    public function getMonthNumberAttribute()
    {
        // return $this->hasMany(Product::class)->where('is_active',true);
        
        return (int) Carbon::parse($this->created_at)->format('m');
    
       
    }
    public function getCategoryIdAttribute()
    {
        // return $this->hasMany(Product::class)->where('is_active',true);
        
        return $this->product->category->id;
    
       
    }

}
