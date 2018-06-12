@extends('admin.layouts.admin_master')

@section('body')
    
      <!-- content -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
              <div class="col-sm-6">
                <div class="card">
                  <div class="card-body">
                    
                        <form  method="post" action="#" id="cat_form" name="cat_form" >
                     @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                      <div class="form-group">
                        <label for="categories">Add Categories</label>
                        
                        <input type="text"  class="form-control" id="cat">
                      </div>
                      <button type="submit" id="cat_btn" class="btn btn-primary btn-fill btn-sm float-right"><i class="fa fa-plus"></i> Add</button>
                    </form>
                  </div>
                </div>
              </div>
            
              <div class="col-sm-6">
                <div class="card">
                  <div class="card-body">
                    <form  method="post" action="#" id="brand_form" name="brand_form" >
                     @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                      <div class="form-group">
                        <label for="brand">Add brand</label>
                        
                        <input type="text"  class="form-control" id="brand">
                      </div>
                      <button type="submit" id="brand_btn" class="btn btn-primary btn-fill btn-sm float-right"><i class="fa fa-plus"></i> Add</button>
                    </form>
                  </div>
                </div>
              </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="card">
                <div class="card-body">
              
                <nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-category-tab" data-toggle="tab" href="#nav-category" role="tab" aria-controls="nav-category" aria-selected="true">Category</a>
    <a class="nav-item nav-link" id="nav-brand-tab" data-toggle="tab" href="#nav-brand" role="tab" aria-controls="nav-brand" aria-selected="false">Brand</a>
    
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-category" role="tabpanel" aria-labelledby="nav-category-tab">
    <table class="table table-bordered mt-5">
      <thead>
        <tr>
          <th>Category Name</th>
          <th>Total Prdoucts</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="catBody" >
      @foreach($categories as $category)  
      <tr>
          <td>{{$category->name}}</td>
          <td>{{$category->products->count()}}</td>
          <td class='catId' style='display:none;' >{{$category->id}}</td>
          
          <td><button  class="btn btn-danger btn-sm btn-fill deleteCat"><i class="fa fa-trash"></i></button></td>
        </tr>
      @endforeach
      
      </tbody>
    
    </table>
    {{$categories->links()}}
  </div>
  <div class="tab-pane fade" id="nav-brand" role="tabpanel" aria-labelledby="nav-brand-tab">


    <table class="table table-bordered mt-5">
      <thead>
        <tr>
          <th>brand Name</th>
          <th>Total Prdoucts</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="brandBody" >
      @foreach($brands as $brand)  
      <tr>
          <td>{{$brand->name}}</td>
          <td>{{$brand->products->count()}}</td>
          <td class='catId' style='display:none;' >{{$brand->id}}</td>
          
          <td><button  class="btn btn-danger btn-sm btn-fill deleteBrand"><i class="fa fa-trash"></i></button></td>
        </tr>
      @endforeach
      
      </tbody>
    </table>

    
  </div>
  
</div>

                
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

@endsection
@section('active-cat_brand', 'active')

@section('script')
<script type="text/javascript">
  
    $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
  });




  $("#cat_form").submit(function (e){
        e.preventDefault();
    var catName=$('#cat').val();
   console.log(catName);
    
        $.ajax({
            cache: false,
            url:"{{ url('admin/storeCat') }}",        
            type: 'POST',
            dataType: 'json',
            data: {
                catName:catName
            },
            success: function (data) {
              console.log(data);
              var cat=data.name;
              var catId=data.id;
              
              swal(
       'category added',
       cat+' added succesfully',
      'success'
    );
    
   $("#cat_form")[0].reset();
var element="<tr><td>"+cat+"</td><td>0</td><td class='catId' style='display:none;' >"+catId+"</td><td><button  onclick='delete()' class='btn btn-danger btn-sm btn-fill deleteCat'><i class='fa fa-trash'></i></button></td></tr>";
$('#catBody').append(element);

            }
        });
   
    });


  $("#brand_form").submit(function (e){
        e.preventDefault();
    var brandName= $('#brand').val();
   console.log(brandName);
    
        $.ajax({
            cache: false,
            url:"{{ url('admin/storeBrand') }}",        
            type: 'POST',
            dataType: 'json',
            data: {
                brandName:brandName
            },
            success: function (data) {
        var brand=data.name;
        var brandId=data.id;

              swal(
       ' brand added!',
       brand+' added succesfully',
      'success'
    );

    var element="<tr><td>"+brand+"</td><td>0</td><td class='brandId' style='display:none;' >"+brandId+"</td><td><button class='btn btn-danger btn-sm btn-fill deleteBrand'><i class='fa fa-trash'></i></button></td></tr>";
$('#brandBody').append(element);

            $("#brand_form")[0].reset();
            }
        });
   
    });
    
$('.deleteCat').click(function(){

var id=parseInt($(this).parent().siblings('.catId').text()); 

var closestTr=$(this).closest('tr');

    swal({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result) {

$.ajax({
                url: 'categories/delete/'+id,
                success: function (status) 
                {
                   if(status)
                    {
                        swal(
      'Deleted!',
      'category has been deleted.',
      'success'
    );
    closestTr.remove();
}
                }
 });

   
  }
});

    



});



$('.deleteBrand').click(function(){

var id=parseInt($(this).parent().siblings('.brandId').text()); 

var closestTr=$(this).closest('tr');

    swal({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result) {

$.ajax({
                url: 'brand/delete/'+id,
                success: function (status) 
                {
                   if(status)
                    {
                        swal(
      'Deleted!',
      'brand has been deleted.',
      'success'
    );
    closestTr.remove();
}
                }
 });

   
  }
});

    



});





</script>
@endsection

@section('head_links')
       <meta name="csrf-token" content="{{ csrf_token() }}">

@endsection