<?php

namespace App\Http\Controllers;

use App\Productcontrol;
use App\User;
use App\product;
use App\category;
use App\brand;

//use Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class productsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
      return view('admin.products');
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $id=Auth::user()->id;
        
        $categories = category::where('admin_id',$id)->get();
        $brands = brand::where('admin_id',$id)->get();
        $personalCat = category::where('admin_id',1)->get();


        return view('admin.addProducts',compact('categories','brands','personalCat'));
    }

    public function createProductImages($id)
    {
        return view('admin.addImages');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
         
     $validatedData = $request->validate([
        'name' => 'required|max:30',
         'description' => 'max:500',
         'personal_category' => 'required',
         'general_category' => 'required',
         'currentPrice' => 'required',
          'basePrice' => 'required',
          'size.*' => 'required',
         'color.*' => 'required',
         'quantity.*' => 'required',

        
        ]);

//dd(request('basePrice'));
$id=Auth::user()->id;
  $cp=request('currentPrice');
  if(request('tax'))
{
    $tax=request('tax');
    $cp= $cp+( ($cp* $tax)/100);
   
}
        $product= new product;
        $product->name=request('name');
        $product->description=request('description',false);
        $product->cat_id=request('personal_category');
        $product->genCat_id=request('general_category');
        $product->brand_id=request('brand');
        $product->note=request('note',false);
        $product->admin_id=$id;
        $product->hide=request('hide',false);
        $product->tax=request('tax',false);
        $product->currentPrice=$cp;
        $product->base_price=request('basePrice',false);
        $product->featured=request('featured',false);
       
        $product->save();
$pid=$product->id;


$quantity=request('quantity');
$size=request('size');
$color=request('color');
$i=0;
while($i<count($quantity))
{


$productControls= new Productcontrol;
$productControls->product_id=$pid;
$productControls->color=$color[$i];
$productControls->size=$size[$i];
$productControls->quantity=$quantity[$i];
$productControls->save();

$i++;
}

return redirect()->route('addImg', ['id' => $pid]);
    }




public function storeimages(Request $request)
{

$id=request('id');

$colors=Productcontrol::where('product_id',$id)->distinct()->get(['color']);

$i=0;
$pindex=0;  
while ($i<=request('i')) {
 
$name="photo".$i;
$validatedData = $request->validate([
        $name => 'image|max:2000|file',
        
    ]);

if($request->hasFile($name))
  {
    
  $filenameWithExt = $request->file($name)->getClientOriginalName();

  $filename= pathinfo($filenameWithExt, PATHINFO_FILENAME);
  $extension = $request->file($name)->getClientOriginalExtension();

  $filenameToStore = $filename.'_'.time().'.'.$extension;
  //dd($filenameToStore);

$tempPath=$request->file($name)->storeAs('public/product_images',$filenameToStore);    
$path[$pindex]=str_replace("public","storage",$tempPath);

$pindex++;


}
else
{

$path[$pindex]=false;
$pindex++;

}
$i++;
}
$pathind=0;
foreach($colors as $color)
{
    if(!$path[$pathind])
        $path[$pathind]="storage/product_images/noimage.jpg";
  DB::table('productcontrols')
            ->where('product_id', $id)
            ->where('color',$color->color)
            ->update(['colorPhoto' => $path[$pathind]]);   
$pathind++;
}


$product= product::find($id);
$product->general_photo=$path[0];
$product->save();




alert()->success('product created');
 return redirect('admin/products');



}





public function createImagesPage($id)
{

$colors=Productcontrol::where('product_id',$id)->distinct()->get(['color']);


return view('admin.addImages',compact('colors','id'));
}






    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($pid)
    { $id=Auth::user()->id;
        
        $categories = category::where('admin_id',$id)->get();
        $brands = brand::where('admin_id',$id)->get();
        $product = product::find($pid); 
       // dd($product->category->name);
        return view('admin.updateProduct', compact('categories','brands','product'));
       
        //  return view('admin.updateProduct');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product)
    {

        
     $validatedData = $request->validate([
        'name' => 'required|max:30',
         'description' => 'max:500',
         'personal_category' => 'required',
         'general_category' => 'required',
         'currentPrice' => 'required',
          'basePrice' => 'required',
          'size.*' => 'required',
         'color.*' => 'required',
         'quantity.*' => 'required',

        
        ]);

//dd(request('basePrice'));
$id=Auth::user()->id;
  $cp=request('currentPrice');
  if(request('tax'))
{
    $tax=request('tax');
    $cp= $cp+( ($cp* $tax)/100);
   
}
        $product=product::find($product);
        $product->name=request('name');
        $product->description=request('description',false);
        $product->cat_id=request('personal_category');
        $product->genCat_id=request('general_category');
        $product->brand_id=request('brand');
        $product->note=request('note',false);
        $product->admin_id=$id;
        $product->hide=request('hide',false);
        $product->tax=request('tax',false);
        $product->currentPrice=$cp;
        $product->base_price=request('basePrice',false);
        $product->featured=request('featured',false);
       
        $product->save();



        $quantity=request('quantity');
        $size=request('size');
        $color=request('color');
        $i=0;
        while($i<count($quantity))
        {
        
        
        $productControls= new Productcontrol;
        $productControls->product_id=$id;
        $productControls->color=$color[$i];
        $productControls->size=$size[$i];
        $productControls->quantity=$quantity[$i];
        $productControls->save();
        
        $i++;
        }
        
        

return redirect()->route('products.index');
        

        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

product::destroy($id);
$status=true;
return response()->json($status);

    }


    public function getProducts()
{
$id=Auth::user()->id;
  //  dd($id);
    $productsdata = DB::select('SELECT p.id as id, p.base_price as basePrice, p.currentPrice , p.name as productName, b.name as brandName, c.name as catName, p.availability, p.general_photo as photo , SUM(pc.quantity) as quantity FROM products p LEFT JOIN brands b ON p.brand_id=b.id LEFT JOIN categories c ON c.id = p.cat_id LEFT JOIN productcontrols pc ON pc.product_id = p.id where p.admin_id='.$id.' GROUP by p.id');
    //dd($productsdata);
 

return Datatables::of($productsdata) ->addColumn('photo', function($productsdata){
    if ($productsdata->photo == NULL){
        return 'No Image';
    }
    return '<img class="rounded-square" width="50" height="50" src="'. asset($productsdata->photo) .'" alt="">';
})->addColumn('action', function($productsdata){
                return '<a href="#" onclick="showProduct('. $productsdata->id .')" class="btn btn-info btn-xs" data-toggle="modal" data-target="#productShowModal"> Show</a> ' .
                       '<a href="products/'. $productsdata->id .'/edit" class="btn btn-primary btn-xs"> Edit</a> ' .
                       '<a onclick="deleteProduct('. $productsdata->id .')" class="btn btn-danger btn-xs"> Delete</a>';
            })->rawColumns(['photo','action'])->make(true);

//dd($productsdata);
// return Datatables::of(product::query())->make(true);
}


public function showProduct($id)
{

    $product = product::find($id);
 return response()->json(['product'=>$product->first(),
 
 'productControl'=>$product->productControls,
 'personalCategory'=>$product->category->name,
 'generalCategory'=>$product->generalCategory->name,
 'brand'=>$product->brand->name
 ]);

}

}
