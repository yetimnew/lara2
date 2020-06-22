<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Woreda extends Model
{
    protected $fillable = [
        'id',
        'name',
        'region_id',
        'zone_id',
        'comment',
        'status'
    ];



    public function zone()
    {
        return $this->belongsTo('App\Zone');
    }

    public function places()
    {
        return $this->hasMany('App\Place');
    }

}
