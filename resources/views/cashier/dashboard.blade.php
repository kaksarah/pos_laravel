@extends('layouts.master')

@section('title')
    Dashboard
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Dashboard</li>
@endsection

@section('content')
    @parent
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{$sales}}</h3>

              <p>Total Transaksi</p>
            </div>
            <div class="icon">
              <i class="fa fa-upload"></i>
            </div>
            <a href="{{ route('sales.index')}}" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Grafik Pendapatan {{ tanggal_indonesia($start_date, false) }} s/d {{ tanggal_indonesia($end_date, false) }}</h3>

              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  

                  <div class="chart">
                    <!-- Sales Chart Canvas -->
                    <canvas id="salesChart" style="height: 180px;"></canvas>
                  </div>
                  <!-- /.chart-responsive -->
                </div>
                <!-- /.col -->
                
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
@endsection

@push('scripts')
<!-- ChartJS -->
<script src="{{ asset('AdminLTE-2/bower_components/chart.js/Chart.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script>
  $(function() 
  {
  // Get context with jQuery - using jQuery's .get() method.
  var salesChartCanvas = $('#salesChart').get(0).getContext('2d');
  // This will get the first returned node in the jQuery collection.
  var salesChart       = new Chart(salesChartCanvas);

  var salesChartData = {
    labels  : {{ json_encode($date_time) }},
    datasets: [
      {
        label               : 'Pendapatan',
        fillColor           : 'rgba(60,141,188,0.9)',
        strokeColor         : 'rgba(60,141,188,0.8)',
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : {{ json_encode($date_income) }}
      },
      
    ]
  };

  var salesChartOptions = {
    // Boolean - Whether to show a dot for each point
    pointDot                : false,
    // Boolean - whether to make the chart responsive to window resizing
    responsive              : true
  };

   // Create the line chart
   salesChart.Line(salesChartData, salesChartOptions);
  });
</script>
@endpush