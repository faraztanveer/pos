<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-body">
						<div class="row">
						<div class="col-sm-4">
							<a href="admin/categories">	
								<div class="card bg-warning">
										<div class="card-body">
											<h5 class="main-page-card-h5">Total Categories <i class="fa fa-tags"></i> <span class="badge badge-danger pull-right" style="font-size: 20px;">{{ $categoryCount}}</span></h5>
										</div>
								</div>
							</a>
							</div>
							<div class="col-sm-4">
							<a href="admin/categories">	
								<div class="card bg-warning">
										<div class="card-body">
											<h5 class="main-page-card-h5">Total Brands <i class="fa fa-shopping-bag"></i> <span class="badge badge-danger pull-right" style="font-size: 20px;">{{ $brandCount}}</span></h5>
										</div>
								</div>
							</a>
							</div>
							<div class="col-sm-4">
							<a href="admin/products">	
								<div class="card bg-warning">
										<div class="card-body">
											<h5 class="main-page-card-h5">Total products <i class="fa fa-database"></i> <span class="badge badge-danger pull-right" style="font-size: 20px;">{{ $productCount}}</span></h5>
										</div>
								</div>
							</a>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
		{{-- cahrts below --}}
		<div class="row">
			<div class="col-sm-6">
				<div class="card">
					<div class="card-body">
						
						<h5>Monthly Sale</h5>
							{!! $chartjs->render() !!}
					

					</div>
				</div>
			</div>
<div class="col-sm-6">
				<div class="card">
					<div class="card-body">
						
						<h5>Daily Sale</h5>
							{!! $chartjs2->render() !!}
					

					</div>
				</div>
			</div>
			

		</div>
		<div class="row">


			<div class="col-sm-6">
				<div class="card">
					<div class="card-body">
						
						<h5>By Category</h5>
							{!! $chartjs1->render() !!}
					

					</div>
				</div>
			</div>
			

			<div class="col-sm-6">
				<div class="card">
					<div class="card-body">
						
						<h5>By Brands</h5>
							{{-- {!! $brandChart->render() !!} --}}
							<canvas id="myChart"></canvas>

					</div>
				</div>
			</div>

		</div>
	</div>
</div>
	 
@section('script')
<script>

function random_rgba() {
    var o = Math.round, r = Math.random, s = 255;
    return 'rgba(' + o(r()*s) + ',' + o(r()*s) + ',' + o(r()*s) + ',' + r().toFixed(1) + ')';
}

$.ajax({
                url: 'admin/brand/report',
                success: function (data) 
                {

                 console.log(data);  

var brandName=[];
var brandCount=[];
var colors=[];
for (var i=0; i<data.length; i++)
{
brandName[i]=data[i].brand;
brandCount[i]=data[i].totalBrand;
colors[i]= random_rgba();

}


var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: brandName,
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor:colors,
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});





                }
}
);

	
</script>
@endsection