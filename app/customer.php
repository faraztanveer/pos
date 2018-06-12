<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    

    public function bills()
    {
        return $this->hasMany('App\bill','customer_id');
    }

    public function town()
{
    return $this->belongsTo('App\town','location_id');
}


}
