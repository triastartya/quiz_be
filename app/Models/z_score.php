<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class z_score extends Model
{
    //
    protected $guarded = ['id', 'created_at', 'updated_at'];


    function child(){
        return $this->hasOne(child::class,'id','id_childern');
    }
    function feedback(){
        return $this->hasOne(feedback::class,'kondisi','kondisi');
    }
}
