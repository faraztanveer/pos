<?php

namespace App;

use App\product;
use Illuminate\Database\Eloquent\Model;

class brand extends Model
{


   public function products()
   {
   	return $this->hasMany('App\product','brand_id');
   }

   



}
