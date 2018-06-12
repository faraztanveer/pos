<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\bill;

class BillController extends Controller
{
   public function index()
   {
   $bills=bill::all();
// foreach($bills->billDetail as $bt)
// {
//     dd($bt->productControl->products->name);
// }
   // dd($bills->customer->phone);
       return view('admin.pos.bills',compact('bills'));

   }

public function update(Request $request){

    $bill = bill::find($request->id);
    $bill->paidAmount = $request->paid;
    $bill->save();
return response()->json($bill);

}

public function destroy($id)
{

bill::destroy($id);
$status=true;
return response()->json($status);

}
public function show($id)
{
$bills=bill::find($id);

// $details = array_fill_keys(
//     array('name','size','color','quantity','discount','total'), '');
$details= array();
foreach($bills->billDetail as $bt)
{
    $details[] = array('name'=>$bt->productControl->products->name,'size'=>$bt->productControl->size,'color'=>$bt->productControl->color,'quantity'=>$bt->quantity,'discount'=>$bt->discount,'total'=>$bt->total);
}


return response()->json(array('bill'=>$bills,'billDetail'=>$bills->billDetail,'customer'=>$bills->customer,'customer'=>$bills->customer,'details'=>$details));

    
}


}
