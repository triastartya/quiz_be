<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class child extends Model
{
    //
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function z_score(){
        return $this->hasOne(z_score::class,'id_childern','id')->latest();
    }

    public function quiz_pengetahuan(){
        return $this->hasOne(quiz_submission::class,'id_child','id')->where('jenis_quiz',1)->latest();
    }

    public function quiz_gizi(){
        return $this->hasOne(quiz_submission::class,'id_child','id')->where('jenis_quiz',2)->latest();
    }

    public function quiz_makanan(){
        return $this->hasOne(quiz_submission::class,'id_child','id')->where('jenis_quiz',3)->latest();
    }
    
    public function quiz_submission_master(){
        return $this->hasOne(quiz_submission_master::class,'id_child','id');
    }

}
