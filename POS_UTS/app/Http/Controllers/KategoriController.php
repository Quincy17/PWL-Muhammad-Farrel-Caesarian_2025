<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    public function index()
    {
        $data = DB::select('select * from m_kategori');
        return view('kategori.index', ['data' => $data]);
    }
}