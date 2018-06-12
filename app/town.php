<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class town extends Model
{
    protected $table='towns';

    
    public function customers()
    {
        return $this->hasMany('App\customer','location_id');
    }

}
