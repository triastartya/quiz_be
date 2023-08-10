<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class quiz_submission extends Model
{
    //
    protected $guarded = ['id', 'created_at', 'updated_at'];
    
    public function quiz(){
        return $this->hasOne(quiz::class,'id','id_quiz');
    }

}
