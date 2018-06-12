<?php

namespace App\Http\Controllers;
use App\brand;
use App\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
class catBrandController extends Controller
{
    //


    public function index()
    {

    $id=Auth::user()->id;
    $categories= category::where('admin_id',$id)->paginate(10);
    $brands= brand::where('admin_id',$id)->paginate(10);
 
        
return view('admin.cat_brand',compact(['categories','brands']));

    }

    public function storeCat(Request $request)
    {
        $id=Auth::user()->id;
    
    $category = new category;
    //	print_r($request); exit;
    $cat =$request->catName;
    
    $category->admin_id=$id; 
    $category->name=$cat; 
    $category->save();
    
     return response()->json($category);
    
    }



public function storeBrand(Request $request)
{
	$id=Auth::user()->id;

//	print_r($request); exit;
$brandName =$request->brandName;
$brand = new brand;

$brand->admin_id=$id; 
$brand->name=$brandName; 
$brand->save();
 return response()->json($brand);

}


public function destroy($id)
{

category::destroy($id);
$status=true;
return response()->json($status);

}

public function destroyBrand($id)
{

brand::destroy($id);
$status=true;
return response()->json($status);

}

public function brandReport()
{
	$id=Auth::user()->id;
    

    $brandReport= DB::select("SELECT brand , count(brand) as totalBrand FROM data_sets WHERE admin_id=$id GROUP by brand order by totalBrand");
return response()->json($brandReport);

}



}
