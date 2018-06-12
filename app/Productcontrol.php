<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productcontrol extends Model
{
   
public function products()
{
return $this->belongsTo('App\Product','product_id');
}

public $timestamps = true;


public function billDetails()
{
return $this->hasMany('App\billDetail','pc_id');

}


}
