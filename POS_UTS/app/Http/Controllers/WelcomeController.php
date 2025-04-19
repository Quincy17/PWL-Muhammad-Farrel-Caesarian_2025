<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\PenjualanModel;
use App\Models\PenjualanDetailModel;
use App\Models\StokModel;
use App\Models\SupplierModel;
use App\Models\UserModel;
use App\Models\LevelModel;
use App\Models\KategoriModel;
use Illuminate\Support\Facades\Auth;
class WelcomeController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Selamat Datang ' . Auth::user()->username . '!',
            'list' => ['Home', 'Welcome']
        ];

        $activeMenu = 'dashboard';

        $totalBarang = BarangModel::count();
        $totalPenjualan = PenjualanModel::count();
        $totalPenjualanDetail = PenjualanDetailModel::count();
        $totalStok = StokModel::count();
        $totalKategori = KategoriModel::count();
        $totalSupplier = SupplierModel::count();
        $totalUser = UserModel::count();
        $totalLevel = LevelModel::count();

        return view(
            'welcome', 
            ['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu],
            compact(
                'totalBarang', 
                'totalPenjualan', 
                'totalPenjualanDetail', 
                'totalStok', 
                'totalKategori', 
                'totalSupplier', 
                'totalUser', 
                'totalLevel'
                )
        );
    }
}