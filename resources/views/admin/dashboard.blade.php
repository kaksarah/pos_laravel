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
    <p>Selamat datang dihalaman admin</p>
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