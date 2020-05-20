<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outsource extends Model
{
    protected $guarded = [];
    protected $dates = ['deleted_at'];
    public function operations()
    {
        return $this->hasMany('App\Operation');
    }
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    public function scopeInActive($query)
    {
        return $query->where('status', 0);
    }
}
