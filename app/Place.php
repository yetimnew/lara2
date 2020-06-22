<?php

namespace App;

use App\Region;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable = [
        'id',
        'name',
        'region_id',
        'comment',
        'status'
    ];

    public function woreda()
    {
        return $this->belongsTo('App\Woreda');
    }
    public function scopeActive($query)
    {
      return $query->where('status',1);
    }
}
