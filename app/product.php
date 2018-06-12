<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    //

public function ProductControls()
{
    return $this->hasMany('App\Productcontrol','product_id');
}



public function brand()
{

       return $this->belongsTo('App\brand','brand_id');

}

public function category()
{

       return $this->belongsTo('App\category','cat_id');

}

public function generalCategory()
{

       return $this->belongsTo('App\category','genCat_id');

}

public function admin()
{
	return $this->belongsTo('App\User','admin_id');
}







}
