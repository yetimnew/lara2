<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = '/dasboard';
    // dd()
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
//     public function redirectTo(){
// // return '/dashboard';
// // $request->all();
//         $role =Auth::user()->roles()->pluck('name')->implode(' ');
//        dd( $role);
//         // Check user role
//         switch ($role) {
//             case 'admin':
//                     return '/dashboard';
//                 break;
//             case 'driver':
//                     return '/driver_dashboard';
//                 break;
//             default:
//                     return '/login';
//                 break;
//         }
//     }
}
