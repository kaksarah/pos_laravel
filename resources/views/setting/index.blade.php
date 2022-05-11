@extends('layouts.master')

@section('title')
    Pengaturan
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Pengaturan</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <form action="{{ route('setting.update') }}" class="form-setting" method="post" data-toggle="validator" enctype="multipart/form-data" >
                @csrf
                <div class="box-body">
                    <div class="alert alert-info alert-dismissible" style="display: none;">
                        <button type="button" class="close" data-dissmiss="alert" aria-hidden="true">&times;</button>
                        <i class="icon fa fa-check"> </i>Perubahan Berhasil Disimpan
                    </div>
                    <div class="form-group row">
                        <label for="company_name" class="col-lg-2 col-lg-offset-1 control-label">Nama Perusahaan</label>
                        <div class="col-lg-6">
                            <input type="text" name="company_name" class="form-control" id="company_name" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-lg-2 col-lg-offset-1 control-label">Telepon</label>
                        <div class="col-lg-6">
                            <input type="text" name="phone" class="form-control" id="phone" required >
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-lg-2 col-lg-offset-1 control-label">Alamat</label>
                        <div class="col-lg-6">
                            <textarea name="address" class="form-control" id="address" required rows="3"></textarea>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="path_logo" class="col-lg-2 col-lg-offset-1 control-label">Logo Perusahaan</label>
                        <div class="col-lg-4">
                            <input type="file" name="path_logo" class="form-control" id="path_logo" 
                            onchange="preview('.show-logo', this.files[0])" >
                            <span class="help-block with-errors"></span>
                            <br>
                            <div class="show-logo"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nota_type" class="col-lg-2 col-lg-offset-1 control-label">Tipe Nota</label>
                        <div class="col-lg-4">
                            <select name="nota_type" class="form-control" id="nota_type" required>
                                <option value="1">Nota Kecil</option>
                                <option value="2">Nota Besar</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="box-footer  text-right">
                        <button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Simpan Perubahan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function () {
        showData();
        
        $('.form-setting').validator().on('submit', function (e) {
            if (! e.preventDefault()) {
                $.ajax({
                    url: $('.form-setting').attr('action'),
                    type: $('.form-setting').attr('method'),
                    data: new FormData($('.form-setting')[0]),
                    async: false,
                    processData: false,
                    contentType: false
                })
                .done(response => {
                    showData();
                    $('.alert').fadeIn();
                    setTimeout(() => {
                        $('.alert').fadeOut();
                    }, 3000);
                })
                .fail(errors => {
                    alert('Tidak dapat menyimpan data');
                    return;
                });
            }
        });
    });

    function showData() {
        $.get('{{ route('setting.show')}}')
        .done(response => {
            $('[name=company_name').val(response.company_name);
            $('[name=address]').val(response.address);
            $('[name=phone]').val(response.phone);
            $('[name=nota_type]').val(response.nota_type);
            $('title').text(response.company_name + ' | Pengaturan');
            $('.logo-lg').text(response.company_name);
            $('.logo-mini').text(response.word);

            $('.show-logo').html(`<img src="{{ url('/') }}${response.path_logo}" width="200">`);
            $('[rel=icon]').attr('href', `{{ url('/') }}/${response.path_logo}`);
        })
        .fail(errors => {
            alert('Tidak dapat  menampilkan data');
            return;
        })
    }
</script>
@endpush