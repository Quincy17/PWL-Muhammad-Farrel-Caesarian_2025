<?php

namespace App\Http\Controllers;
 
 use App\Models\StokModel;
 use App\Models\BarangModel;
 use App\Models\UserModel;
 use App\Models\SupplierModel;
 use Illuminate\Http\Request;
 use Illuminate\Support\Facades\DB;
 use Yajra\DataTables\Facades\DataTables;
 
 class StokController extends Controller
 {
     // Menampilkan halaman awal stok
     public function index()
     {
         $data = DB::select('select * from t_stok');
         
         $breadcrumb = (object) [
             'title' => 'Data Stok',
             'list' => ['Home', 'Stok']
         ];
 
         $page = (object) [
             'title' => 'Daftar data stok barang'
         ];
 
         $activeMenu = 'stok';
 
         $barang = BarangModel::all(); // untuk filter barang
         $supplier = SupplierModel::all(); // untuk filter supplier
 
         return view('stok.index', compact('breadcrumb', 'page', 'activeMenu', 'barang', 'supplier'));
     }
 
     // Ambil data stok dalam bentuk json untuk datatables
     public function list(Request $request)
     {
         $stok = StokModel::with(['barang', 'user', 'supplier']);
 
         if ($request->barang_id) {
             $stok->where('barang_id', $request->barang_id);
         }
 
         if ($request->supplier_id) {
             $stok->where('supplier_id', $request->supplier_id);
         }
 
         return DataTables::of($stok)
             ->addIndexColumn()
             ->addColumn('aksi', function ($s) {
                 $btn  = '<a href="' . url('/stok/' . $s->stok_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                 $btn .= '<a href="' . url('/stok/' . $s->stok_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                 $btn .= '<form class="d-inline-block" method="POST" action="' . url('/stok/' . $s->stok_id) . '">'
                       . csrf_field()
                       . method_field('DELETE')
                       . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin ingin menghapus data ini?\');">Hapus</button>'
                       . '</form>';
                 return $btn;
             })
             ->rawColumns(['aksi'])
             ->make(true);
     }
 
     // Menampilkan form tambah stok
     public function create()
     {
         $breadcrumb = (object) [
             'title' => 'Tambah Stok',
             'list' => ['Home', 'Stok', 'Tambah']
         ];
 
         $page = (object) [
             'title' => 'Tambah data stok baru'
         ];
 
         $barang = BarangModel::all();
         $user = UserModel::all();
         $supplier = SupplierModel::all();
         $activeMenu = 'stok';
 
         return view('stok.create', compact('breadcrumb', 'page', 'barang', 'user', 'supplier', 'activeMenu'));
     }
 
     // Simpan data stok baru
     public function store(Request $request)
     {
         $request->validate([
             'barang_id' => 'required|integer',
             'user_id' => 'required|integer',
             'supplier_id' => 'required|integer',
             'stok_tanggal' => 'required|date',
             'stok_jumlah' => 'required|integer|min:1',
         ]);
 
         StokModel::create($request->all());
 
         return redirect('/stok')->with('success', 'Data stok berhasil disimpan');
     }
 
     // Tampilkan detail stok
     public function show($id)
     {
         $stok = StokModel::with(['barang', 'user', 'supplier'])->find($id);
 
         $breadcrumb = (object) [
             'title' => 'Detail Stok',
             'list' => ['Home', 'Stok', 'Detail']
         ];
 
         $page = (object) [
             'title' => 'Detail data stok'
         ];
 
         $activeMenu = 'stok';
 
         return view('stok.show', compact('breadcrumb', 'page', 'stok', 'activeMenu'));
     }
 
     // Tampilkan form edit stok
     public function edit($id)
     {
         $stok = StokModel::find($id);
         $barang = BarangModel::all();
         $user = UserModel::all();
         $supplier = SupplierModel::all();
 
         $breadcrumb = (object) [
             'title' => 'Edit Stok',
             'list' => ['Home', 'Stok', 'Edit']
         ];
 
         $page = (object) [
             'title' => 'Edit data stok'
         ];
 
         $activeMenu = 'stok';
 
         return view('stok.edit', compact('breadcrumb', 'page', 'stok', 'barang', 'user', 'supplier', 'activeMenu'));
     }
 
     // Simpan perubahan data stok
     public function update(Request $request, $id)
     {
         $request->validate([
             'barang_id' => 'required|integer',
             'user_id' => 'required|integer',
             'supplier_id' => 'required|integer',
             'stok_tanggal' => 'required|date',
             'stok_jumlah' => 'required|integer|min:1',
         ]);
 
         StokModel::find($id)->update($request->all());
 
         return redirect('/stok')->with('success', 'Data stok berhasil diubah');
     }
 
     // Hapus data stok
     public function destroy($id)
     {
         $check = StokModel::find($id);
 
         if (!$check) {
             return redirect('/stok')->with('error', 'Data stok tidak ditemukan');
         }
 
         try {
             StokModel::destroy($id);
             return redirect('/stok')->with('success', 'Data stok berhasil dihapus');
         } catch (\Illuminate\Database\QueryException $e) {
             return redirect('/stok')->with('error', 'Gagal menghapus data stok karena data masih terhubung dengan tabel lain');
         }
     }
 }