<?php

namespace App\Http\Controllers;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Pengguna;
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
                    $url=asset($query->foto);
                    return '<img src="'.$url.'" alt="Pengguna Image" height="50" width="50"> ';
                })
               ->addColumn('options', function($query){
                   return '<button type="button" class="btn btn-circle btn-xs blue" onclick="edit_data('."'".$query->id."'".')">Edit</button> <button type="button" class="btn btn-circle btn-xs red" data-target="hapus-modal-pengguna" data-toggle="modal">Delete</button>';
               })
               ->rawColumns(['options','foto', 'confirmed'])
               ->toJson();
    }

    public function addPengguna(Request $request)
    {
  //      dd($request);
        $_pengguna =new Pengguna();
       
        $hakakses =$request->input('hakakses');
        switch ($hakakses) {
            case 'admin':
            $idHakakses =1;
            break;
            case 'pengguna':
            $idHakakses =2;
            break;
            case 'pemilik':
            $idHakakses =3;
            break;
            default:
            die('ERROR WE DON\'T HAVE THIS ACTION!');
            exit;
            break;
        }

        if ($request->hasFile('foto')) {
            $imageKonten  = $request->file('foto');
            $imageName =$imageKonten->getClientOriginalName();
            $imageKonten->move(public_path().'/storage/img/img_pengguna/',$imageName);
            $pathImage = '/storage/img/img_pengguna/'.$imageName;
               
        }
        $_pengguna->name        =$request->input('nama');
        $_pengguna->email       =$request->input('email');
        $_pengguna->notelepon   =$request->input('nohp');
        $_pengguna->idHakakses =$idHakakses;
        $_pengguna->foto        =$pathImage;
        $_pengguna->save();


    }

    public function deletePengguna($id)
    {
        $_pengguna = new Pengguna();
        $_pengguna = $_pengguna->findOrFail($id);
        $pathImage = public_path().$_pengguna->foto;
        if (file_exists($pathImage)) {
            unlink($pathImage);
        }
        if (empty($_pengguna)) {
            return response()->json('Not Found');
        }
        $_pengguna->delete();
        // return $this->sendResponse($id, 'Pengguna deleted successfully');
    }

    public function editPengguna($id,Request $request)
    {
        $_pengguna = new Pengguna();
        $_pengguna = $_pengguna->findOrFail($id);


    }
}
