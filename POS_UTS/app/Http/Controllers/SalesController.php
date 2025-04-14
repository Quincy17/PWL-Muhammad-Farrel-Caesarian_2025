<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenjualanModel;
use App\Models\UserModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class SalesController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Data Penjualan',
            'list' => ['Home', 'Penjualan']
        ];

        $page = (object)[
            'title' => 'Daftar Penjualan'
        ];

        $penjualan = PenjualanModel::all();
        
        $activeMenu = 'penjualan';

        return view('penjualan.index', compact('breadcrumb', 'page', 'penjualan', 'activeMenu'));
    }

    public function create()
    {
        $users = DB::table('m_user')->get(); // Mengambil semua data pengguna
        $breadcrumb = (object)[
            'title' => 'Tambah Penjualan',
            'list' => ['Home', 'Penjualan', 'Tambah']
        ];

        $page = (object)[
            'title' => 'Tambah data penjualan baru'
        ];

        $activeMenu = 'penjualan';

        return view('penjualan.create', compact('breadcrumb', 'page', 'activeMenu','users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'penjualan_tanggal' => 'required|date',
            'penjualan_kode' => 'required',
            'pembeli' => 'required',
            'user_id' => 'required|exists:m_user,user_id',
        ]);

        
        PenjualanModel::create($request->all());

        return redirect('/penjualan')->with('success', 'Data penjualan berhasil disimpan');
    }

    public function show($id)
    {
        $penjualan = PenjualanModel::find($id);

        $breadcrumb = (object)[
            'title' => 'Detail Penjualan',
            'list' => ['Home', 'Penjualan', 'Detail']
        ];

        $page = (object)[
            'title' => 'Detail data penjualan'
        ];
        $users = DB::table('m_user')->get(); // Mengambil semua data pengguna
        $activeMenu = 'penjualan';

        return view('penjualan.show', compact('breadcrumb', 'page', 'penjualan', 'activeMenu','users'));
    }

    public function edit($id)
    {
        $penjualan = PenjualanModel::find($id);

        $breadcrumb = (object)[
            'title' => 'Edit Penjualan',
            'list' => ['Home', 'Penjualan', 'Edit']
        ];

        $page = (object)[
            'title' => 'Edit data penjualan'
        ];
        $users = DB::table('m_user')->get(); // Mengambil semua data pengguna
        $activeMenu = 'penjualan';

        return view('penjualan.edit', compact('breadcrumb', 'page', 'penjualan', 'activeMenu','users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'penjualan_tanggal' => 'required|date',
            'penjualan_kode' => 'required',
            'pembeli' => 'required',
            'user_id' => 'required|exists:m_user,user_id',
        ]);

        PenjualanModel::find($id)->update($request->all());

        return redirect('/penjualan')->with('success', 'Data penjualan berhasil diubah');
    }

    public function destroy($id)
    {
        $check = PenjualanModel::find($id);

        if (!$check) {
            return redirect('/penjualan')->with('error', 'Data penjualan tidak ditemukan');
        }

        try {
            PenjualanModel::destroy($id);
            return redirect('/penjualan')->with('success', 'Data penjualan berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/penjualan')->with('error', 'Gagal menghapus data penjualan karena masih terhubung dengan tabel lain');
        }
    }

    public function list(Request $request)
    {
        $data = PenjualanModel::with('user')->orderBy('penjualan_id', 'ASC');
        
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($p) {
                

                $btn = '<button onclick="modalAction(\'' . url('/penjualan/' . $p->penjualan_id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/penjualan/' . $p->penjualan_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/penjualan/' . $p->penjualan_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button>';
                 return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function confirm_ajax(string $id)
     {
         $penjualan = PenjualanModel::find($id);
 
         return view('penjualan.confirm_ajax', ['penjualan' => $penjualan]);
     }

     public function delete_ajax(Request $request, $id)
     {
         // Mengecek apakah request dari ajax
         if ($request->ajax() || $request->wantsJson()) {
             $penjualan = PenjualanModel::find($id);
             if ($penjualan) {
                 try {
                     $penjualan->delete();
                     return response()->json([
                         'status' => true,
                         'message' => 'Data berhasil dihapus'
                     ]);
                 } catch (\Illuminate\Database\QueryException $e) {
                     return response()->json([
                         'status' => false,
                         'message' => 'Data tidak bisa dihapus'
                     ]);
                 }
             } else {
                 return response()->json([
                     'status' => false,
                     'message' => 'Data tidak ditemukan'
                 ]);
             }
         }
         return redirect('/');
     }
}
