<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = ['id'];
    protected $appends=['qty','all_qty','monitor_inventory_auto','minimum_qty','my_monitor_inventory_auto','my_minimum_qty'];

    protected $hidden = ['created_at','updated_at'];

    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function ProductQuntities()
    {
        // return $this->hasMany(Product::class)->where('is_active',true);
        return $this->hasMany(ProductQuntity::class);
    }
    
    public function faculties()
    {
        return $this->belongsToMany(Faculty::class, 'product_quntities');
        // ->using(ProductQuntity::class);
        // ->withPivot(['id', 'value','value_en', 'field_type','advertisement_id'])
        // ->as('fields_values');
    }     
   
    public function getAllQtyAttribute()
    {
        // return $this->hasMany(Product::class)->where('is_active',true);
        
        
            return $this->ProductQuntities()->where('type','in')->sum('qty') - $this->ProductQuntities()->where('type','out')->sum('qty');
      
  
       
    }
    public function getQtyAttribute()
    {
        // return $this->hasMany(Product::class)->where('is_active',true);
        
      
        if(auth()->user()->faculty->id){
            // return $this->ProductQuntities()->where('faculty_id',auth()->user()->faculty->id)->max('qty');
            return $this->ProductQuntities()->where('faculty_id',auth()->user()->faculty->id)->where('type','in')->sum('qty') - $this->ProductQuntities()->where('faculty_id',auth()->user()->faculty->id)->where('type','out')->sum('qty');
        }else{
            return '---';
        }
  
       
    }
 
    public function getMyMinimumQtyAttribute()
    {
        $user=auth()->user();
        $faculty_id=$user->faculty->id;
        $minimumqty=$this->ProductQuntities()->where('faculty_id',$faculty_id)->where('main',1)->first() ?? null;
         return $minimumqty->minimum_qty ?? '';
  
       
    }
    public function getMyMonitorInventoryAutoAttribute()
    {
        $user=auth()->user();
        $faculty_id=$user->faculty->id;
    
         $moitorInvenotry=$this->ProductQuntities()->where('faculty_id',$faculty_id)->where('main',1)->first() ?? null;
         return $moitorInvenotry->monitor_inventory_auto ?? '';
     
       
       
    }
    public function getMinimumQtyAttribute()
    {
        $minimumqty=$this->ProductQuntities()->where('main',1)->first();
         return $minimumqty->minimum_qty;
  
       
    }
    public function getMonitorInventoryAutoAttribute()
    {
         $moitorInvenotry=$this->ProductQuntities()->where('main',1)->first();
         return $moitorInvenotry->monitor_inventory_auto;
     
       
       
    }
}
