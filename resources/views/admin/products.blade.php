@extends('admin.layouts.admin_master')
@section('body')
@include('alert::message')
@include('admin.layouts.product_section')
@endsection

@section('active-product', 'active')
@section('script')

  
@endsection



@section('head_links')
 <script src="{{ asset('js/core/jquery.3.2.1.min.js')}}" type="text/javascript"></script>
<script >
  
	var table;
$(function() {
	//console.log('thiss');
 table = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('get.products')}}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'productName', name: 'productName' },
            { data: 'basePrice', name: 'basePrice' },
            { data: 'currentPrice', name: 'currentPrice ' },
            { data: 'catName', name: 'catName' },
            { data: 'brandName', name: 'brandName' },
            { data: 'availability', name: 'availability' },
            { data: 'quantity', name: 'quantity' },
            { data: 'photo', name: 'photo' },
            { data: 'action', name: 'action' }
            
            
        ]
    });
});



function deleteProduct(id)
{
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
                url: 'product/delete/'+id,
                success: function (status) 
                {
                   if(status)
                    {
                        swal(
      'Deleted!',
      'product has been deleted.',
      'success'
    );
                    table.ajax.reload();
}
                }
 });

   
  }
});

 


}

function showProduct(id){




$.ajax({
                url: 'product/show/'+id,
                success: function (data) 
                {

                  console.log(data); 
                  var element="";
                  for(var i=0; i<data.productControl.length; i++)
                  {
element+="<tr><td style='background-color:"+data.productControl[i].color+"'></td><td>"+data.productControl[i].size+"</td><td>"+data.productControl[i].quantity+"</td></tr>";
                  }
                  $('#productSHowTableBody').html(element);

                }
}
);



}



</script>


    @endsection