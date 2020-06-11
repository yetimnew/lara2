<?php

namespace App;

use App\Region;
use App\Customer;
use App\Performance;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{

    protected $gurded = [];
    protected $dates = ['startdate', 'enddate', 'deleted_at'];

    public function scopeActive($query)
    {
        return $query->where("status", "=", 1);
    }
    public function scopeClosed($query)
    {
        return $query->where("closed", 0);
    }
    public function scopeOpen($query)
    {
        return $query->where("closed", "=", 1);
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function region()
    {
        return $this->belongsTo('App\Region');
    }
    public function performances()
    {
        return $this->belongsToMany('App\Performance');
    }
    public function osperformances()
    {
        return $this->hasMany('App\Outsource_performance');
    }
}
