
  var globalTotal=0;
  $.ajaxSetup({
   headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   }
   });
   
 
 function updateSubTotal()
 {
   var subTotal=0;
 $(".total").each(function(){
    var  total = $(this).val();
      total = parseFloat(total.slice(0,total.indexOf('p')));
     subTotal+=total;
     $(".dueAmount").val(subTotal);
     globalTotal=subTotal;
     
     });
 
 $(document).on("keyup keypress blur change", ".paidAmount", function() {
 
 var paid = $(this).val();
 var total =$(".total").val();
 total = parseFloat(total.slice(0,total.indexOf('p')));
  
  var due = globalTotal-paid;
  $(".dueAmount").val(due);
 
 
 });
 
 
 $('.subTotal').text(subTotal+" PKR");
 // console.log(subTotal);
 }
 
 function playBeep()
 {
 
 var audio = $("#beep")[0];
      audio.play();
 
 }
 
 
 
 function calculateDiscount(total,discount)
 {
 
 return (total - ((discount*total)/100));
 
 }
  
 
 $('#product_submit_form').submit(function(event) {
   event.preventDefault();
  var itemName=$('#sale-item').val();
 //var itemid= itemName.slice(itemName.indexOf('#')+1,itemName.indexOf(' '));
 var itemid = parseInt(itemName.slice(itemName.indexOf('#')+1,itemName.indexOf(' ')));
 $('#sale-item').val('');
 //console.log($("#p"+itemid).length);
 
  $.ajax({
                 url: 'getItemDetail/'+itemid,
                 type: 'get',
                 success: function (data) 
                 {
       // console.log(data.productControls[0].color);
      // if($("#p"+itemid).length == 0)
      // {
        // console.log(data.productControls[2].color);
        var arr=data.productControls;
       // console.log(arr);
      //var wanted = arr.filter( function(arr){return (arr.color=='#000000' && arr.size=='small' && arr.quantity>0);} );
 //console.log(wanted);        
 var element="<tr id='p"+itemid+"' ><input type='hidden'   class='totalQuant' ><input type='hidden' name='pc[]' class='pcId' ><td><input disabled name='productName[]' value='"+data.product.name+"' class='form-control' ></td><td class='pricetd'><input disabled name='price[]' class='price form-control' type='text' value='"+data.product.currentPrice+" ' ></td><td class='sizetd'><select name='size[]' class='form-control size'></select></td><td class='colortd' ><select name='color[]' class='form-control color'></select></td><td   class='quantitytd' ><input type='text' name='quantity[]' value=0 class='form-control quantity' name='quantity'  size='1'></td><td class='discounttd'><input type='number' name='discount[]'  class='form-control discount' size='1'></td><td class='totalProductRs totaltd'><input disabled class='total  form-control' name='totalProductRs[]' type='text' value='0 PKR' ></td><td style='border: 0px;'><button class='btn btn-danger btn-fill btn-sm btnDelete'><i class='fa fa-trash fa-2x'></i></button></td></tr>";
 $('#table_body').append(element);
 updateSubTotal();
 
 //while(data.productControls) 
 var sizeArr= new Array();
 for(var i=0; i< data.productControls.length; i++)
 {
 
 sizeArr[i]=data.productControls[i].size;
 
 }
 
 
 console.log(sizeArr);
 console.log($.unique(sizeArr));
 
 var element="<option>select size</option>";
 for (var i=0; i<sizeArr.length; i++)
  {
 
 
  element+="<option value="+sizeArr[i]+" >"+sizeArr[i]+"</option>";
 
  }
 idName = '#p'+itemid+' .size';
 
 $(idName).html(element);
 
 playBeep();
 updateSubTotal();
 
 //updateSubTotal(data.product.currentPrice);
      // }
 //       else
 //       {
 
 // var idName='#p'+itemid+' .quantity';
 
 // var totalQuantity=parseInt( $(idName).val());
 
 // if(isNaN(totalQuantity))
 // {
 //   totalQuantity=0;
 // }
 // totalQuantity++;
 // console.log(totalQuantity);
 // $(idName).val(totalQuantity);
 // idName='#p'+itemid+' .price';
 // var price=  $(idName).val();
 // price = parseFloat(price.slice(0,price.indexOf('p')));
 // price= price.toFixed(2)
 // //updateSubTotal(price);
 // var totalPrice= totalQuantity*price;
 // idName='#p'+itemid+' .discount';
 
 // var disc=$(idName).val();
 // disc = parseInt(disc);
 // if(disc!=0 && !isNaN(disc))
 // {
 //   //console.log(totalPrice);
 //  totalPrice =  calculateDiscount(totalPrice,disc);
 // }
 // //console.log(price);
 
 
 
 // idName='#p'+itemid+' .total';
 
 // $(idName).val(totalPrice+" PKR");
 
 
 // updateSubTotal();
 
 
 
 //          }
          //end else
          
                }
          //end success
             });
             // end  ajax
 
 
  });
 
  // end product submission
 
  var quantity=0;
 
 $(document).on("keyup keypress blur change", ".quantity", function() {
     var sum = 0;
     $(".quantity").each(function(){
 
     
     });
     var totalquant=parseInt($(this).parent().siblings('.totalQuant').val());
     quantity = $(this).val();
     if(quantity>totalquant)
     {
      $(this).val(totalquant);
      console.log($(this).val());
     }
      var price =$(this).parent().siblings('.pricetd').children('.price').val();  
 
   price = parseFloat(price.slice(0,price.indexOf('p')));
   price= price.toFixed(2)
 
 var totalTmp =$(this).parent().siblings('.totaltd').children('.total').val(); 
 var total = quantity*price;
 var disc =$(this).parent().siblings('.discounttd').children('.discount').val(); 
 
 disc = parseInt(disc);
 //console.log("disc before if"+disc);
 if(disc!=0 && !isNaN(disc)){
 
   //console.log("disc in if"+disc);
 
  total =  calculateDiscount(total,disc);
 }
 
 $(this).parent().siblings('.totaltd').children('.total').val(total+" PKR");
 updateSubTotal();
 
 //totalTmp=parseFloat(totalTmp.slice(0,totalTmp.indexOf('p')));
 //totalTmp= totalTmp.toFixed(2)
 
 //updateSubTotal(total-totalTmp);
 });
 
 // total calculation
 
 
 var discount=0;
 
 $(document).on("keyup keypress blur change", ".discount", function() {
     var sum = 0;
     $(".discount").each(function(){
 
     
     });
     discount = $(this).val();
     
     var quant =$(this).parent().siblings('.quantitytd').children('.quantity').val(); 
     quant = parseInt(quant);
   //   console.log("quantity"+quant);
      var price =$(this).parent().siblings('.pricetd').children('.price').val();  
      //var total =$(this).parent().siblings('.totaltd').children('.total').val();  
      price = parseFloat(price.slice(0,price.indexOf('p')));
      price= price.toFixed(2);
 //console.log("price="+price);
     var total=quant * price;
 //console.log(total);
   //total = parseFloat(total.slice(0,total.indexOf('p')));
   //console.log("before"+total);
   
   
 var totalTmp = total; 
 total   =     calculateDiscount(total,discount);
 //console.log("discount"+discount);
 
 $(this).parent().siblings('.totaltd').children('.total').val(total+" PKR");
 updateSubTotal();
 
 //totalTmp=parseFloat(totalTmp.slice(0,totalTmp.indexOf('p')));
 //totalTmp= totalTmp.toFixed(2)
 
 
 });
 
 
 
 
 
 
 $(document).on("change", ".size", function() {
 var thiss = $(this);
 var size = thiss.val();
 console.log(size);
 var id  = $(this).closest('tr').attr('id');
 id= parseInt( id.slice(1));
 console.log(id);
 
 
 
  $.ajax({
                 url: 'getColors/'+id+'/'+size,
                 type: 'get',
                 success: function (data) 
                 {
                   var colors =  data.colors;
                   var element="<option>select colors</option>";
                   console.log(colors);
 for (var i=0; i<colors.length; i++)
  {
 console.log(i);
 var val=colors[i].color+"|"+colors[i].quantity+"|"+colors[i].id;
 console.log(val);
 element+="<option  style='background-color:"+colors[i].color+"' value="+val+" >"+ colors[i].color +"</option>";
 
  }
 
 thiss.parent().siblings('.colortd').children('.color').html(element);
                 
                 }
 });
 
 
 $(document).on("change", ".color", function() {
 
   var quantity=$(this).val();
   var arr=quantity.split('|');
 $(this).parent().siblings('.totalQuant').val(arr[1]);
 //console.log(quantity);
 $(this).parent().siblings('.pcId').val(arr[2]);
 
 console.log($(this).parent().siblings('.pcId').val());
 
 
 
 
 
 });
 
 
 });
 
 
 $('.submitProducts').click(function(){
 
   var price = $('input[name="price[]"]').map(function(){ 
                     return this.value; 
                 }).get();
               
                 var pc = $('input[name="pc[]"]').map(function(){ 
                     return this.value; 
                 }).get();
                 var size = $('input[name="size[]"]').map(function(){ 
                     return this.value; 
                 }).get();
                 var color = $('input[name="color[]"]').map(function(){ 
                     return this.value; 
                 }).get();
                 var  quantity = $('input[name="quantity[]"]').map(function(){ 
                     return this.value; 
                 }).get();
                 var totalProductRs = $('input[name="totalProductRs[]"]').map(function(){ 
                     return this.value; 
                 }).get();
                 var discount = $('input[name="discount[]"]').map(function(){ 
                     return this.value; 
                 }).get();
                 var paid= $(".paidAmount").val();
                 var custId= $('.custId').val();
                 console.log(custId);
 
 
 
  $.ajax({
                 url: '../pos/submitSale',
                 type: 'post',
                 dataType: 'json',
                 data: {
                 pc:pc,
                 quantity:quantity,
                 totalProductRs:totalProductRs,
                 customer:custId,
                 grandTotal:globalTotal,
                 discount:discount,
                 paid:paid
             },
                 success: function (data) 
                 {
 
                   console.log(data);
                  $('#billContainer').css('display','block')
 
 
 
 
                  $('#customerName').text(data[5]);
                  $('#customerPhone').text(data[6]);
                  $("#billId").text(data[7]);
                  $("#billDate").text(data[8]);
                  var paidTemp=data[9];
                  var sTotal=data[10];
                  var dueTemp=sTotal-paidTemp;
                  $("#billPaid").text(paidTemp);
                  $("#billSubTotal").text(sTotal);
                  $("#billDue").text(dueTemp);
                  
 
 
 
                 // $("billDate").text(data[]);
                  
                  
                  var element="";
                  var counter=0;
                  while(counter<data[0].length)
                  {
                   element+="<tr><td>"+data[0][counter]+"</td><td>"+data[1][counter]+"</td><td>"+data[2][counter]+"</td><td>"+data[4][counter]+"</td></tr>";
 counter++;
                  }
                  $("#billTable").html(element);
 
 
                 }
  });
 
 
 });
 
 
 
 
 
 
 
 $("#tbUser").on('click', '.btnDelete', function () {
     $(this).closest('tr').remove();
     updateSubTotal();
 });
 
 
 function removeAll()
 {
   $('#saleContainer').css('display','none');
 
 
 window.print();
 
 }
 
 function redirectToReceipt()
 {
 
   
 }


$('.submitCustomer').click(function(){
  
var cName=$('.cName').val();
var cPhone=$('.cPhone').val();
var cTown=$('.cTown').val();
cTown =  parseInt(cTown.slice(cTown.indexOf('#')+1,cTown.indexOf(' ')));

    $.ajax({
        url: '../customer/submit',
        type: 'post',
        dataType: 'json',
        data: {
        cName:cName,
        cPhone:cPhone,
        cTown:cTown
    },
        success: function (data) 
        {
            $('.modal').modal('toggle');
            $('.custId').val(data.id);
            console.log

console.log(data);

        }
});


})
 
 
 