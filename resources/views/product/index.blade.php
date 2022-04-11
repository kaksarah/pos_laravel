@extends('layouts.master')

@section('title')
    Produk
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Produk</li>
@endsection

@section('content')
      <!-- Main row -->
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <button onclick="addForm(' {{ route('Products.store') }} ')" class="btn btn-success xs btn-flat"><i class="fa fa-plus-circle"></i>Tambah</button>

            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-stiped table-bordered">
                <thead>
                  <th width="5%">No</th>
                  <th>Kode</th>
                  <th>Nama</th>
                  <th>Kategori</th>
                  <th>Merk</th>
                  <th>Harga Beli</th>
                  <th>Harga Jual</th>
                  <th>Diskon</th>
                  <th>Stok</th>
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

  @includeIf('product.form')

@endsection

@push('scripts')

  <script>
    let table;

    $(function () {
      table = $('.table').DataTable({
        processing: true,
        autoWidth: false,
        ajax: {
          url: '{{ route('products.data') }}'
        },
        columns: [
          {data: 'DT_RowIndex', searchable: false, sortable: false},
          {data: 'code_product'},
          {data: 'name_product'},
          {data: 'name_category'},
          {data: 'brand'},
          {data: 'purchase_price'},
          {data: 'selling_price'},
          {data: 'discount'},
          {data: 'stock'},
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
    $('#modal-form .modal-title').text('Tambah Produk');

    $('#modal-form form')[0].reset();
    $('#modal-form form').attr('action', url);
    $('#modal-form [name=_method]').val('post');
    $('#modal-form [name=name_product]').focus();


    }

    function editForm(url) {
    $('#modal-form').modal('show');
    $('#modal-form .modal-title').text('Edit Produk');

    $('#modal-form form').attr('action', url);
    $('#modal-form [name=_method]').val('put');
    $('#modal-form [name=name_product]').focus();

    $.get(url)
      .done((response)=> {
        $('#modal-form [name=name_product]').val(response.name_product);
        $('#modal-form [name=code_product]').val(response.code_product);
        $('#modal-form [name=id_category]').val(response.id_category);
        $('#modal-form [name=brand]').val(response.brand);
        $('#modal-form [name=purchase_price]').val(response.purchase_price);
        $('#modal-form [name=selling_price]').val(response.selling_price);
        $('#modal-form [name=discount]').val(response.discount);
        $('#modal-form [name=stock]').val(response.stock);
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