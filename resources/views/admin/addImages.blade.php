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
                        <i class="nc-icon nc-album-2"></i> Add Images
                      </h4>
                    </div>
                    <div class="col-md-6">
                      <a href="#">
                        <button class="btn btn-default btn-fill float-right">
                          <i class="fa fa-chevron-circle-left"></i>
                        </button>
                      </a>

                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="container">
                    <br />
                    <div class="row">

                      <div class="col-md-12">
                        <div class="card">
                          <div class="card-header">
                            <div class="card-title">
                              <strong>Upload files</strong>
                              <small> </small>
                            </div>
                          </div>
                          <div class="card-body">

                            <!-- table -->
                            <form action="{{ url('admin/product/storeimages')}}" enctype="multipart/form-data" method="post">
                              @csrf
                              <table class="table table-plain-bg">
                                <thead>

                                  <tr>
                                    <th>Color</th>
                                    <th>Choose File</th>
                                  </tr>
                                </thead>
                                <tbody>
                             <?php
$i=0;

                              ?>     
                      @foreach($colors as $color)
                      
                                  <tr>
                                    <td bgcolor="{{$color->color}}"></td>
                                    <td>
                                      <div class="form-group">

                                        <input type="file" name="<?php echo 'photo'.$i;  ?>" accept="image/x-png,image/gif,image/jpeg" class="form-control">
                                      </div>
                                    </td>
                                    <td>

                   @if ($errors->get('photo'.$i))
    <div class="alert alert-danger">
        <ul>
           @foreach ($errors->get('photo'.$i) as $message)
 
 <?php $message=str_replace('photo'.$i,"file", $message); ?>
 {{$message}}
           @endforeach
        </ul>
    </div>
@endif


                                    </td>
                                  </tr>
                                  
<?php $i++; ?>
                      @endforeach
                                </tbody>
                              </table>
                              <div class="form-group">
                                <input type="submit" value="Upload" class="btn btn-primary btn-fill float-right">
                              </div>
                            <input type="hidden"  name="id" value={{$id}} >
                            <input type="hidden"  name="i" value={{$i-1}} >
                           
                            </form>
                          </div>
                        </div>



                      </div>
                    </div>



                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection

@section('active-product', 'active')
