@extends('layouts.master')

@section('title')
  Aktivitas Pengguna
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Aktivitas Pengguna</li>
@endsection

@section('content')
      <!-- Main row -->
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-stiped table-bordered">
                <thead>
                  <th width="5%">No</th>
                  <th>Tanggal</th>
                  <th>Nama Pengguna</th>
                  <th>Deskripsi</th>
                </thead>
                <tbody></tbody>
              </table>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->
            
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>

@endsection

@push('scripts')

  <script>
    let table;

    $(function () {
      table = $('.table').DataTable({
        processing: true,
        autoWidth: false,
        ajax: {
          url: '{{ route('userActivty.data') }}'
        },
        columns: [
          {data: 'DT_RowIndex', searchable: false, sortable: false},
          {data: 'time'},
          {data: 'name_user'},
          {data: 'description'},

        ]
      });
    });

  </script>

  

@endpush