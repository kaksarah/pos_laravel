@extends('layouts.master')

@section('title')
    Transaksi Penjualan
@endsection

@push('css')
<style>
    .tampil-bayar {
        font-size: 5em;
        text-align: center;
        height: 100px;
    }

    .tampil-terbilang {
        padding: 10px;
        background: #f0f0f0;
    }

    .table-selling tbody tr:last-child {
        display: none;
    }

    @media(max-width: 768px) {
        .tampil-bayar {
            font-size: 3em;
            height: 70px;
            padding-top: 5px;
        }
    }
</style>
@endpush

@section('breadcrumb')
    @parent
    <li class="active">Transaksi Penjualan</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            
            <div class="box-body">
                    
                <form class="form-product">
                    @csrf
                    <div class="form-group row">
                        <label for="code_product" class="col-lg-2">Kode product</label>
                        <div class="col-lg-5">
                            <div class="input-group">
                                <input type="hidden" name="id_sale" id="id_sale" value="{{ $id_sale }}">
                                <input type="hidden" name="id_product" id="id_product">
                                <input type="text" class="form-control" name="code_product" id="code_product">
                                <span class="input-group-btn">
                                    <button onclick="tampilproduct()" class="btn btn-info btn-flat" type="button"><i class="fa fa-arrow-right"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                </form>

                <table class="table table-stiped table-bordered table-selling">
                    <thead>
                        <th width="5%">No</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th width="15%">Jumlah</th>
                        <th>Subtotal</th>
                        <th width="15%"><i class="fa fa-cog"></i></th>
                    </thead>
                </table>

                <div class="row">
                    <div class="col-lg-8">
                        <div class="tampil-bayar bg-primary"></div>
                        <div class="tampil-terbilang"></div>
                    </div>
                    <div class="col-lg-4">
                        <form action="{{ route('transaction.simpan') }}" class="form-sales" method="post">
                            @csrf
                            <input type="hidden" name="id_sale" value="{{ $id_sale }}">
                            <input type="hidden" name="total" id="total">
                            <input type="hidden" name="total_item" id="total_item">
                            

                            <div class="form-group row">
                                <label for="totalrp" class="col-lg-2 control-label">Total</label>
                                <div class="col-lg-8">
                                    <input type="text" id="totalrp" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="diterima" class="col-lg-2 control-label">Diterima</label>
                                <div class="col-lg-8">
                                    <input type="text" id="diterima" name="diterima" class="form-control" value="0" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kembalirp" class="col-lg-2 control-label">Kembali</label>
                                <div class="col-lg-8">
                                    <input type="text" id="kembalirp" name="kembalirp" class="form-control" value="0" readonly>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-sm btn-flat pull-right btn-simpan"><i class="fa fa-floppy-o"></i> Simpan Transaksi</button>
            </div>
        </div>
    </div>
</div>

@includeIf('sale_detail.product')
@endsection

@push('scripts')
<script>
    let table, table2;

    $(function () {
        $('body').addClass('sidebar-collapse');

        table = $('.table-selling').DataTable({
            processing: true,
            autoWidth: false,
            ajax: {
                url: '{{ route('transaction.data', $id_sale) }}',
            },
            columns: [
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'code_product'},
                {data: 'name_product'},
                {data: 'selling_price'},
                {data: 'total'},
                {data: 'subtotal'},
                {data: 'action', searchable: false, sortable: false},
            ],
            dom: 'Brt',
            bSort: false,
        })
        .on('draw.dt', function () {
            loadForm();
        });
        table2 = $('.table-product').DataTable();

        $(document).on('input', '.quantity', function () {
            let id = $(this).data('id');
            let total = parseInt($(this).val());
            if (total < 1) {
                $(this).val(1);
                alert('Jumlah tidak boleh kurang dari 1');
                return;
            }
            if (total > 10000) {
                $(this).val(10000);
                alert('jumlah tidak boleh lebih dari 10000');
                return;
            }
            $.post(`{{ url('/Transaction') }}/${id}`, {
                    '_token': $('[name=csrf-token]').attr('content'),
                    '_method': 'put',
                    'total': total
                })
                .done(response => {
                    $(this).on('mouseout', function () {
                        table.ajax.reload();
                    });
                })
                .fail(errors => {
                    alert('Tidak dapat menyimpan data');
                    return;
                });
        });

        $('#diterima').on('input', function () {
            if ($(this).val() == "" ) {
                $(this).val(0).select();
            }

            loadForm($(this).val());
        } ).focus(function() {
            $(this).select();
        } );

        $('.btn-simpan').on('click', function () {
            $('.form-sales').submit();
        });
    });

    function tampilproduct() {
        $('#modal-product').modal('show');
    }

    function hideproduct() {
        $('#modal-product').modal('hide');
    }

    function pilihProduct(id, code) {
        $('#id_product').val(id);
        $('#code_product').val(code);
        hideproduct();
        tambahproduct();
    }

    function tambahproduct() {
        $.post('{{ route('Transaction.store') }}', $('.form-product').serialize())
            .done(response => {
                $('#code_product').focus();
                
                table.ajax.reload(() => loadForm());
            })
            .fail(errors => {
                alert('Tidak dapat menyimpan data');
                return;
            });
    }

    function deleteData(url) {
        if (confirm('Yakin ingin menghapus data terpilih?')) {
            $.post(url, {
                    '_token': $('[name=csrf-token]').attr('content'),
                    '_method': 'delete'
                })
                .done((response) => {
                    table.ajax.reload(() => loadForm());
                })
                .fail((errors) => {
                    alert('Tidak dapat menghapus data');
                    return;
                });
        }
    }


    function loadForm(diterima = 0) {
        console.log(diterima);
        $('#total').val($('.total').text());
        $('#total_item').val($('.total_item').text());

        $.get(`{{ url('/Transaction/loadform') }}/${$('.total').text()}/${diterima}`)
            .done(response => {
                $('#totalrp').val('Rp. '+ response.totalrp);

                $('#bayar').val(response.bayar);
                $('#kembalirp').val(response.kembalirp);

                if ($('#diterima').val() != 0 ) {
                    $('.tampil-bayar').text('Kembali : '+ response.kembalirp);
                    $('.tampil-terbilang').text(response.kembali_terbilang);

                }
            })
            .fail(errors => {
                alert('Tidak dapat menampilkan data');
                return;
            });
    }
</script>
@endpush