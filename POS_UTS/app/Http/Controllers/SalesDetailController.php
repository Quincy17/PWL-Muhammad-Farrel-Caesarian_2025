<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenjualanDetailModel;

class SalesDetailController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Data Detail Penjualan',
            'list' => ['Home', 'Detail Penjualan']
        ];

        $page = (object)[
            'title' => 'Daftar Detail Penjualan'
        ];

        $data = PenjualanDetailModel::all();
        $activeMenu = 'penjualan_detail';

        return view('penjualan_detail.index', compact('breadcrumb', 'page', 'data', 'activeMenu'));
    }

    public function create()
    {
        $breadcrumb = (object)[
            'title' => 'Tambah Detail Penjualan',
            'list' => ['Home', 'Detail Penjualan', 'Tambah']
        ];

        $page = (object)[
            'title' => 'Tambah detail penjualan'
        ];

        $activeMenu = 'penjualan_detail';

        return view('penjualan_detail.create', compact('breadcrumb', 'page', 'activeMenu'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'penjualan_id' => 'required|numeric',
            'barang_id' => 'required|numeric',
            'harga' => 'required|numeric',
            'jumlah' => 'required|numeric',
        ]);

        PenjualanDetailModel::create($request->all());

        return redirect('/penjualan_detail')->with('success', 'Detail penjualan berhasil disimpan');
    }

    public function show($id)
    {
        $detail = PenjualanDetailModel::find($id);

        $breadcrumb = (object)[
            'title' => 'Detail Data Penjualan',
            'list' => ['Home', 'Detail Penjualan', 'Lihat']
        ];

        $page = (object)[
            'title' => 'Lihat detail penjualan'
        ];

        $activeMenu = 'penjualan_detail';

        return view('penjualan_detail.show', compact('breadcrumb', 'page', 'detail', 'activeMenu'));
    }

    public function edit($id)
    {
        $detail = PenjualanDetailModel::find($id);

        $breadcrumb = (object)[
            'title' => 'Edit Detail Penjualan',
            'list' => ['Home', 'Detail Penjualan', 'Edit']
        ];

        $page = (object)[
            'title' => 'Edit detail penjualan'
        ];

        $activeMenu = 'penjualan_detail';

        return view('penjualan_detail.edit', compact('breadcrumb', 'page', 'detail', 'activeMenu'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'penjualan_id' => 'required|numeric',
            'barang_id' => 'required|numeric',
            'harga' => 'required|numeric',
            'jumlah' => 'required|numeric',
        ]);

        PenjualanDetailModel::find($id)->update($request->all());

        return redirect('/penjualan_detail')->with('success', 'Detail penjualan berhasil diubah');
    }

    public function destroy($id)
    {
        $check = PenjualanDetailModel::find($id);

        if (!$check) {
            return redirect('/penjualan_detail')->with('error', 'Data tidak ditemukan');
        }

        try {
            PenjualanDetailModel::destroy($id);
            return redirect('/penjualan_detail')->with('success', 'Detail penjualan berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/penjualan_detail')->with('error', 'Gagal menghapus data karena masih terhubung dengan tabel lain');
        }
    }

    public function list(Request $request)
{
    $data = PenjualanDetailModel::all();

    return datatables()->of($data)
        ->addIndexColumn()
        ->addColumn('aksi', function ($row) {
            $btn = '<a href="'.url('penjualan_detail/'.$row->detail_id).'" class="btn btn-sm btn-info">Lihat</a> ';
            $btn .= '<a href="'.url('penjualan_detail/'.$row->detail_id.'/edit').'" class="btn btn-sm btn-warning">Edit</a> ';
            $btn .= '<form method="POST" action="'.url('penjualan_detail/'.$row->detail_id).'" style="display:inline-block">
                        '.csrf_field().method_field('DELETE').'
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Yakin hapus data?\')">Hapus</button>
                    </form>';
            return $btn;
        })
        ->rawColumns(['aksi'])
        ->make(true);
}

}
