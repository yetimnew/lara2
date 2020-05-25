<?php

namespace App;

use App\Truck;
use App\Driver;
use App\Performance;
use DateTime;
use Illuminate\Database\Eloquent\Model;

class DriverTuck extends Model
{
    protected $table = 'driver_truck';
    protected $dates = ['deleted_at', 'date_recived', 'date_detach',];

    protected $fillable = [
        'id',
        'driver_id',
        'driverid',
        'truck_id',
        'plate',
        'date_recived',
        'date_detach',
        'reason',
        'is_attached',
        'deleted_at',
        'status'
    ];


    public function scopeActive($query)
    {
        return $query->where("status", "=", 1);
    }
    public function scopeIsattached($query)
    {
        return $query->where("is_attached", "=", 1);
    }

    public function performances()
    {
        return $this->belongsToMany('App\Performance');
    }
    public function getDateDifferenceAttribute()
    {
        $date_recived = new DateTime($this->date_recived);
        $date_detach = new DateTime($this->date_detach);
        $diff =  $date_detach->diff($date_recived);
        $formated = $diff->d . ' days ' . $diff->h . ' hours ' .  $diff->i . ' miniutes';
        return $formated;
    }
}
