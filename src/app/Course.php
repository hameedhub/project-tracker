<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';
    protected $primaryKey = 'id'; 

    public function user(){
        return $this->belongsTo('App\User');
    }
}
