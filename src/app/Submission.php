<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $table = 'submissions';
    protected $primaryKey = 'id'; 

    public function user(){
        return $this->belongsTo('App\User');
    }
}
