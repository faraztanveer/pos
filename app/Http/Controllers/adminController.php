<?php

namespace App\Http\Controllers;
use App\category;
use App\brand;
use App\product;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\csvlogs;
use League\Csv\Writer;



class adminController extends Controller
{
    
    public function index(){

        $date = Carbon::now();
        $currentYear= $date->format('Y');
        $currentMonth= $date->format('F');
        $currentWeek= $date->weekOfMonth;
        
 if($date->format('d')=='1')
 {
    
    $csvDate= csvlogs::select('created_at')->orderBy('id', 'desc')->first();
  
    if($csvDate !=null)
    {
    $csvDate->toArray();
    $csvDate=Carbon::parse($csvDate['created_at']);
}

else{
    $csvDate=Carbon::tomorrow();
    
}
    if($date->format('d Y F') != $csvDate->format('d Y F'))
    {
        
        $data=DB::select('SELECT category,location,month,count(id) as itemSold FROM data_sets GROUP by category,month,location');
     
    $csv = Writer::createFromPath('data_set.csv');
    $csv->insertOne(['category', 'location', 'month','item sold']);
    for($i=0; $i<count($data); $i++)
    {
       
        $csv->insertOne([$data[$i]->category, $data[$i]->location, $data[$i]->month ,$data[$i]->itemSold]);

      

    }
    
    
        $csvlogs = new csvlogs;
        $csvlogs->activity='inserted';
        $csvlogs->save();
    
    }

 }
        
 



       $id=Auth::user()->id;
        
$productCount=product::where('admin_id',$id)->count();
$categoryCount=category::where('admin_id',$id)->count();
$brandCount=brand::where('admin_id',$id)->count();
$monthlyReport= DB::select("SELECT COUNT(id) as totalSale, month FROM data_sets GROUP BY month order by (case month when 'january' then 1 when 'february' then 2 when 'march' then 3 when 'april' then 4 when 'may' then 5 when 'june' then 6 when 'july' then 7 when 'august' then 8 when 'september' then 9 when 'october' then 10 when 'november' then 11 when 'december' then 12 END)");
$month=[];
$totalSale=[];
$i=0;
foreach($monthlyReport as $monthlyReport)
{
    $month[$i]=$monthlyReport->month;
    $totalSale[$i]=$monthlyReport->totalSale;
    $i++;

}


//------------- daily report


$dailyReport= DB::select("SELECT COUNT(id) as totalSale, day FROM data_sets WHERE year=$currentYear AND month='$currentMonth' AND week='$currentWeek' GROUP BY day order by (case day when 'sun' then 1 when 'mon' then 2 when 'tue' then 3 when 'wed' then 4 when 'thu' then 5 when 'fri' then 6 when 'sat' then 7 END)");
//dd($dailyReport);
$days=[];
$dTotalSale=[];
$i=0;
foreach($dailyReport as $dailyReport)
{
    $days[$i]=$dailyReport->day;
    $dTotalSale[$i]=$dailyReport->totalSale;
    $i++;

}




//--------------------------






$chartjs = app()->chartjs
        ->name('lineChartTest')
        ->type('line')
        ->size(['width' => 400, 'height' => 200])
        ->labels($month)
        ->datasets([
            [
                "label" => "monthly sale record",
                'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $totalSale,
            ]
        ])
        ->options([]);


        $chartjs2 = app()->chartjs
        ->name('dailyChart')
        ->type('line')
        ->size(['width' => 400, 'height' => 200])
        ->labels($days)
        ->datasets([
            [
                "label" => "daily sale record",
                'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $dTotalSale,
            ]
        ])
        ->options([]);

        $categoryReport= DB::select("SELECT category , count(category) as totalCat FROM data_sets WHERE admin_id=$id GROUP by category order by totalCat");
$catName=[];
$totalCount=[];
$i=0;

 foreach($categoryReport as $cat)
 {
    $catName[$i]=$cat->category;
    $totalCount[$i]=$cat->totalCat;
    $i++;
 }
        $chartjs1 = app()->chartjs
        ->name('chartjs1')
        ->type('bar')
        ->size(['width' => 400, 'height' => 200])
        ->labels($catName)
        ->datasets([
            [
                "label" => "sale by category",
                'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $totalCount,
            ]
        ])
        ->options([]);


//---------------------
$brandReport= DB::select("SELECT brand , count(brand) as totalBrand FROM data_sets WHERE admin_id=$id GROUP by brand order by totalBrand");
$brandName=[];
$bTotalCount=[];
$i=0;

 foreach($brandReport as $brand)
 {
    $brandName[$i]=$brand->brand;
    $bTotalCount[$i]=$brand->totalBrand;
    $i++;
 }
        $brandChart = app()->chartjs
        ->name('brandChart')
        ->type('pie')
        ->size(['width' => 400, 'height' => 200])
        ->labels($brandName)
        ->datasets([
            [
                "label" => "brands",
                'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $bTotalCount,
            ]
        ])
        ->options([]);

//----------------------------


return view('admin.index',compact(['productCount','categoryCount','brandCount','chartjs','chartjs1','chartjs2','brandChart']));

    }

}
