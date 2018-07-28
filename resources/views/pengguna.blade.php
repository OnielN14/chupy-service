@extends('layouts.master')
@section('title', 'Pengguna')
@section('content')

<!DOCTYPE html>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <h3 class="page-title">
        Pengguna <small>All user can access Chupy</small>
        </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="index.html">Dashboard</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Pengguna</a>
                </li>
            </ul>
         
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box blue-hoki">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-user"></i>Pengguna
                        </div>
                        <div class="actions">
                            <button class="btn btn-circle btn-primary btn-sm" data-toggle="modal" data-target="#modal-pengguna">
                            <i class="fa fa-plus"></i> Add </button>
                            <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:void(0)"  >
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="penggunaTable">
                        <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No HP</th>
                            <th>Hak Akses</th>  
                            <th>Foto</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        
                        </tbody>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
      
        <!-- END PAGE CONTENT-->
    </div>
</div>
<!-- END CONTENT -->
@include('modal.modal-pengguna')
@endsection

@section('js')

<script type="text/javascript">
    $(document).ready(function(){
       
        $('#penggunaTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('getPengguna') }}",
            columns: [
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'notelepon', name: 'notelepon'},
                {data: 'levelAkses', name: 'levelAkses'},
                {data: 'foto', name: 'foto'},
                {data: 'options', name: 'options'},
            ]
        });

        $('form#form-pengguna-new').submit(function(e) {
            tambahPengguna();
            return false
          })
    });

    function tambahPengguna()
    {
        let form = document.querySelector('form#form-pengguna-new')
        let data = new FormData(form)

        $('#modal-pengguna').modal('toggle')
        $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
          url: '/pengguna/addPengguna',
          method: 'post',
          dataType: 'json',
          contentType: false,
          processData: false,
          data: data,
          beforeSend: function(response) {
            $('#chupy-msg').removeClass('show')
            $('#chupy-msg').removeClass('alert-warning')
            $('#chupy-msg').removeClass('alert-primary')
            $('#chupy-msg').removeClass('alert-danger')
            $('#chupy-msg').removeClass('alert-success')
      
            $('#chupy-msg').find('strong').text('Harap tunggu')
            $('#chupy-msg').find('strong + span').text('Permintaan sedang diproses..')
      
            $('#chupy-msg').addClass('alert-primary')
            $('#chupy-msg').addClass('show')
          }
        }).done(function(response) {
            $('#chupy-msg').addClass('alert-success')
        
            $('#chupy-msg').find('strong').text('Sukses')
            $('#chupy-msg').find('strong + span').text('Produk berhasil ditambahkan.')
            $('#chupy-msg').addClass('show')
            setTimeout(function() {
              location.reload();
            }, 1000)
          }).fail(function(response) {
            $('#chupy-msg').addClass('alert-danger')
        
            $('#chupy-msg').find('strong').text('Gagal')
            $('#chupy-msg').find('strong + span').text('Terjadi kesalahan.')
        
            $('#chupy-msg').addClass('show')
          })
    }

    function delete_data(id)
    {
        
        $.ajax({
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
        url: '/pengguna/deletePengguna/'+id,
        method: 'delete',
        dataType: 'json',
        contentType: false,
        processData: false,
        data: id,
          beforeSend: function(response) {
            $('#chupy-msg').removeClass('show')
            $('#chupy-msg').removeClass('alert-warning')
            $('#chupy-msg').removeClass('alert-primary')
            $('#chupy-msg').removeClass('alert-danger')
            $('#chupy-msg').removeClass('alert-success')
      
            $('#chupy-msg').find('strong').text('Harap tunggu')
            $('#chupy-msg').find('strong + span').text('Permintaan sedang diproses..')
      
            $('#chupy-msg').addClass('alert-primary')
            $('#chupy-msg').addClass('show')
          }
        }).done(function(response) {
          $('#chupy-msg').addClass('alert-success')
      
          $('#chupy-msg').find('strong').text('Sukses')
          $('#chupy-msg').find('strong + span').text('Produk berhasil dihapus.')
          $('#chupy-msg').addClass('show')
          setTimeout(function() {
            location.reload();
          }, 1000)
      
        }).fail(function(response) {
          $('#chupy-msg').addClass('alert-danger')
      
          $('#chupy-msg').find('strong').text('Gagal')
          $('#chupy-msg').find('strong + span').text('Terjadi kesalahan.')
      
          $('#chupy-msg').addClass('show')
        })
    }
</script>
@endsection