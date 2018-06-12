@extends('admin.layouts.admin_master')
@section('body')
      <!-- content -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
              {{-- <div class="col-sm-8">
                <div class="list-group" id="reports">
                  <a href="#" class="list-group-item list-group-item-action"><i class="nc-icon nc-layers-3"></i> Inventory Report </a>
                  <a href="#" class="list-group-item list-group-item-action"><i class="nc-icon nc-cart-simple"></i> Sales Report</a>
                  <a href="#" class="list-group-item list-group-item-action"><i class="nc-icon nc-notes"></i> Bills Report</a>
                  <a href="#" class="list-group-item list-group-item-action"><i class="nc-icon nc-money-coins"></i>  Profit Report</a>
                  <a href="#" class="list-group-item list-group-item-action"><i class="fa fa-money"></i> Expenses Report</a>
                </div>
              </div> --}}
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-body">
                    <h5 class="text-primary"><i class="nc-icon nc-check-2"></i> Make a selection</h5>
                    <hr>
                     <div class="list-group" id="reportType">
                     <a href="{{ url('admin/reports/summaryReport') }}" class="list-group-item list-group-item-action"><i class="nc-icon nc-chart-bar-32"></i> Summary Report </a>
                      {{-- <a href="#" class="list-group-item list-group-item-action"><i class="nc-icon nc-single-copy-04"></i> Detailed Report</a> --}}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection

@section('active-reports', 'active')


