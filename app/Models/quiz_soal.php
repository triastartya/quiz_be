<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class quiz_soal extends Model
{
    //
    protected $guarded = ['id','answer','option', 'created_at', 'updated_at'];

    public function options(){
        return $this->hasMany(quiz_option::class,'id_quiz_soal','id');
    }
}
