<?php

use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\SalesDetailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;

Route::pattern('id','[0-9]+');

Route::get('/home', [HomeController::class, 'index']);

//Registrasi
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/home', [AuthController::class, 'home'])->name('home');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'postlogin']);
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::middleware(['auth'])->group(function () { 

    Route::get('/', [WelcomeController::class, 'index']);

    //Semua bisa ke halaman dashboard
    Route::middleware(['authorize:ADM,MNG,STF,KSR,CUS'])->group(function () {
        Route::get('/dashboard', [WelcomeController::class, 'index']);
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');   
        Route::get('/profile/edit', [ProfileController::class, 'editProfile'])->name('profile.edit');
        Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
    });


    //Hanya Admin yang bisa melihat Data Level
    Route::middleware(['authorize:ADM'])->group(function () {
        Route::get('/dashboard', [WelcomeController::class, 'dashboard']);
        
        Route::group(['prefix' => 'level'], function () {
            Route::get('/', [LevelController::class, 'index']); 
            Route::get('/{id}/show_ajax', [LevelController::class, 'show_ajax']);           
            Route::get('/create_ajax', [LevelController::class, 'create_ajax']); // menampilkan halaman form tambah user Ajax
            Route::post('/ajax', [LevelController::class, 'store_ajax']); // menyimpan data user baru Ajax
            Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']); // menampilkan halaman form edit user Ajax
            Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']); // menyimpan perubahan data user Ajax
            Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']); // menampilkan halaman form Delete user Ajax
            Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']); // menghapus data user Ajax
            Route::get('/import', [LevelController::class, 'import']); // menampilkan halaman form tambah user Ajax
            Route::post('/import_ajax', [LevelController::class, 'import_ajax']); // menyimpan data user baru Ajax
            Route::get('/export_excel', [LevelController::class, 'export_excel']);
            Route::get('/export_pdf', [LevelController::class, 'export_pdf']);
            Route::post('/list', [LevelController::class, 'list']);        
            Route::get('/create', [LevelController::class, 'create']);    
            Route::post('/', [LevelController::class, 'store']);          
            Route::get('/{id}', [LevelController::class, 'show']);       
            Route::get('/{id}/edit', [LevelController::class, 'edit']);  
            Route::put("/{id}", [LevelController::class, 'update']);       
            Route::delete('/{id}', [LevelController::class, 'destroy']);
        });
        
    });

    //Admin, Manager, Staff dan Kasir dapat melihat Data Barang
     Route::middleware(['authorize:ADM,MNG,STF,KSR,CUS'])->group(function () {
        Route::group(['prefix' => 'barang'], function () {
            Route::get('/dashboard', [WelcomeController::class, 'dashboard']);
            Route::get('/', [BarangController::class, 'index']);
            Route::get('/create_ajax', [BarangController::class, 'create_ajax']); // menampilkan halaman form tambah user Ajax
            Route::get('/{id}/show_ajax', [BarangController::class, 'show_ajax']); // menampilkan halaman form tambah user Ajax
            Route::post('/ajax', [BarangController::class, 'store_ajax']); // menyimpan data user baru Ajax
            Route::get('/{id}/edit_ajax', [BarangController::class, 'edit_ajax']); // menampilkan halaman form edit user Ajax
            Route::get('/import', [BarangController::class, 'import']); // menampilkan halaman form tambah user Ajax
            Route::get('/export_excel', [BarangController::class, 'export_excel']); // menampilkan halaman form tambah user Ajax
            Route::post('/import_ajax', [BarangController::class, 'import_ajax']); // menyimpan data user baru Ajax
            Route::get('/{id}/edit_ajax', [BarangController::class, 'edit_ajax']); // menampilkan halaman form edit user Ajax
            Route::put('/{id}/update_ajax', [BarangController::class, 'update_ajax']); // menyimpan perubahan data user Ajax
            Route::get('/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']); // menampilkan halaman form Delete user Ajax
            Route::delete('/{id}/delete_ajax', [BarangController::class, 'delete_ajax']); // menghapus data user Ajax
            Route::post('/list', [BarangController::class, 'list']);
            Route::get('/export_pdf', [BarangController::class, 'export_pdf']);
            Route::get('/create', [BarangController::class, 'create']);
            Route::post('/', [BarangController::class, 'store']);
            Route::get('/{id}', [BarangController::class, 'show']);
            Route::get('/{id}/edit', [BarangController::class, 'edit']);
            Route::put("/{id}", [BarangController::class, 'update']);
            Route::delete('/{id}', [BarangController::class, 'destroy']);
        });
    }); 

    //Admin dan Manager dapat melihat Data User
    Route::middleware(['authorize:ADM,MNG'])->group(function () {
    Route::group(['prefix' => 'user'], function () {
        Route::get('/', [UserController::class, 'index']); // menampilkan halaman awal user
        Route::get('/export_pdf', [UserController::class, 'export_pdf']);
        Route::get('/{id}/show_ajax', [UserController::class, 'show_ajax']);
        Route::get('/create_ajax', [UserController::class, 'create_ajax']); // menampilkan halaman form tambah user Ajax
        Route::post('/ajax', [UserController::class, 'store_ajax']); // menyimpan data user baru Ajax
        Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']); // menampilkan halaman form edit user Ajax
        Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']); // menyimpan perubahan data user Ajax
        Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']); // menampilkan halaman form Delete user Ajax
        Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']); // menghapus data user Ajax
        Route::get('/import', [UserController::class, 'import']); // menampilkan halaman form tambah user Ajax
        Route::post('/import_ajax', [UserController::class, 'import_ajax']); // menyimpan data user baru Ajax
        Route::get('/export_excel', [UserController::class, 'export_excel']);
        Route::post('/list', [UserController::class, 'list']); // menampilkan data user dalam bentuk json untuk datatables
        Route::get('/create', [UserController::class, 'create']); // menampilkan halaman form tambah user
        Route::post('/', [UserController::class, 'store']); // menyimpan data user baru
        Route::get('/{id}', [UserController::class, 'show']); // menampilkan detail user
        Route::get('/{id}/edit', [UserController::class, 'edit']); // menampilkan halaman form edit user
        Route::put('/{id}', [UserController::class, 'update']); // menyimpan perubahan data user
        Route::delete('/{id}', [UserController::class, 'destroy']); // menghapus data user
    });
    }); 
    
    //Admin, Manager, Staff dan Kasir dapat melihat Data Kategori
    Route::middleware(['authorize:ADM,MNG,STF,KSR'])->group(function () {
    Route::group(['prefix' => 'kategori'], function () {
        Route::get('/', [KategoriController::class, 'index']);
        Route::get('/export_pdf', [KategoriController::class, 'export_pdf']);
        Route::get('/{id}/show_ajax', [KategoriController::class, 'show_ajax']);
        Route::get('/create_ajax', [KategoriController::class, 'create_ajax']); // menampilkan halaman form tambah user Ajax
        Route::post('/ajax', [KategoriController::class, 'store_ajax']); // menyimpan data user baru Ajax
        Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']); // menampilkan halaman form edit user Ajax
        Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax']); // menyimpan perubahan data user Ajax
        Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']); // menampilkan halaman form Delete user Ajax
        Route::get('/import', [KategoriController::class, 'import']); // menampilkan halaman form tambah user Ajax
        Route::post('/import_ajax', [KategoriController::class, 'import_ajax']); // menyimpan data user baru Ajax
        Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']); // menghapus data user Ajax
        Route::get('/export_excel', [KategoriController::class, 'export_excel']);
        Route::post('/list', [KategoriController::class, 'list']);
        Route::get('/create', [KategoriController::class, 'create']);
        Route::post('/', [KategoriController::class, 'store']);
        Route::get('/{id}', [KategoriController::class, 'show']);
        Route::get('/{id}/edit', [KategoriController::class, 'edit']);
        Route::put("/{id}", [KategoriController::class, 'update']);
        Route::delete('/{id}', [KategoriController::class, 'destroy']);
    });
    }); 

    //Admin, Manager dan Staff dapat melihat Data Supplier  
    Route::middleware(['authorize:ADM,MNG,STF'])->group(function () {
    Route::group(['prefix' => 'supplier'], function () {
        Route::get('/', [SupplierController::class, 'index']);
        Route::get('/export_pdf', [SupplierController::class, 'export_pdf']);
        Route::get('/{id}/show_ajax', [SupplierController::class, 'show_ajax']);
        Route::get('/create_ajax', [SupplierController::class, 'create_ajax']); // menampilkan halaman form tambah user Ajax
        Route::post('/ajax', [SupplierController::class, 'store_ajax']); // menyimpan data user baru Ajax
        Route::get('/{id}/edit_ajax', [SupplierController::class, 'edit_ajax']); // menampilkan halaman form edit user Ajax
        Route::put('/{id}/update_ajax', [SupplierController::class, 'update_ajax']); // menyimpan perubahan data user Ajax
        Route::get('/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax']); // menampilkan halaman form Delete user Ajax
        Route::get('/import', [SupplierController::class, 'import']); // menampilkan halaman form tambah user Ajax
        Route::post('/import_ajax', [SupplierController::class, 'import_ajax']); // menyimpan data user baru Ajax
        Route::get('/export_excel', [SupplierController::class, 'export_excel']);
        Route::delete('/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']); // menghapus data user Ajax
        Route::post('/list', [SupplierController::class, 'list']);
        Route::get('/create', [SupplierController::class, 'create']);
        Route::post('/', [SupplierController::class, 'store']);
        Route::get('/{id}', [SupplierController::class, 'show']);
        Route::get('/{id}/edit', [SupplierController::class, 'edit']);
        Route::put("/{id}", [SupplierController::class, 'update']);
        Route::delete('/{id}', [SupplierController::class, 'destroy']);
    });
     }); 

     Route::middleware(['authorize:ADM,MNG,STF'])->group(function () {
     Route::group(['prefix' => 'stok'], function () {
         Route::get('/', [StokController::class, 'index']);
         Route::get('/export_pdf', [StokController::class, 'export_pdf']);
         Route::get('/{id}/show_ajax', [StokController::class, 'show_ajax']);
         Route::get('/create_ajax', [StokController::class, 'create_ajax']); // menampilkan halaman form tambah user Ajax
         Route::post('/ajax', [StokController::class, 'store_ajax']); // menyimpan data user baru Ajax
         Route::get('/{id}/edit_ajax', [StokController::class, 'edit_ajax']); // menampilkan halaman form edit user Ajax
         Route::put('/{id}/update_ajax', [StokController::class, 'update_ajax']); // menyimpan perubahan data user Ajax
         Route::get('/{id}/delete_ajax', [StokController::class, 'confirm_ajax']); // menampilkan halaman form Delete user Ajax
         Route::get('/import', [StokController::class, 'import']); // menampilkan halaman form tambah user Ajax
         Route::get('/export_excel', [StokController::class, 'export_excel']); // menampilkan halaman form tambah user Ajax
         Route::post('/import_ajax', [StokController::class, 'import_ajax']); // menyimpan data user baru Ajax
         Route::delete('/{id}/delete_ajax', [StokController::class, 'delete_ajax']); // menghapus data user Ajax
         Route::post('/list', [StokController::class, 'list']);
         Route::get('/create', [StokController::class, 'create']);
         Route::post('/', [StokController::class, 'store']);
         Route::get('/{id}', [StokController::class, 'show']);
         Route::get('/{id}/edit', [StokController::class, 'edit']);
         Route::put("/{id}", [StokController::class, 'update']);
         Route::delete('/{id}', [StokController::class, 'destroy']);
     });
    }); 

    Route::middleware(['authorize:ADM,MNG,STF,CUS,KSR'])->group(function () {
     Route::group(['prefix' => 'penjualan'], function () {
         Route::get('/', [SalesController::class, 'index']);
         Route::get('/export_pdf', [SalesController::class, 'export_pdf']);
         Route::get('/{id}/show_ajax', [SalesController::class, 'show_ajax']);
         Route::get('/create_ajax', [SalesController::class, 'create_ajax']); // menampilkan halaman form tambah user Ajax
         Route::post('/ajax', [SalesController::class, 'store_ajax']); // menyimpan data user baru Ajax
         Route::get('/{id}/edit_ajax', [SalesController::class, 'edit_ajax']); // menampilkan halaman form edit user Ajax
         Route::put('/{id}/update_ajax', [SalesController::class, 'update_ajax']); // menyimpan perubahan data user Ajax
         Route::get('/{id}/delete_ajax', [SalesController::class, 'confirm_ajax']); // menampilkan halaman form Delete user Ajax
         Route::get('/import', [SalesController::class, 'import']); // menampilkan halaman form tambah user Ajax
        Route::post('/import_ajax', [SalesController::class, 'import_ajax']); // menyimpan data user baru Ajax
        Route::get('/export_excel', [SalesController::class, 'export_excel']); 
        Route::delete('/{id}/delete_ajax', [SalesController::class, 'delete_ajax']); // menghapus data user Ajax
         Route::post('/list', [SalesController::class, 'list']);
         Route::get('/create', [SalesController::class, 'create']);
         Route::post('/', [SalesController::class, 'store']);
         Route::get('/{id}', [SalesController::class, 'show']);
         Route::get('/{id}/edit', [SalesController::class, 'edit']);
         Route::put("/{id}", [SalesController::class, 'update']);
         Route::delete('/{id}', [SalesController::class, 'destroy']);
     });
     });

     Route::middleware(['authorize:ADM,MNG,STF,CUS,KSR'])->group(function () {
     Route::group(['prefix' => 'penjualan_detail'], function () {
         Route::get('/', [SalesDetailController::class, 'index']);
         Route::get('/export_pdf', [SalesDetailController::class, 'export_pdf']);
         Route::get('/{id}/show_ajax', [SalesDetailController::class, 'show_ajax']);
         Route::get('/create_ajax', [SalesDetailController::class, 'create_ajax']); // menampilkan halaman form tambah user Ajax
         Route::post('/ajax', [SalesDetailController::class, 'store_ajax']); // menyimpan data user baru Ajax
         Route::get('/{id}/edit_ajax', [SalesDetailController::class, 'edit_ajax']); // menampilkan halaman form edit user Ajax
         Route::put('/{id}/update_ajax', [SalesDetailController::class, 'update_ajax']); // menyimpan perubahan data user Ajax
         Route::get('/{id}/delete_ajax', [SalesDetailController::class, 'confirm_ajax']); // menampilkan halaman form Delete user Ajax
         Route::get('/export_excel', [SalesDetailController::class, 'export_excel']);
         Route::get('/import', [SalesDetailController::class, 'import']); // menampilkan halaman form tambah user Ajax
        Route::post('/import_ajax', [SalesDetailController::class, 'import_ajax']); // menyimpan data user baru Ajax
         Route::delete('/{id}/delete_ajax', [SalesDetailController::class, 'delete_ajax']); // menghapus data user Ajax
         Route::post('/list', [SalesDetailController::class, 'list']);
         Route::get('/create', [SalesDetailController::class, 'create']);
         Route::post('/', [SalesDetailController::class, 'store']);
         Route::get('/{id}', [SalesDetailController::class, 'show']);
         Route::get('/{id}/edit', [SalesDetailController::class, 'edit']);
         Route::put("/{id}", [SalesDetailController::class, 'update']);
         Route::delete('/{id}', [SalesDetailController::class, 'destroy']);
     });
    });
});     

