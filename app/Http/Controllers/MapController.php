<?php

namespace App\Http\Controllers;

use App\Models\Map;
use Illuminate\Http\Request;
use DataTables;
use DB;

class MapController extends Controller
{

    public function index()
    {
        return view('map');
    }

    public function getPost()
    {
        $query = DB::table('map')->select('id','nama','deskripsi','foto','longitude','latitude');
        return DataTables::of($query)
               ->editColumn('foto', function($query) {
                    $url=asset("storage/img/img_map/".$query->foto);
                    return '<img src="'.$url.'" alt="Map Image" height="50" width="50"> ';
                })
               ->addColumn('options', function($query){
                   return '<button type="button" class="btn btn-circle btn-xs blue" onclick="edit_data('."'".$query->id."'".')">Edit</button> <button type="button" class="btn btn-circle btn-xs red" onclick="delete_data('."'".$query->id."'".')">Delete</button>';
               })
               ->rawColumns(['options','foto', 'confirmed'])
               ->toJson();
    }

 
}
