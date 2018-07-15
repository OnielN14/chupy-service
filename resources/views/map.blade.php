@extends('layouts.master')
@section('title', 'Map')
@section('css')
<link href="{{ asset('custom/map.css') }}" rel="stylesheet" type="text/css"/>
@endsection
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
                            <a href="javascript:void(0)" class="btn btn-circle btn-primary btn-sm" onclick="add_data()">
                            <i class="fa fa-plus"></i> Add </a>
                            <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:void(0)"  >
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
@include('modal.modal-map')
@endsection

@section('js')

<script type="text/javascript">
    $(document).ready(function(){
       
        $('#mapTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('map.getMap') }}",
            columns: [
                {data: 'nama', name: 'nama'},
                {data: 'deskripsi', name: 'deskripsi'},
                {data: 'foto', name: 'foto'},
                {data: 'longitude', name: 'longitude'},
                {data: 'latitude', name: 'latitude'},
                {data: 'options', name: 'options'},
            ]
        });

        $('#imageMap').change(function () {
            var imgPath = $(this)[0].value;
            var ext = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
            if (ext == "gif" || ext == "png" || ext == "jpg" || ext == "jpeg")
                readURL(this);
            else
                alert("Please select image file (jpg, jpeg, png).")
        });
     
        $('#modal-map').on('shown.bs.modal', function () {
         chupyMap();
        });
        
     
    });

    function changeProfile() {
        $('#imageMap').click();
    }

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.onload = function (e) {
                $('#preview').attr('src', e.target.result);
                $('#remove').val(0);
            }
        }
    }
    function removeImage() {
        $('#preview').attr('src', 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image');
        $('#remove').val(1);
    }
   
    function add_data(){
        $('#modal-map').modal('hide');
        $('#form-map')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal-map').modal('show'); // show bootstrap modal
        $('#modal-title').text('Add New Map');
    }

  var map;

    function chupyMap() {
        var unikom = {lat: -6.886566, lng: 107.615287};
        var map = new google.maps.Map(document.getElementById("chupyMap"), {
            zoom: 18, 
            center: unikom
        });

        var marker = new google.maps.Marker({position: unikom, map: map, draggable: true});

        google.maps.event.addListener(marker, 'dragend', function (x) 
        {
        document.getElementById('latitude').value = x.latLng.lat();
        document.getElementById('longitude').value = x.latLng.lng();   
            var geocoder = new google.maps.Geocoder;
            var infowindow = new google.maps.InfoWindow;                
        }); 

        google.maps.event.addListener(map, 'click', function(x) 
        {
        document.getElementById('latitude').value = x.latLng.lat();
        document.getElementById('longitude').value = x.latLng.lng();
            var geocoder = new google.maps.Geocoder;
            var infowindow = new google.maps.InfoWindow;                
        });


        var input = document.getElementById('searchBox');
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);
    
        var infowindow = new google.maps.InfoWindow();
    
        autocomplete.addListener('place_changed', function() {
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                window.alert("Autocomplete's returned place contains no geometry");
                return;
            }
      
            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }
            marker.setIcon(({
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(35, 35)
            }));
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);
        
            var address = '';
            if (place.address_components) {
                address = [
                  (place.address_components[0] && place.address_components[0].short_name || ''),
                  (place.address_components[1] && place.address_components[1].short_name || ''),
                  (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }
        
            infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
            infowindow.open(map, marker);

        document.getElementById('latitude').value  = place.geometry.location.lat();
        document.getElementById('longitude').value  = place.geometry.location.lng();
      
        });
    }


</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDj_tlXwd6RsGXqMHIKlWOgJRlx83kC7Gs&libraries=places&callback=chupyMap" async defer></script>

@endsection 