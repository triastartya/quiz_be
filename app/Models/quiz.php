<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class quiz extends Model
{
    //
    protected $guarded = ['id', 'created_at', 'updated_at'];

    function soal(){
        return $this->hasMany(quiz_soal::class,'id_quiz','id');
    }
}
