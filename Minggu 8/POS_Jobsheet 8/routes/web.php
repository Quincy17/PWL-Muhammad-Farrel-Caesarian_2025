<?php

use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

Route::pattern('id','[0-9]+');
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
    });


    //Hanya Admin yang bisa melihat Data Level
    Route::middleware(['authorize:ADM'])->group(function () {
        Route::get('/dashboard', [WelcomeController::class, 'dashboard']);
        
        Route::group(['prefix' => 'level'], function () {
            Route::get('/', [LevelController::class, 'index']);            
            Route::get('/create_ajax', [LevelController::class, 'create_ajax']); // menampilkan halaman form tambah user Ajax
            Route::post('/ajax', [LevelController::class, 'store_ajax']); // menyimpan data user baru Ajax
            Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']); // menampilkan halaman form edit user Ajax
            Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']); // menyimpan perubahan data user Ajax
            Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']); // menampilkan halaman form Delete user Ajax
            Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']); // menghapus data user Ajax
            Route::post('/list', [LevelController::class, 'list']);        
            Route::get('/create', [LevelController::class, 'create']);    
            Route::post('/', [LevelController::class, 'store']);          
            Route::get('/{id}', [LevelController::class, 'show']);       
            Route::get('/{id}/edit', [LevelController::class, 'edit']);  
            Route::put("/{id}", [LevelController::class, 'update']);       
            Route::delete('/{id}', [LevelController::class, 'destroy']);
            Route::get('/import', [LevelController::class, 'import']); // ajax form upload excel
            Route::post('/import_ajax', [LevelController::class, 'import_ajax']); // ajax import excel
        });
        
    });

    //Admin, Manager, Staff dan Kasir dapat melihat Data Barang
     Route::middleware(['authorize:ADM,MNG,STF,KSR,CUS'])->group(function () {
        Route::group(['prefix' => 'barang'], function () {
            Route::get('/dashboard', [WelcomeController::class, 'dashboard']);
            Route::get('/', [BarangController::class, 'index']);
            Route::get('/create_ajax', [BarangController::class, 'create_ajax']); // menampilkan halaman form tambah user Ajax
            Route::post('/ajax', [BarangController::class, 'store_ajax']); // menyimpan data user baru Ajax
            Route::get('/{id}/edit_ajax', [BarangController::class, 'edit_ajax']); // menampilkan halaman form edit user Ajax
            Route::put('/{id}/update_ajax', [BarangController::class, 'update_ajax']); // menyimpan perubahan data user Ajax
            Route::get('/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']); // menampilkan halaman form Delete user Ajax
            Route::get('/import', [BarangController::class, 'import']); // ajax form upload excel
            Route::post('/import_ajax', [BarangController::class, 'import_ajax']); // ajax import excel
            Route::delete('/{id}/delete_ajax', [BarangController::class, 'delete_ajax']); // menghapus data user Ajax
            Route::post('/list', [BarangController::class, 'list']);
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
        Route::get('/create_ajax', [UserController::class, 'create_ajax']); // menampilkan halaman form tambah user Ajax
        Route::post('/ajax', [UserController::class, 'store_ajax']); // menyimpan data user baru Ajax
        Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']); // menampilkan halaman form edit user Ajax
        Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']); // menyimpan perubahan data user Ajax
        Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']); // menampilkan halaman form Delete user Ajax
        Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']); // menghapus data user Ajax
        Route::post('/list', [UserController::class, 'list']); // menampilkan data user dalam bentuk json untuk datatables
        Route::get('/create', [UserController::class, 'create']); // menampilkan halaman form tambah user
        Route::post('/', [UserController::class, 'store']); // menyimpan data user baru
        Route::get('/{id}', [UserController::class, 'show']); // menampilkan detail user
        Route::get('/{id}/edit', [UserController::class, 'edit']); // menampilkan halaman form edit user
        Route::put('/{id}', [UserController::class, 'update']); // menyimpan perubahan data user
        Route::delete('/{id}', [UserController::class, 'destroy']); // menghapus data user
        Route::get('/import', [UserController::class, 'import']); // ajax form upload excel
        Route::post('/import_ajax', [UserController::class, 'import_ajax']); // ajax import excel
        
    });
    }); 
    
    //Admin, Manager, Staff dan Kasir dapat melihat Data Kategori
    Route::middleware(['authorize:ADM,MNG,STF,KSR'])->group(function () {
    Route::group(['prefix' => 'kategori'], function () {
        Route::get('/', [KategoriController::class, 'index']);
        Route::get('/create_ajax', [KategoriController::class, 'create_ajax']); // menampilkan halaman form tambah user Ajax
        Route::post('/ajax', [KategoriController::class, 'store_ajax']); // menyimpan data user baru Ajax
        Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']); // menampilkan halaman form edit user Ajax
        Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax']); // menyimpan perubahan data user Ajax
        Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']); // menampilkan halaman form Delete user Ajax
        Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']); // menghapus data user Ajax
        Route::post('/list', [KategoriController::class, 'list']);
        Route::get('/create', [KategoriController::class, 'create']);
        Route::post('/', [KategoriController::class, 'store']);
        Route::get('/{id}', [KategoriController::class, 'show']);
        Route::get('/{id}/edit', [KategoriController::class, 'edit']);
        Route::put("/{id}", [KategoriController::class, 'update']);
        Route::delete('/{id}', [KategoriController::class, 'destroy']);
        Route::get('/import', [KategoriController::class, 'import']); // ajax form upload excel
        Route::post('/import_ajax', [KategoriController::class, 'import_ajax']); // ajax import excel
    });
    }); 

    //Admin, Manager dan Staff dapat melihat Data Supplier  
    Route::middleware(['authorize:ADM,MNG,STF'])->group(function () {
    Route::group(['prefix' => 'supplier'], function () {
        Route::get('/', [SupplierController::class, 'index']);
        Route::get('/create_ajax', [SupplierController::class, 'create_ajax']); // menampilkan halaman form tambah user Ajax
        Route::post('/ajax', [SupplierController::class, 'store_ajax']); // menyimpan data user baru Ajax
        Route::get('/{id}/edit_ajax', [SupplierController::class, 'edit_ajax']); // menampilkan halaman form edit user Ajax
        Route::put('/{id}/update_ajax', [SupplierController::class, 'update_ajax']); // menyimpan perubahan data user Ajax
        Route::get('/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax']); // menampilkan halaman form Delete user Ajax
        Route::delete('/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']); // menghapus data user Ajax
        Route::post('/list', [SupplierController::class, 'list']);
        Route::get('/create', [SupplierController::class, 'create']);
        Route::post('/', [SupplierController::class, 'store']);
        Route::get('/{id}', [SupplierController::class, 'show']);
        Route::get('/{id}/edit', [SupplierController::class, 'edit']);
        Route::put("/{id}", [SupplierController::class, 'update']);
        Route::delete('/{id}', [SupplierController::class, 'destroy']);
        Route::get('/import', [SupplierController::class, 'import']); // ajax form upload excel
        Route::post('/import_ajax', [SupplierController::class, 'import_ajax']); // ajax import excel
    });
     }); 
});
