<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class billDetail extends Model
{
   public function bill(){

return $this->belongsTo('App\bill','bill_id');

   }

   public function productControl()
   {
       return $this->belongsTo('App\Productcontrol','pc_id');
   }

}
