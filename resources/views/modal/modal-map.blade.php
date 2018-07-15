{{-- MODAL ADD --}}
<!-- /.modal -->
<div class="modal fade bs-modal-lg" id="modal-map" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title" id="modal-title">
                    <strong></strong>
                </h4>
            </div>
            <div class="modal-body">
                <form id="form-map">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="namaPetshop">Nama Petshop</label>
                                <input type="text" class="form-control" name="petshop" id="petshop" placeholder="Nama Petshop" required>
                            </div>

                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" id="deskripsi" cols="5" rows="3" placeholder="Masukan deskripsi Petshop"></textarea>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Foto Petshop</label>
                                <div class="input-group ">
                                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" height="200px" width="200px" alt="..." id="preview"
                                        class="align-middle" />
                                    <input type="file" name="imageMap" id="imageMap" style="display: none" class="mb-3" />
                                </div>
                                <div class="input-group">
                                    <a href="javascript:changeProfile();" class="btn btn-xs btn-primary mx-3 ">Change</a>
                                    <a href="javascript:removeImage()" class="btn btn-xs btn-danger mx-3">Remove</a>
                                    <input type="hidden" style="display: none" value="0" name="remove" id="remove">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <input id="searchBox" class="controls" type="text" placeholder="Masukan Alamat Petshop">
                            <div class="embed-responsive embed-responsive-16by9">
                                <div id="chupyMap" style="width:400px;height:200px;background:yellow" class="embed-responsive-item"></div>
                            </div>

                            <div class="form-group">
                                <label for="latitude">Latitude</label>
                                <input type="text" name="latitude" id="latitude" class="form-control" placeholder="Latitude">
                            </div>
                            <div class="form-group">
                                <label for="longitude">Longitude</label>
                                <input type="text" name="longitude" id="longitude" class="form-control" placeholder="Longitude">
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn default" data-dismiss="modal">Close</button>
                <button type="button" class="btn blue">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->