<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class quiz_submission_master extends Model
{
    //
    protected $guarded = ['id', 'created_at', 'updated_at'];
    
    public function quiz_submission(){
        return $this->hasMany(quiz_submission::class,'id_master','id');
    }
    
    public function child(){
        return $this->hasOne(child::class,'id','id_child');
    }
}
