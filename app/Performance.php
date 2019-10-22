<?php

namespace App;

use App\Truck;
use App\Driver;
use App\Operation;
use Carbon\Carbon;
use App\DriverTuck;
use Illuminate\Database\Eloquent\Model;
// use Carbon\Carbon;

class Performance extends Model
{
    protected $fillable = [
        'id',
        'LoadType',
        'FOnumber',
        'operation_id',
        'driver_truck_id',
        'DateDispach',
        'orgion_id',
        'destination_id',
        'DistanceWCargo',
        'DistanceWOCargo',
        'CargoVolumMT',
        'fuelInLitter',
        'fuelInBirr',
        'perdiem',
        'workOnGoing',
        'other',
        'comment',
        'DateRegistered',
        'satus',

    ];
    protected $dates = ['DateDispach'];
    // protected $append=['noOfDateItTakes'];
    public function operation()
    {
        return $this->belongsTo('App\Operation');
    }
      
    public function orgion()
    {
        return $this->belongsTo('App\Place');
    }
    public function destination()
    {
        return $this->belongsTo('App\Place');
    }

    public function driver_truck()
    {
        return $this->belongsTo('App\DriverTuck');
    }

    public function scopeReturned($query)
    {
        return $query->where("is_returned", "=",0)->where("satus", "=",1);
    }
    public function scopeNotReturned($query)
    {
        return $query->where("is_returned", "=",1)->where("satus", "=",1);
    }
    public function scopeActive($query)
    {
        return $query->where("satus", "=",1);
    }
    public function dateReturnded($query)
    {
        $dt = Carbon::now();

        // return $query->whereBetween("performances.DateDispach", [$first->toDateTimeString(), $second->toDateTimeString()]).
    }

 public function noOfDateItTakes()
 {
     $dt = Carbon::now();
     return  $this->attribute['DisapchDate']->toDateString();
 }

}
