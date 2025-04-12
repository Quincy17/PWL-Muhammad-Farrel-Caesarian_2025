<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class SalesController extends Controller
{
    public function index()
     {
         $data = DB::select('select * from t_penjualan');
         return view('penjualan.index', ['data' => $data]);
     }
}

