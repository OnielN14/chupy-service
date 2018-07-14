@extends('layouts.master')
@section('title', 'Map')
@section('content')
<!DOCTYPE html>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <h3 class="page-title">
        Map <small>finding the location of petshop</small>
        </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="index.html">Dashboard</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Map</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Petshop Map</a>
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
                            <i class="fa fa-globe"></i>Map
                        </div>
                        <div class="actions">
                            <a href="javascript:void(0)" class="btn btn-circle btn-primary btn-sm">
                            <i class="fa fa-plus"></i> Add </a>
                            <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:void(0)"  onclick="add_data()">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="mapTable">
                        <thead>
                        <tr>
                            <th>Nama Petshop</th>
                            <th>Deskripsi</th>
                            <th>Foto</th>
                            <th>Longitude</th>
                            <th>Latitude</th>  
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
@endsection
@section('js')
<script type="text/javascript">
    $(document).ready(function(){
        $('#mapTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('map.getPost') }}",
            columns: [
                {data: 'nama', name: 'nama'},
                {data: 'deskripsi', name: 'deskripsi'},
                {data: 'foto', name: 'foto'},
                {data: 'longitude', name: 'longitude'},
                {data: 'latitude', name: 'latitude'},
                {data: 'options', name: 'options'},
            ]
        });
    });
</script>
@endsection