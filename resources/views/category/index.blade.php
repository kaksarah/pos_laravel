@extends('layouts.master')

@section('title')
    Kategori
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Kategori</li>
@endsection

@section('content')
      <!-- Main row -->
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <button onclick="addForm(' {{ route('Categories.store') }} ')" class="btn btn-success xs btn-flat"><i class="fa fa-plus-circle"></i>Tambah</button>

            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-stiped table-bordered">
                <thead>
                  <th width="5%">No</th>
                  <th>Kategori</th>
                  <th widht="15%"><i class="fa fa-cog"></i></th>
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

  @includeIf('category.form')

@endsection

@push('scripts')

  <script>
    let table;

    $(function () {
      table = $('.table').DataTable({
        processing: true,
        autoWidth: false,
        ajax: {
          url: '{{ route('categories.data') }}'
        },
        columns: [
          {data: 'DT_RowIndex', searchable: false, sortable: false},
          {data: 'name_category'},
          {data: 'action', searchable: false, sortable: false},

        ]
      });

      $('#modal-form').validator().on('submit', function (e) {
        if (! e.preventDefault()) {
            $.post( $('#modal-form form').attr('action'), $('#modal-form form').serialize())
            .done((response) => {
              $('#modal-form').modal('hide');
              table.ajax.reload();
            })
            .fail((errors) => {
              alert('Tidak dapat menyimpan data');
              return;
            });


        }
      });
    });

    function addForm(url) {
    $('#modal-form').modal('show');
    $('#modal-form .modal-title').text('Tambah Kategori');

    $('#modal-form form')[0].reset();
    $('#modal-form form').attr('action', url);
    $('#modal-form [name=_method]').val('post');
    $('#modal-form [name=name_category]').focus();


    }

    function editForm(url) {
    $('#modal-form').modal('show');
    $('#modal-form .modal-title').text('Edit Kategori');

    $('#modal-form form').attr('action', url);
    $('#modal-form [name=_method]').val('put');
    $('#modal-form [name=name_category]').focus();

    $.get(url)
      .done((response)=> {
        $('#modal-form [name=name_category]').val(response.name_category);
      })
      .fail((error)=> {
        alert('Tidak dapat menampilkan data');
        return;
      })



    }

    function deleteData(url) {
      if(confirm("Anda ingin menghapus data?")) {
        $.post(url, {
        '_token' : $('[name=csrf-token]').attr('content'),
        '_method' : 'delete'
      })
      .done((response) => {
        table.ajax.reload();
      })
      .fail((errors) => {
        alert('Tidak dapat menghapus data');
        return;
      })
      }
    }

  </script>

  

@endpush