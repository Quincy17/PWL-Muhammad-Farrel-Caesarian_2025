<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class SalesDetailController extends Controller
{
    public function index()
     {
         $data = DB::select('select * from t_penjualan_detail');
         return view('penjualan_detail.index', ['data' => $data]);
     }
}

