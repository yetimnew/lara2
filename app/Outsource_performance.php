<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;

class Outsource_performance extends Model
{
    protected $fillable = [
        'outsource_id',
        'trip',
        'LoadType',
        'fonumber',
        'operation_id',
        'driver_name',
        'plate_number',
        'DateDispach',
        'orgion_id',
        'destination_id',
        'tonkm',
        'tariff',
        'DistanceWCargo',
        'DistanceWOCargo',
        'CargoVolumMT',
        'comment',
        'satus',
        'user_id',
        'deleted_at',

    ];
    // protected $table = 'outsource_performances';
    protected $dates = ['DateDispach', 'deleted_at'];

    public function operation()
    {
        return $this->belongsTo('App\Operation');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function outsource()
    {
        return $this->belongsTo('App\Outsource');
    }

    public function orgion()
    {
        return $this->belongsTo('App\Place');
    }
    public function destination()
    {
        return $this->belongsTo('App\Place');
    }

    public function scopeActive($query)
    {
        return $query->where("satus", "=", 1);
    }

    public function scopeMainTrip($query)
    {
        return $query->where("trip", "=", 1);
    }


    public function getTotalKmAttribute()
    {
        $dwc = $this->DistanceWCargo;
        $dwoc = $this->DistanceWOCargo;
        $totaldistance = $dwc +  $dwoc;
        return $totaldistance;
    }
    public function getRevenueAttribute()
    {
        $tonkm = $this->tonkm;
        $tariff = $this->tariff;
        $revenue = $tonkm *  $tariff;
        return $revenue;
    }
}
