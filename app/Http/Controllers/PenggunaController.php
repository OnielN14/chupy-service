<?php

namespace App\Http\Controllers;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Response;

class PenggunaController extends Controller
{
    //
    public function index()
    {
        return view('pengguna');
    }
}
