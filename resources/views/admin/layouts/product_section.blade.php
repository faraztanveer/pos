
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
                    <i class="nc-icon nc-layers-3"></i> Product List
                  </h4>
                  </div>
                  <div class="col-md-6 mb-5">
                  <a href="{{ url('admin/products/create')}}">
                    <button class="btn btn-primary btn-fill float-right">
                      <i class="fa fa-plus"></i>
                    </button>
                  </a>
                  </div>
                  </div>
                </div>
                  <!-- table -->
                  <table class="table table-bordered  mt-5" id="users-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>base price</th>
                <th>sale price</th>
                <th>category</th>
                <th>brand</th>
                <th>availability</th>
                <th>quantity</th>
                <th>Photo</th>
                <th>Action</th>
              </tr>
        </thead>
    </table>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      
<!-- Modal -->
<div class="modal fade" id="productShowModal" tabindex="-1" role="dialog" aria-labelledby="productShowModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="productShowModalLabel">Product Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table">
          <thead>
            <tr>
             
              <th>color</th>
              <th>size</th>
              <th>quantity</th>
            </tr>
          </thead>
          <tbody id="productSHowTableBody">
            
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      
      </div>
    </div>
  </div>
</div>