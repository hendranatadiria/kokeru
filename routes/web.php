<?php

//use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;



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

/*
Route::get('/', function () {
    return view('welcome');
});
<<<<<<< HEAD
*/

//Frontpage
Route::get('/', [FrontendController::class, 'index']);
Route::get('/tugas/{id}', [FrontendController::class, 'lihatTugas']);

//Route::get('/mypost', [CleaningServiceController::class, 'tugasSaya']);
Route::get('/tugas/edit/{id}', [CleaningServiceController::class, 'editTugas']);
Route::post('/tugas/edit/{id}', [CleaningServiceController::class, 'updateTugas']);

=======

Route::get('admin/laporan', [ReportController::class, 'index']);
Route::get('admin/laporan/cetak_pdf', [ReportController::class, 'cetak_pdf']);
>>>>>>> 7d9d2a33c0cbe8d52e394ba1f34dc0a8d2db1aff
