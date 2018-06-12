@extends('admin.layouts.admin_master')
@section('body')
      <!-- content -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-5">
                      <form action="#">
                        <div class="form-group">
                          <label>Date range:</label>
                          <select name="dateRange" id="dateRange" class="form-control">
                            <option value="" >select time frame</option>
                            <option value=0 >Today</option>
                            <option value=1>Yesterday</option>
                            <option value=7>Last 7 Days</option>
                            <option value=30>Last 30 Days</option>
                            <option value="allTime">All Time</option>
                          </select>
                        </div>
                      </form>
                    </div>
                    OR
                    <div class="col-sm-5">
                      <form action="#">
                         <br>
                         <div class="row">
                        <div class="col">
                          <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text">From</div>
                          </div>
                          <input type="date" class="form-control" id="from"  placeholder="Date From">
                        </div>
                        </div>
                       <div class="col">
                          <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text">To</div>
                          </div>
                          <input type="date" class="form-control" id="to"  placeholder="Date To">
                        </div>
                       </div>
                       <div class="col">
                         <button class="btn btn-primary btn-sm btn-fill getReport">Submit</button>
                       </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  <hr>
                 
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="card">
                <div class="card-body">
                   <div class="row">
                    <div class="col-sm-6">
                      <div class="card">
                        <div class="card-body bg-primary">
                        <h4 class="text-white">Total items in inventory <span class="badge badge-danger pull-right" style="font-size: 20px;">{{$sum}}</span></h4>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="card">
                        <div class="card-body bg-primary">
                        <h4 class="text-white">Total Inventory Value <span class="badge badge-danger pull-right" style="font-size: 20px;">{{$value}} PKR</span></h4>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row ml-5 mr-5">
                    <table class="table table-bordered" id="tableId">
                      <thead>
                        <tr>
                          <th>product name</th>
                          <th>size</th>
                          <th>color</th>
                          <th>quantity</th>
                          <th>discount</th>
                          <th>total</th>
                          
                          
                        </tr>
                      </thead>
                      <tbody class='reportBody'>
                        
                      </tbody>
                    </table>
                    <button class="btn btn-success btn-sm btn-fill" onclick="fnExcelReport()" ><i class="fa fa-download export"></i> Excel File</button>
                    <button class="btn btn-primary btn-sm btn-fill ml-auto" onclick="window.print()"><i class="fa fa-print"></i></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <iframe id="txtArea1" style="display:none"></iframe>
@endsection

@section('active-reports', 'active')

@section('script')

<script>

$.ajaxSetup({
   headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   }
   });


    $('.getReport').click(function(e){
      e.preventDefault;
     var dateRange= $('#dateRange').val();
      var from=$('#from').val();
      var to=$('#to').val();
      $.ajax({
                 url: '/admin/reports/summaryReport/getReport',
                 type: 'post',
                 dataType: 'json',
                 data: {
                 dateRange:dateRange,
                 from:from,
                 to:to
                 },
                 success: function (data) 
                 {


var element="";
                  for(var i=0; i<data.details.length; i++)
                  {
           element+="<tr><td>"+data.details[i].name+"</td><td>"+data.details[i].size+"</td><td>"+data.details[i].color+"</td><td>"+data.details[i].quantity+"</td><td>"+data.details[i].discount+"</td><td>"+data.details[i].total+"</td></tr>"

                  }
                  $('.reportBody').html(element);
                   console.log(data);
                 }

  });
     
    });
    
    



function fnExcelReport()
{
    var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
    var textRange; var j=0;
    tab = document.getElementById('tableId'); // id of table

    for(j = 0 ; j < tab.rows.length ; j++) 
    {     
        tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
        //tab_text=tab_text+"</tr>";
    }

    tab_text=tab_text+"</table>";
    tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
    tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
    tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE "); 

    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
    {
        txtArea1.document.open("txt/html","replace");
        txtArea1.document.write(tab_text);
        txtArea1.document.close();
        txtArea1.focus(); 
        sa=txtArea1.document.execCommand("SaveAs",true,"Say Thanks to Sumit.xls");
    }  
    else                 //other browser not tested on IE 11
        sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));  

    return (sa);
}


    </script>
@endsection

@section('head_links')
  <meta name="csrf-token" content="{{csrf_token()}}">

@endsection