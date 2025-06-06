<?php
 
 namespace App\Http\Controllers;
 
 use Illuminate\Http\Request;
 use App\Models\SupplierModel;
 use Yajra\DataTables\Facades\DataTables;
 use Illuminate\Support\Facades\Validator;
 use PhpOffice\PhpSpreadsheet\IOFactory;
 use Barryvdh\DomPDF\Facade\Pdf;
 
 class SupplierController extends Controller
 {
     public function index()
     {
         $breadcrumb = (object) [
             'title' => 'Daftar Supplier',
             'list' => ['Home', 'Supplier']
         ];
 
         $page = (object) [
             'title' => 'Daftar supplier yang terdaftar dalam sistem'
         ];
 
         $activeMenu = 'supplier';
         $supplier = SupplierModel::all(); // Ambil semua data supplier untuk dropdown
 
         return view('supplier.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'supplier' => $supplier, 'activeMenu' => $activeMenu]);
     }
 
     public function list(Request $request)
     {
         $suppliers = SupplierModel::select('supplier_id', 'supplier_kode', 'supplier_nama', 'supplier_alamat','sektor');
 
         // Filter berdasarkan supplier_kode
         if ($request->supplier_kode) {
             $suppliers->where('supplier_kode', $request->supplier_kode);
         }
 
         return DataTables::of($suppliers)
             ->addIndexColumn()
             ->addColumn('aksi', function ($supplier) {
                //  $btn = '<a href="' . url('/supplier/' . $supplier->supplier_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                //  $btn .= '<a href="' . url('/supplier/' . $supplier->supplier_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                //  $btn .= '<form class="d-inline-block" method="POST" action="' . url('/supplier/' . $supplier->supplier_id) . '">' .
                //      csrf_field() . method_field('DELETE') .
                //      '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                $btn = '<button onclick="modalAction(\'' . url('/supplier/' . $supplier->supplier_id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/supplier/' . $supplier->supplier_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/supplier/' . $supplier->supplier_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button>';
                 return $btn;
             })
             ->rawColumns(['aksi'])
             ->make(true);
     }
 
     public function create()
     {
         $breadcrumb = (object) [
             'title' => 'Tambah Supplier',
             'list' => ['Home', 'Supplier', 'Tambah']
         ];
 
         $page = (object) [
             'title' => 'Tambah supplier baru'
         ];
 
         $activeMenu = 'supplier';
 
         return view('supplier.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
     }
 
     public function store(Request $request)
     {
         $request->validate([
             'supplier_kode' => 'required|string|max:10|unique:m_supplier,supplier_kode',
             'supplier_nama' => 'required|string|max:100',
             'supplier_alamat' => 'required|string|max:255',
             'sektor' => 'required|string|max:100',
         ]);
 
         SupplierModel::create([
             'supplier_kode' => $request->supplier_kode,
             'supplier_nama' => $request->supplier_nama,
             'supplier_alamat' => $request->supplier_alamat,
             'sektor' => $request->sektor,
         ]);
 
         return redirect('/supplier')->with('success', 'Data supplier berhasil disimpan');
     }
 
     public function show(string $id)
     {
         $supplier = SupplierModel::find($id);
 
         $breadcrumb = (object) [
             'title' => 'Detail Supplier',
             'list' => ['Home', 'Supplier', 'Detail']
         ];
 
         $page = (object) [
             'title' => 'Detail supplier'
         ];
 
         $activeMenu = 'supplier';
 
         return view('supplier.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'supplier' => $supplier, 'activeMenu' => $activeMenu]);
     }
 
     public function edit(string $id)
     {
         $supplier = SupplierModel::find($id);
 
         $breadcrumb = (object) [
             'title' => 'Edit Supplier',
             'list' => ['Home', 'Supplier', 'Edit']
         ];
 
         $page = (object) [
             'title' => 'Edit supplier'
         ];
 
         $activeMenu = 'supplier';
 
         return view('supplier.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'supplier' => $supplier, 'activeMenu' => $activeMenu]);
     }
 
     public function update(Request $request, string $id)
     {
         $request->validate([
             'supplier_kode' => 'required|string|max:10|unique:m_supplier,supplier_kode,' . $id . ',supplier_id',
             'supplier_nama' => 'required|string|max:100',
             'supplier_alamat' => 'required|string|max:255',
         ]);
 
         SupplierModel::find($id)->update([
             'supplier_kode' => $request->supplier_kode,
             'supplier_nama' => $request->supplier_nama,
             'supplier_alamat' => $request->supplier_alamat,
         ]);
 
         return redirect('/supplier')->with('success', 'Data supplier berhasil dirubah');
     }
 
     public function destroy(string $id)
     {
         $check = SupplierModel::find($id);
         if (!$check) {
             return redirect('/supplier')->with('error', 'Data supplier tidak ditemukan');
         }
 
         try {
             SupplierModel::destroy($id);
             return redirect('/supplier')->with('success', 'Data supplier berhasil dihapus');
         } catch (\Illuminate\Database\QueryException $e) {
             return redirect('/supplier')->with('error', 'Data supplier gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
         }
     }

     // tugas jb 6
     public function create_ajax()
     {
         return view('supplier.create_ajax');
     }
 
     public function store_ajax(Request $request)
     {
         // Mengecek apakah request berupa ajax
         if ($request->ajax() || $request->wantsJson()) {
             $rules = [
                 'supplier_kode' => 'required|string|min:4|max:10|unique:m_supplier,supplier_kode',
                 'supplier_nama' => 'required|string|max:100',
                 'supplier_alamat' => 'required|string',
                 'sektor' => 'required|string|max:100',
             ];
 
             // use Illuminate\Support\Facades\Validator;
             $validator = Validator::make($request->all(), $rules);
 
             if ($validator->fails()) {
                 return response()->json([
                     'status' => false, // response status, false: error/gagal, true: berhasil
                     'message' => 'Validasi Gagal',
                     'msgField' => $validator->errors() // Validasi pesan error 
                 ]);
             }
 
             SupplierModel::create($request->all());
 
             return response()->json([
                 'status' => true,
                 'message' => 'Data supplier berhasil disimpan'
             ]);
         }
         return redirect('/');
     }
 
     public function show_ajax(string $id)
     {
         $supplier = SupplierModel::find($id);
 
         return view('supplier.show_ajax', ['supplier' => $supplier]);
     }
 
     public function edit_ajax(string $id)
     {
         $supplier = SupplierModel::find($id);
 
         return view('supplier.edit_ajax', ['supplier' => $supplier]);
     }
 
     public function update_ajax(Request $request, $id)
     {
         // Mengecek apakah request berasal dari ajax
         if ($request->ajax() || $request->wantsJson()) {
             $rules = [
                 'supplier_kode' => 'required|string|min:4|max:10|unique:m_supplier,supplier_kode,' . $id . ',supplier_id',
                 'supplier_nama' => 'required|string|max:100',
                 'supplier_alamat' => 'required|string',
                 'sektor' => 'required|string|max:100',
            ];
 
             // use Illuminate\Support\Facades\Validator;
             $validator = Validator::make($request->all(), $rules);
 
             if ($validator->fails()) {
                 return response()->json([
                     'status' => false, 
                     'message' => 'Validasi gagal. Periksa kembali data yang diinput.',
                     'msgField' => $validator->errors() // Menampilkan error pada field yang salah
                 ]);
             }
 
             try {
                 $supplier = SupplierModel::findOrFail($id); // Memastikan data ditemukan
                 $supplier->update($request->all());
 
                 return response()->json([
                     'status' => true,
                     'message' => 'Data berhasil diperbarui'
                 ]);
             } catch (\Illuminate\Database\QueryException $e) {
                 return response()->json([
                     'status' => false,
                     'message' => 'Terjadi kesalahan saat memperbarui data. Silakan coba lagi.',
                     'error' => $e->getMessage() // Tampilkan pesan error 
                 ]);
             }
         }
 
         return redirect('/');
     }
 
 
     public function confirm_ajax(string $id)
     {
         $supplier = SupplierModel::find($id);
 
         return view('supplier.confirm_ajax', ['supplier' => $supplier]);
     }
 
     public function delete_ajax(Request $request, $id)
     {
         // cek apakah request dari ajax
         if ($request->ajax() || $request->wantsJson()) {
             $supplier = SupplierModel::find($id);
             if ($supplier) {
                 try {
                     $supplier->delete();
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

     public function import()
     {
         return view('supplier.import');
     }
 
     public function import_ajax(Request $request)
     {
         if ($request->ajax() || $request->wantsJson()) {
             $rules = [
                 'file_supplier' => ['required', 'mimes:xlsx', 'max:4096'],
             ];
             $validator = Validator::make($request->all(), $rules);
 
             if ($validator->fails()) {
                 return response()->json([
                     'status' => false,
                     'message' => 'Validasi Gagal',
                     'msgField' => $validator->errors(),
                 ]);
             }
 
             $file = $request->file('file_supplier');
             $reader = IOFactory::createReader('Xlsx');
             $reader->setReadDataOnly(true);
             $spreadsheet = $reader->load($file->getRealPath());
             $sheet = $spreadsheet->getActiveSheet();
             $data = $sheet->toArray(null, false, true, true);
             $insert = [];
 
             if (count($data) > 1) {
                 foreach ($data as $baris => $value) {
                     if ($baris > 1) {
                         $insert[] = [
                             'supplier_kode' => $value['A'],
                             'supplier_nama' => $value['B'],
                             'sektor' => $value['C'],
                             'supplier_alamat' => $value['D'],
                             'created_at' => now(),
                         ];
                     }
                 }
 
                 if (count($insert) > 0) {
                     SupplierModel::insertOrIgnore($insert);
                 }
 
                 return response()->json([
                     'status' => true,
                     'message' => 'Data berhasil diimport',
                 ]);
             } else {
                 return response()->json([
                     'status' => false,
                     'message' => 'Tidak ada data yang diimport',
                 ]);
             }
         }
 
         return redirect('/');
     }

     public function export_excel(){
        // ambil data barang yang akan di export
        $barang = SupplierModel::select( 'supplier_kode', 'supplier_nama', 'supplier_alamat','sektor')
                    ->orderBy('supplier_id')
                    ->get();

        // load library excel
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet(); // ambil sheet yang aktif

        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Kode Supplier');
        $sheet->setCellValue('C1', 'Nama Supplier');
        $sheet->setCellValue('D1', 'Sektor');
        $sheet->setCellValue('E1', 'Alamat Supplier');

        $sheet->getStyle('A1:E1')->getFont()->setBold(true); // bold header

        $no = 1; // nomor data dimulai dari 1
        $baris = 2; // baris data dimulai dari baris ke 2
        foreach ($barang as $key => $value) {
            $sheet->setCellValue('A' . $baris, $no);
            $sheet->setCellValue('B' . $baris, $value->supplier_kode);
            $sheet->setCellValue('C' . $baris, $value->supplier_nama);
            $sheet->setCellValue('D' . $baris, $value->sektor);
            $sheet->setCellValue('E' . $baris, $value->supplier_alamat);
            $baris++;
            $no++;
        }

        foreach (range('A', 'E') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true); // set auto size untuk kolom
        }

        $sheet->setTitle('Data Supplier'); // set title sheet

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx'); //Membuat “penulis” file Excel dalam format .xlsx
        $filename = 'Data Supplier_' . date('Y-m-d H:i:s') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); // memberi tahu bahwa ini adalah file excel
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //Memberi tau browser supaya file langsung di-download, bukan dibuka di browser.  
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1'); //Supaya browser tidak menyimpan versi lama dari file ini.
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); //Tanggal kadaluarsa file ini ditetapkan ke masa lalu → artinya file ini harus dianggap baru setiap saat.  
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // memberi tahu bahwa sekarang adaah terakhir modifikasi.
        header('Cache-Control: cache, must-revalidate'); // File ini bisa di-cache, tapi harus diperiksa dulu ke server apakah ada versi terbaru.
        header('Pragma: public'); //Boleh disimpan (public cache) di beberapa kasus, untuk dukung browser lama.

        $writer->save('php://output');
        exit;
        
    }

    public function export_pdf(){
        $barang = SupplierModel::select('supplier_kode', 'supplier_nama','supplier_alamat','sektor')
                    ->orderBy('supplier_id')
                    ->get();
        $pdf = Pdf::loadView('supplier.export_pdf', ['barang' => $barang]);
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOptions(['isRemoteEnabled' => true]);
        $pdf->render();

        return $pdf->stream('Data Supplier_' . date('Y-m-d H:i:s') . '.pdf');
    }
 }