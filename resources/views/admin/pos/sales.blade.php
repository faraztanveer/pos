@extends('admin.layouts.admin_master')
@section('body')
<div class="content" id="salesContent">
        <div class="container-fluid">
          <div class="row" id="billContainer" style="display:none;">
            <div class="col-sm-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                      <div class="col-sm-6"><span >Dated: <span id="billDate"> </span> </span></div>
                      <div class="col-sm-6"><span class="pull-right"  >Bill id: <span id="billId"></span> </span></div>
                  </div>
                  <div class="row mt-3">
                    <div class="col-sm-6"><span  >Customer Name: <span id="customerName" ></span>    </span></div>
                    <div class="col-sm-6"><span class="pull-right" >Customer Contact: <span id="customerPhone"></span>   </span></div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                        <table class="table">
                        <thead>
                          <tr>
                            <th>Item Name</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Total</th>
                          </tr>
                        </thead>
                        <tbody id="billTable" >
                          
                        </tbody>
                      </table>
                      <hr>
                      <div class="row">
                        <div class="col-sm-6"></div>
                        <div class="col-sm-6">
                          <span class="pull-right" >Sub-Total: <span id="billSubTotal"  ></span> </span>
                          <br>
                          <span class="pull-right"  >Paid: <span id="billPaid" ></span> </span> &nbsp;&nbsp;&nbsp; <span class="pull-right">Due: <span id="billDue" ></span> </span> 
                          <br>           
                          <button class="btn btn-primary btn-sm pull-right btn-fill mt-3" onclick="removeAll()" ><i class="fa fa-print"></i></button>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row" id="saleContainer">
            <div class="col-sm-9">
              <div class="card border-primary">
                <div class="card-body">
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="nc-icon nc-cart-simple"></i>
                      </div>
                    </div>
                    <form  action="#" id="product_submit_form" method="get" >
                    <input type="text" class="form-control awesomplete test"  id="sale-item" placeholder="Enter item name" list="mylist">
                    <datalist id="mylist">
 @foreach($products as $product)
 <option>#{{$product->id}} &nbsp;&nbsp;&nbsp;{{$product->name}}</option>
 @endforeach
</datalist>
<button id="submit-item" class="btn btn-success btn-sm btn-fill">Add</button>
</form>
                  </div>
                </div>
              </div>

              <div class="card border-info">
                <div class="card-body">

                  <table class="table table-bordered text-center" id="tbUser">


                    <th>Item Name</th>
                    <th style="width: 100px;">Price</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th style="width: 80px;">Qty.</th>
                    <th style="width: 80px;">Disc %</th>
                    <th>Total</th>
                    <th>&nbsp;</th>

                    <tbody id="table_body" class="text-center">


                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="card border-success">
                <div class="card-body text-center">
                  <button class="btn btn-warning btn-fill btn-sm" data-toggle="modal" data-target="#addCustomerModal">
                    <i class="fa fa-user"></i>+ Customer</button>
                 <input type="hidden" value=1 class="custId">
                 
                  <div class="input-group mb-2">
     
                    
                  </div>
                </div>
              </div>
              <div class="card border-success">
                <div class="card-body">
                  <div class="sub-total">
                    <span>Sub Total:</span>
                    <span class="float-right subTotal">
                      <small>PKR</small>
                    </span>
                  </div>
                  <hr>
                  <div class="amount-div">
                    <table class="table">
                      <th>Due</th>
                      <th>Paid</th>
                      <tbody class="text-center">
                        <td><input  type="number" value="0" class="dueAmount form-control" name="totalAmount"  >
                          <small>PKR</small>
                        </td>
                        <td style="border:0px;"> <input type="number"  class="paidAmount form-control" name="dueAmount"> </td>
                      </tbody>
                    </table>
                  </div>
                  <button class="submitProducts btn btn-secondary btn-sm btn-fill pull-right" >Submit</button>
                  <input type="checkbox" name="myCheck" id="myCheck">
                  <small class="text-muted">Change Sale Date</small>
                  <br>
                  
                  <input type="date" name="dateField" id="dateField" class="form-control">
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>
      <audio id="beep" preload="auto">
      <source src="{{ asset('sound/beep1.mp3') }}"> </source>
    </audio>
@endsection
@section('active-sales', 'active')



<!-- Modal -->
<div class="modal fade" id="addCustomerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-12">
          <div class="form-group">
            <label>Name:</label>
            <input type="text" placeholder="Name" class="form-control cName">
          </div>
          <div class="form-group">
            <label>Phone:</label>
            <input type="text" placeholder="Phone" class="form-control cPhone">
          </div>
          <div class="form-group">
            <input type="text" class="form-control awesomplete cTown"  id="custList" placeholder="Enter town" list="townsList">
            <datalist id="townsList">
                @foreach($towns as $town)
                <option>#{{$town->id}} &nbsp;&nbsp;&nbsp;{{$town->towns}}</option>
                @endforeach
               </datalist>
            </select>
          </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary submitCustomer">Save changes</button>
      </div>
    </div>
  </div>
</div>


@section('script')
<script src="{{ asset('js/core/awesomplete.js')}}"></script>
<script src="{{ asset('js/core/sales.js')}}"></script>



@endsection
@section('head_links')
  <link href="{{ asset('css/awesomplete.css') }}" rel="stylesheet" />
  <meta name="csrf-token" content="{{csrf_token()}}">

@endsection
