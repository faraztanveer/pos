<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{


    public function products()
   {
   	return $this->hasMany('App\product','cat_id');
   }
   
   public function gProducts()
   {
   	return $this->hasMany('App\product','genCat_id');
   }


}
