@extends('admin.layouts.admin_master')
@section('body')
      <!-- content -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-12">
              <div class="card">
              <div class="card-body">
              <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>id</th>
                <th>Customer name</th>
                <th>Customer contact</th>
                <th>Grand total</th>
                <th>paid ammount</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>


@foreach($bills as $bill)
<tr>
<td class='billId'>{{$bill->id}}</td>
<td>{{$bill->customer->name}}</td>
<td>{{$bill->customer->phone}}</td>
<td>{{$bill->grand_total}}</td>
<td class='paid_amount' >{{$bill->paidAmount}}</td>

<?php 
$calc=$bill->grand_total-$bill->paidAmount


?>
@if($calc>0)
<td><span class="badge badge-danger">Due</span></td>
@endif
@if($calc==0)
<td><span class="badge badge-success">Completed</span></td>
@endif
@if($calc<0)
<td><span class="badge badge-warning">Return</span></td>
@endif

<td>
                <button class="btn btn-info btn-sm show" data-toggle="modal" data-target="#billViewModal" >view</button>
                <button class="btn btn-primary btn-sm editButton" data-toggle="modal"  data-target="#editBill" >edit</button>
                <button class="btn btn-danger btn-sm delete" >Delete</button> 
            </td>
          
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



<!-- Modal -->
<div class="modal fade" id="editBill" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Bill</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-12">
            <div class="form-group">
              <label>Paid Amount:</label>
              <input type="number" placeholder="Paid Amount" class="form-control PaidAmount">
            </div>
          <input type="hidden" class="hiddenBillId">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary submitPaidAmount">Save changes</button>
        </div>
      </div>
    </div>
  </div>


@endsection





<!--  View Modal -->
<div class="modal fade" id="billViewModal" tabindex="-1" role="dialog" aria-labelledby="billViewModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="billViewModalLabel">Bill Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row">
              <div class="col-sm-6">
                  <span><strong class='pd_billId' >Bill #: </strong></span>
                  <br>
                  <span><strong class='pd_customerName' >Customer Name: </strong></span>
                  <br>
                  <span><strong class='pd_customerContact' >Customer Contact:</strong></span>
                  <br>
                  <span><strong class='pd_grandTotal'>Grand Total:</strong></span>
              </div>
              <div class="col-sm-6">
              <span class="pull-right"><strong class='pd_paidAmount' >Paid Amount:</strong></span>
                  <br>
                  <span class="pull-right"><strong class='pd_dueAmount'>Due Amount:</strong></span>
                  <br>
                  <span class="pull-right"><strong class='pd_returnChange'>Return Change:</strong></span>
              </div>
          </div>
          <div class="row">
              <div class="col-sm-12">
                  <table class="table">
                      <thead>
                          <tr>

                              <th>Product Name</th>
                              <th>Size</th>
                              <th>Color</th>
                              <th>Product Qty</th>
                              <th>Disc</th>
                              <th>Total</th>
                          </tr>
                      </thead>
                      <tbody class='productDetailTable'>
                        
                      </tbody>
                  </table>
              </div>
          </div>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>

@section('script')
<script>
$.ajaxSetup({
   headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   }
   });

  $('.delete').click(function()
  {
      var id = parseInt($(this).parent().siblings('.billId').text());
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
                url: 'bills/delete/'+id,
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

$('.show').click(function(){
   
    var id = parseInt($(this).parent().siblings('.billId').text());
    
    $.ajax({
                url: 'bills/show/'+id,
                success: function (data) 
                {
                   var due=data.bill.grand_total-data.bill.paidAmount;
                   var change=0;
                   if(due<0)
                   {
                    change=-1 * due;
                   
                    due=0;
                   }
            $('.pd_billId').text("Bill #"+data.bill.id);
            $('.pd_paidAmount').text("Paid Amount "+data.bill.paidAmount);
            $('.pd_customerName').text("Customer name "+data.customer.name);
            $('.pd_customerContact').text("Customer Contact "+data.customer.phone);
            $('.pd_grandTotal').text("Grand Total "+data.bill.grand_total);
            $('.pd_dueAmount').text("Due Amount "+due);
            $('.pd_returnChange').text("Change "+change);
            var element="";
            for(var dd in data.details)
            {
              
              element+="<tr><td>"+data.details[dd].name+"</td><td>"+data.details[dd].size+"</td><td>"+data.details[dd].color+"</td><td>"+data.details[dd].quantity+"</td><td>"+data.details[dd].discount+"</td><td>"+data.details[dd].total+"</td></tr>";
             //  console.log( data.details[dd].name);
           
            }
            //console.log(data.details[0]);
                  // console.log(data);

$('.productDetailTable').html(element);

                }
 });

})


$('.editButton').click(function(){

var id=$(this).parent().siblings('.billId').text();
var paidAmount= parseInt($(this).parent().siblings('.paid_amount').text());

$('.paidAmount').val(paidAmount);
$('.hiddenBillId').val(id);


});

$('.submitPaidAmount').click(function () { 

var paid=$('.paidAmount').val();
var hiddenBillId=$('.hiddenBillId').val();

  $.ajax({
                 url: '/admin/bills/update',
                 type: 'post',
                 dataType: 'json',
                 data: {
                 paid:paid,
                 id:hiddenBillId
                 },
                 success: function (data) 
                 {
                    $('#editBill').modal('toggle');
                     console.log(data);
                     //location.reload();
                     swal({
  type: 'success',
  title: 'Paid amount has been updated',
  showConfirmButton: false,
  timer: 1000
})
                 }

  });



 });


</script>
@endsection
@section('active-bills', 'active')

@section('head_links')
  <link href="{{ asset('css/awesomplete.css') }}" rel="stylesheet" />
  <link href="https://raw.githubusercontent.com/daneden/animate.css/master/animate.css" rel="stylesheet" />
  

  <meta name="csrf-token" content="{{csrf_token()}}">

@endsection
