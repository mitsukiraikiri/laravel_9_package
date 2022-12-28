<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function dashboard(){
        $data['title'] = 'User-Dashboard';
        return view('user.dashboard',$data);
     }
}
