<!-- Modal -->
<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form">
  <div class="modal-dialog" role="document">
    <form action="" method="post" class="form-horizontal">
        @csrf
        @method('post')
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
            <div class="form-group row">
                <label for="name_product" class="col-md-2 col-md-offset-1 control-label">Nama</label>
                <div class="col-md-6">
                    <input type="text" name="name_product" id="name_product" class="form-control" required autofocus>
                    <span class="help-block with-errors"></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="code_product" class="col-md-2 col-md-offset-1 control-label">Kode</label>
                <div class="col-md-6">
                    <input type="text" name="code_product" id="code_product" class="form-control" >
                    <span class="help-block with-errors"></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="id_category" class="col-md-2 col-md-offset-1 control-label">Kategori</label>
                <div class="col-md-6">
                    <select name="id_category" id="id_category" class="form-control" required>
                        <option value="">Pilih Kategori</option>
                        @foreach ($category as $key => $item)
                            <option value="{{ $key }}">{{ $item }}</option>
                        @endforeach
                        </select>
                    <span class="help-block with-errors"></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="brand" class="col-md-2 col-md-offset-1 control-label">Merk</label>
                <div class="col-md-6">
                    <input type="text" name="brand" id="brand" class="form-control" value="Tidak Ada Merk">
                    <span class="help-block with-errors"></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="purchase_price" class="col-md-2 col-md-offset-1 control-label">Harga Beli</label>
                <div class="col-md-6">
                    <input type="number" name="purchase_price" id="purchase_price" class="form-control" >
                    <span class="help-block with-errors"></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="selling_price" class="col-md-2 col-md-offset-1 control-label">Harga Jual</label>
                <div class="col-md-6">
                    <input type="number" name="selling_price" id="selling_price" class="form-control" required >
                    <span class="help-block with-errors"></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="discount" class="col-md-2 col-md-offset-1 control-label">Diskon</label>
                <div class="col-md-6">
                    <input type="number" name="discount" id="discount" class="form-control" value="0">
                    <span class="help-block with-errors"></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="stock" class="col-md-2 col-md-offset-1 control-label">Stok</label>
                <div class="col-md-6">
                    <input type="number" name="stock" id="stock" class="form-control" required value="0">
                    <span class="help-block with-errors"></span>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-sm btn-flat btn-primary">Simpan</button>
            <button type="button" class="btn btn-sm btn-flat btn-default" data-dismiss="modal">Batal</button>

        </div>
        </div>
    </form>
  </div>
</div>