<?php

namespace App\Http\Controllers;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Response;
use DB;
use DataTables;

class PenggunaController extends Controller
{
    //
    public function index()
    {
        return view('pengguna');
    }

    public function getPengguna()
    {
        $query = DB::table('pengguna')
        ->join('hakakses','pengguna.idHakakses','=','hakakses.id')
        ->select('pengguna.id','pengguna.name','pengguna.email','pengguna.notelepon','hakakses.levelAkses','pengguna.foto');

        return DataTables::of($query)
               ->editColumn('foto', function($query) {
                    $url=asset("storage/img/img_pengguna/".$query->foto);
                    return '<img src="'.$url.'" alt="Pengguna Image" height="50" width="50"> ';
                })
               ->addColumn('options', function($query){
                   return '<button type="button" class="btn btn-circle btn-xs blue" onclick="edit_data('."'".$query->id."'".')">Edit</button> <button type="button" class="btn btn-circle btn-xs red" onclick="delete_data('."'".$query->id."'".')">Delete</button>';
               })
               ->rawColumns(['options','foto', 'confirmed'])
               ->toJson();
    }
}
