<?php

namespace App;

use App\Operation;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    public function operations()
    {
        return $this->hasMany('App\Operation');
    }
    public function zones()
    {
        return $this->hasMany('App\Zone');
    }

}
