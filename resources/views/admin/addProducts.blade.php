@extends('admin.layouts.admin_master')

@section('body')
    
      <!-- content -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <div class="row">
                    <div class="col-md-6">
                      <h4 class="card-title">
                        <i class="nc-icon nc-simple-add"></i> Add Products
                      </h4>
                    </div>
                    <div class="col-md-6">
                    <a href="{{ url('admin/products')}}">
                        <button class="btn btn-default btn-fill float-right">
                          <i class="fa fa-chevron-circle-left"></i>
                        </button>
                      </a>
                    
                      
            
                    </div>
                  </div>
                </div>
                <div class="card-body">
                <form action="{{ url('admin/products')}}" method="POST"  >
                  
                   @csrf

                    <div class="row">
                      <div class="col-md-3 pr-1">
                        <div class="form-group">
                          <label>Name</label>
                          <input type="text" class="form-control" placeholder="name" name="name">
                        </div>
                              @if ($errors->get('name'))
    <div class="alert alert-danger">
        <ul>
           @foreach ($errors->get('name') as $message)
 {{$message}}
           @endforeach
        </ul>
    </div>
@endif
                      </div>
                      <div class="col-md-9 pl-1">
                        <div class="form-group">
                          <label>Description</label>
                          <textarea row="5" class="form-control" placeholder="product description" name="description"></textarea>
                        </div>
                               @if ($errors->get('description'))
    <div class="alert alert-danger">
        <ul>
           @foreach ($errors->get('description') as $message)
 {{$message}}
           @endforeach
        </ul>
    </div>
@endif
                      </div>
                  
                    </div>
                    <div class="row">
                      <div class="col-md-4 pr-1">
                        <div class="form-group">
                          <label>personal category</label>
                          <select class="form-control" name="personal_category" id="category1">
                            @foreach($categories as $category)
                          <option value="{{$category->id}}" >{{$category->name}}</option>
                            @endforeach

                          </select>
                        </div>
                                               @if ($errors->get('personal_category'))
    <div class="alert alert-danger">
        <ul>
           @foreach ($errors->get('personal_category') as $message)
 {{$message}}
           @endforeach
        </ul>
    </div>
@endif
                      </div>
                      <div class="col-md-4 pl-1">
                        <div class="form-group">
                          <label>general Category</label>
                          <select class="form-control" name="general_category" id="category2">
                            @foreach($personalCat as $personalCat)
                          <option value="{{$personalCat->id}}" >{{$personalCat->name}}</option>
                            @endforeach
                          </select>
                        </div>
                                               @if ($errors->get('general_category'))
    <div class="alert alert-danger">
        <ul>
           @foreach ($errors->get('general_category') as $message)
 {{$message}}
           @endforeach
        </ul>
    </div>
@endif
                      </div>
                      <div class="col-md-4 pl-1">
                        <div class="form-group">
                          <label>Brand</label>
                          <select class="form-control" name="brand" id="brand">
                            @foreach($brands as $brand)
                            <option value="{{$brand->id}}" >{{$brand->name}}</option>
                              @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Base Price</label>
                          <input type="text" class="form-control" name="basePrice" placeholder="enter base price of product">
                        </div>

                       @if ($errors->get('basePrice'))
    <div class="alert alert-danger">
        <ul>
           @foreach ($errors->get('basePrice') as $message)
 {{$message}}
           @endforeach
        </ul>
    </div>
@endif

                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Current Price</label>
                          <input type="text" class="form-control" name="currentPrice" placeholder="enter current price of product">
                        </div>
                                               @if ($errors->get('currentPrice'))
    <div class="alert alert-danger">
        <ul>
           @foreach ($errors->get('currentPrice') as $message)
 {{$message}}
           @endforeach
        </ul>
    </div>
@endif
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Tax</label>
                          <input type="text" class="form-control" name="tax" placeholder="enter current price of product">
                        </div>
                        
                      </div>
                    </div>
                    <div id="mainwrapper">
                    <div class="row input_fields_wrap">
                      
                          <div class="col-md-3 pr-1">
                            <div class="form-group">
                              <label>Size</label>
                              <input type="text" class="form-control" placeholder="size" name="size[]" required >
                            </div>
       
                          </div>
                          <div class="col-md-3 px-1">
                        <div class="form-group">
                          <label>color</label>
                          <input type="color" class="form-control" placeholder="color" name="color[]">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>quantity</label>
                          <input type="number" class="form-control" placeholder="quantity" name="quantity[]">
                        </div>
                      </div>
                          <div class="col-md-3">
                        <div class="form-group">
                           <button class="add_field_button btn btn-primary btn-sm" style="margin-top: 30px;">Add More Fields</button>
                        </div>
                      </div>
                          
                      </div>
                  
                    </div>
                    <div class="row">
                      <div class="col-md-6 sp-check">
                        <div class="form-group">
                          <label>featured</label>
                          <input type="checkbox" class="form-control" name="featured" value=1>
                        </div>
                      </div>
                      <div class="col-md-6 pl-1 sp-check">
                        <div class="form-group">
                          <label>hide</label>
                          <input type="checkbox" class="form-control" value=1 name="hide">
                        </div>
                      </div>
                    </div>
                  
                  
                    <hr>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Note</label>
                          <textarea rows="4" cols="80" name="note" class="form-control" placeholder="Here can be your description"></textarea>
                        </div>
                      </div>
                    </div>
                   
                    <div class="clearfix"></div>
                 
                    <button  class="btn btn-primary btn-fill pull-right" type="submit">Next
                      <i class="nc-icon nc-stre-right"></i>
                    </button>
                  
                  </form>
                 



                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

@endsection
@section('active-product', 'active')
