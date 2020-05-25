<?php

namespace App;

use App\User;
use App\Truck;
use App\Driver;
use App\Operation;
use Carbon\Carbon;
use App\DriverTuck;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

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
        'returned_date',
        'satus',
        'user_id'

    ];
    protected $dates = ['DateDispach', 'deleted_at', 'returned_date'];
    // protected $append=['noOfDateItTakes'];
    public function operation()
    {
        return $this->belongsTo('App\Operation');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
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
        return $query->where("is_returned", "=", 1)->where("satus", "=", 1)->where("trip", "=", 1);
    }
    public function scopeNotReturned($query)
    {
        return $query->where("is_returned", "=", 0)->where("satus", "=", 1)->where("trip", "=", 1);
    }
    public function scopeActive($query)
    {
        return $query->where("satus", "=", 1);
    }
    public function scopeOpen($query)
    {
        return $query->where("closed", "=", 1);
    }

    public function scopeMainTrip($query)
    {
        return $query->where("trip", "=", 1);
    }
    public function scopeMaintrip_returned($query)
    {
        return $query->where("trip", "=", 1)->where("is_returned", "=", 1)->where("satus", "=", 1);
    }
    public function scopeMaintrip_notreturned($query)
    {
        return $query->where("trip", "=", 1)->where("is_returned", "=", 0)->where("satus", "=", 1);
    }


    public function getDateDifferenceAttribute()
    {
        $dispach_date = new DateTime($this->DateDispach);
        $retun_date = new DateTime($this->returned_date);
        $diff =  $retun_date->diff($dispach_date);
        $formated = $diff->d . ' days ' . $diff->h . ' hours ' .  $diff->i . ' miniutes';
        return $formated;
    }

    public function getTotalKmAttribute()
    {
        $dwc = $this->DistanceWCargo;
        $dwoc = $this->DistanceWOCargo;
        $totaldistance = $dwc +  $dwoc;
        return $totaldistance;
    }
    public function getDateDispachAtribute()
    {
        $DateDispach = $this->DateDispach;
        return Carbon::parse($DateDispach)->format('d-m-Y');
        // $totaldistance;
    }
}
