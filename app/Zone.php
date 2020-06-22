<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    protected $fillable = [
        'id',
        'name',
        'region_id',
        'comment',
        'status'
    ];

    public function region()
    {
        return $this->belongsTo('App\Region');
    }

    public function woredas()
    {
        return $this->hasMany('App\Woreda');
    }



    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
