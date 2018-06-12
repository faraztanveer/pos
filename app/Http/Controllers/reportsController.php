<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\carbon;
use App\bill;
use DB;
use League\Csv\Writer;
use App\productControl;
use App\product;
class reportsController extends Controller
{
    public function index(){
      
        return view('admin.pos.reports');
    }

    public function summary(){


        $totalInventory = product::where('admin_id',1)->get();
        $sum=0;
        $value=0;
        
        foreach($totalInventory as $ti)
        {

foreach($ti->productControls as $pc)
{
  $value+=$pc->quantity*$ti->base_price;
  $sum+=$pc->quantity;
}
        }
   
        return view('admin.pos.summaryReport',compact('sum','value'));
    }
    public function getReport(Request $request)
    {
        $currentDate= carbon::now();
    $dateRange=$request->dateRange;
    $from=$request->from;
    $to=$request->to;

    if(($dateRange!="" && $dateRange!="allTime"))
    {
        //------ csv----
        // $csv = Writer::createFromFileObject(new \SplTempFileObject());
        // $csv->insertOne(['product name', 'product size', 'product color','product quantity','product discount','total']);
        
        // $csv->output('summary.csv');
        //-------csv--------   
       
        $newDate=$currentDate->subDays($dateRange);
     // DB::table('bill')->whereDay('created_at','>',$newDate->format('D'));
$bills=bill::where('created_at','>=',$newDate)->get();
    }
    $details= array();
    foreach($bills as $bill){

    
    foreach($bill->billDetail as $bt)
    {
        $details[] = array('name'=>$bt->productControl->products->name,'size'=>$bt->productControl->size,'color'=>$bt->productControl->color,'quantity'=>$bt->quantity,'discount'=>$bt->discount,'total'=>$bt->total);
    }

    }
    $abc=array_sum(array_column($details, 'quantity'));






      return response()->json(['abc'=>$abc,'details'=>$details]);  

    }

}
