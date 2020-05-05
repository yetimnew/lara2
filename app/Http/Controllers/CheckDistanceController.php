<?php

namespace App\Http\Controllers;

use App\Distance;

class CheckDistanceController extends Controller
{
    public function check_distance($id)
    {
        $distance = Distance::findOrFail($id);
        return $distance;
    }
}
