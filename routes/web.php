<?php

use App\Http\Controllers\nasabahcontroller;
use App\Http\Controllers\peminjamancontroller;
use Illuminate\Support\Facades\Route;

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

// Crud Nasabah
$nasabah = nasabahcontroller::class;

Route::get("/nasabah",[$nasabah,"list_nasabah"]);
Route::get("/nasabah/tambah",[$nasabah,"form_tambah"]);
Route::post("/nasabah/tambah",[$nasabah,"tambah_nasabah"]);
Route::get("/nasabah/edit",[$nasabah,"form_edit"]);
Route::post("/nasabah/edit",[$nasabah,"edit_nasabah"]);
Route::get("/nasabah/hapus",[$nasabah,"hapus_nasabah"]);
Route::post("/nasabah/search",[$nasabah,"search"]);

//Crud Peminjaman
$pinjam = peminjamancontroller::class;

Route::get("/peminjaman",[$pinjam,"list_peminjam"]);
Route::get("/peminjaman/tambah",[$pinjam,"form_tambah"]);
Route::post("/peminjaman/tambah",[$pinjam,"tambah_pinjam"]);
Route::get("/peminjaman/pengembalian",[$pinjam,"pengembalian"]);
Route::get("/pengembalian",[$pinjam,"list_kembali"]);
