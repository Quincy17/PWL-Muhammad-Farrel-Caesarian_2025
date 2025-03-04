<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PhotoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Mengambil daftar hello kemudian menampilkan Hello World di halaman web
Route::get('/hello', [WelcomeController::class,'hello']);

//Mengambil daftar world kemudian menampilkan World di halaman web
Route::get('/world', function () {
    return 'World';
});

//Route untuk menampilkan selamat datang
Route::get('/', [HomeController::class,'index']);

//Route untuk menampilkan NIM dan Nama Saya
Route::get('/about', [AboutController::class,'about']);

//Memanggil Route /user/{name} sekaligus mengirimkan parameter berupa nama user$name
Route::get('/user/{name}', function($name){
    return 'Nama Saya '.$name;
});

//Memanggil Route yang mempunyai lebih dari 2 parameter
Route::get('/posts/{post}/comments/{comment}', function($postId, $commentId){
    return 'Pos ke-'.$postId." Komentar ke-: ".$commentId;
});

//Membuat Route articles yang dapat menampilkan halaman artikel dengan id
Route::get('/articles/{id}', [ArticleController::class, 'articles']);

//Membuat Route dengan Optional Parameter
/*Route::get('/user/{name?}', function($name='null'){
    return 'Nama Saya '.$name;
});*/

Route::get('/user/{name?}', function($name='John'){
    return 'Nama Saya '.$name;
});

Route::resource('photos', PhotoController::class)->only([
    'index', 'show'
    ]);

Route::resource('photos', PhotoController::class)->except([
        'create', 'store', 'update', 'destroy'
    ]);

//Route view tanpa mnasuk direktori lagi
/*Route::get('/greeting', function () {
    return view('hello', ['name' => 'Muhammad Farrel Caesarian']);
});*/

//Route view dengan memasukkan direktori
/*Route::get('/greeting', function () {
    return view('blog.hello', ['name' => 'Muhammad Farrel Caesarian']);
});*/

//Route untuk menampilkan view dari Controller
Route::get('/greeting', [WelcomeController::class,'greeting']);