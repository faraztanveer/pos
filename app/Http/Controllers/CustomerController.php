<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\customer;

class CustomerController extends Controller
{



public function submit(Request $request)
{

    $customer= new customer;
    $customer->name=$request->cName;
    $customer->location_id=$request->cTown;
    $customer->phone=$request->cPhone;
    $customer->save();
    return response()->json($customer);
    
    


}




}
