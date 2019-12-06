<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    //

    protected $table = 'sets';
    protected $primaryKey = 'id';

    public function user(){
        return $this->belongsTo('App\User');
    }
}
