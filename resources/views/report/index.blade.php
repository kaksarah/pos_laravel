@extends('layouts.master')

@section('title')
    Laporan Pendapatan {{ tanggal_indonesia($start_date, false) }} s/d {{ tanggal_indonesia($end_date, false) }}
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('AdminLTE-2/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
@endpush

@section('breadcrumb')
    @parent
    <li class="active">Daftar Laporan</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <button onclick="updatePeriode()" class="btn btn-info btn-xs btn-flat"><i class="fa fa-pencil"></i> Ubah Periode</button>
                <a href="{{ route('report.exportPDF', [$start_date, $end_date]) }}" target="_blank" class="btn btn-success btn-xs btn-flat"><i class="fa fa-file-excel-o"></i> Export PDF </a>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-stiped table-bordered">
                    <thead>
                        <th width="5%">No</th>
                        <th>Tanggal</th>
                        <th>Penjualan</th>
                        <th>Pendapatan</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@includeIf('report.form')
@endsection

@push('scripts')

<script src=" {{ asset('AdminLTE-2/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

<script>
    let table;

    $(function () {
        table = $('.table').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                url: '{{ route('report.data', [$start_date, $end_date]) }}',
            },
            columns: [
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'date'},
                {data: 'sale'},
                {data: 'income'},
            ],

            dom: 'Brt',
            bSort: false,
            bPaginate: false,
        });

        $('.datepicker').datepicker({
            format:'yyyy-mm-dd',
            autoclose: true
        });


    });

    function updatePeriode(url) {
        $('#modal-form').modal('show');
    }




    
</script>
@endpush