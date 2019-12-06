<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    protected $table = 'assessments';
    protected $primaryKey = 'id'; 

    public function user(){
        return $this->belongsTo('App\User');
    }
}
