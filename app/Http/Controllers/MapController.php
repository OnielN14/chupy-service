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

    public function getMap()
    {
        $query = DB::table('map')->select('id','longitude','latitude');
        return DataTables::of($query)
               ->addColumn('options', function($query){
                   return '<button type="button" class="btn btn-circle btn-xs blue" onclick="edit_data('."'".$query->id."'".')">Edit</button> <button type="button" class="btn btn-circle btn-xs red" onclick="delete_data('."'".$query->id."'".')">Delete</button>';
               })
               ->rawColumns(['options', 'confirmed'])
               ->toJson();
    }

 
}
