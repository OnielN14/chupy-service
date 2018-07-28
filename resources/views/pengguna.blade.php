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
@include('modal.modal-map')
@endsection

@section('js')

<script type="text/javascript">
    $(document).ready(function(){
       
        $('#mapTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('map.getPengguna') }}",
            columns: [
                {data: 'nama', name: 'nama'},
                {data: 'email', name: 'email'},
                {data: 'noHp', name: 'noHp'},
                {data: 'hakAkses', name: 'hakAkses'},
                {data: 'foto', name: 'foto'},
                {data: 'options', name: 'options'},
            ]
        });
    });