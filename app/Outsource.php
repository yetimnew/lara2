<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outsource extends Model
{
    protected $fillable =
     [
     'id',
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

     ];
    protected $dates = ['deleted_at','DateDispach'];
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
