<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductQuntity extends Model
{
    protected $guarded = ['id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
