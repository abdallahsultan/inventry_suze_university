<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Depreciation extends Model
{
    protected $guarded = ['id'];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }
}
