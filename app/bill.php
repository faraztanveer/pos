<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bill extends Model
{
        protected $table='bill';

   public function billDetail()
   {
       return $this->hasMany('App\billDetail','bill_id');
   }
   public function customer()
   {
       return $this->belongsTo('App\customer','customer_id');
   }

}
