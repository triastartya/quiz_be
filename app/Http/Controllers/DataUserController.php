<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class DataUserController extends Controller
{
    //
    function get(){
        return User::all();
    }
}
