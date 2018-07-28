 {{-- MODAL ADD --}}
<!-- /.modal -->
<div class="modal fade " id="modal-pengguna" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title" id="modal-title">
                    <strong>Add New Pengguna</strong>
                </h4>
            </div>
            <div class="modal-body">
                <form id="form-pengguna-new">
                    <div class="row">
                        <div class="col-md-12">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukan Nama" required autofocus>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="example@gmail.com" required>
                            </div>
                            <div class="form-group">
                                <label for="nohp">No HP</label>
                                <input type="tel" name="nohp" id="nohp" class="form-control" placeholder="Masukan No HP" required>
                            </div>
                            <div class="form-group">
                                <label for="hakakses">Hak Akses</label>
                              <select name="hakakses" id="hakakses" class="form-control">
                                  <option value="admin">Admin</option>
                                  <option value="pengguna">Pengguna</option>
                                  <option value="pemilik">Pemilik Petshop</option>
                              </select>
                            </div>
                            <div class="form-group">
                                <label for="foto">Foto</label>
                                <input type="file" name="foto" id="foto" >
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn blue" form="form-pengguna-new">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->