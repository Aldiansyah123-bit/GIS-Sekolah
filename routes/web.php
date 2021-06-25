<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\JenjangController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [WebController::class, 'index']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [HomeController::class, 'index']);

//Kecamatan
Route::middleware(['auth:sanctum', 'verified'])->get('/kecamatan', [KecamatanController::class, 'index']);
Route::middleware(['auth:sanctum', 'verified'])->get('/kecamatan/add', [KecamatanController::class, 'add']);
Route::middleware(['auth:sanctum', 'verified'])->post('/kecamatan/insert', [KecamatanController::class, 'insert']);
Route::middleware(['auth:sanctum', 'verified'])->get('/kecamatan/edit/{id}', [KecamatanController::class, 'edit']);
Route::middleware(['auth:sanctum', 'verified'])->post('/kecamatan/update/{id}', [KecamatanController::class, 'update']);
Route::middleware(['auth:sanctum', 'verified'])->get('/kecamatan/delete/{id}', [KecamatanController::class, 'delete']);

//Jenjang
Route::middleware(['auth:sanctum', 'verified'])->get('/jenjang', [JenjangController::class, 'index']);
Route::middleware(['auth:sanctum', 'verified'])->get('/jenjang/add', [JenjangController::class, 'add']);
Route::middleware(['auth:sanctum', 'verified'])->post('/jenjang/insert', [JenjangController::class, 'insert']);
Route::middleware(['auth:sanctum', 'verified'])->get('/jenjang/edit/{id}', [JenjangController::class, 'edit']);
Route::middleware(['auth:sanctum', 'verified'])->post('/jenjang/update/{id}', [JenjangController::class, 'update']);
Route::middleware(['auth:sanctum', 'verified'])->get('/jenjang/delete/{id}', [JenjangController::class, 'delete']);

//Sekolah
Route::middleware(['auth:sanctum', 'verified'])->get('/sekolah', [SekolahController::class, 'index']);
Route::middleware(['auth:sanctum', 'verified'])->get('/sekolah/add', [SekolahController::class, 'add']);
Route::middleware(['auth:sanctum', 'verified'])->post('/sekolah/insert', [SekolahController::class, 'insert']);
Route::middleware(['auth:sanctum', 'verified'])->get('/sekolah/edit/{id_sekolah}', [SekolahController::class, 'edit']);
Route::middleware(['auth:sanctum', 'verified'])->post('/sekolah/update/{id_sekolah}', [SekolahController::class, 'update']);
Route::middleware(['auth:sanctum', 'verified'])->get('/sekolah/delete/{id_sekolah}', [SekolahController::class, 'delete']);

//user
Route::middleware(['auth:sanctum', 'verified'])->get('/user', [UserController::class, 'index']);
Route::middleware(['auth:sanctum', 'verified'])->get('/user/add', [UserController::class, 'add']);
Route::middleware(['auth:sanctum', 'verified'])->post('/user/insert', [UserController::class, 'insert']);
Route::middleware(['auth:sanctum', 'verified'])->get('/user/edit/{id}', [UserController::class, 'edit']);
Route::middleware(['auth:sanctum', 'verified'])->post('/user/update/{id}', [UserController::class, 'update']);
Route::middleware(['auth:sanctum', 'verified'])->get('/user/delete/{id}', [UserController::class, 'delete']);

//Frond End
Route::get('/kecamatan/{id}', [WebController::class, 'kecamatan']);
Route::get('/jenjang/{id}', [WebController::class, 'jenjang']);
Route::get('/detailsekolah/{id}', [WebController::class, 'detailsekolah']);


