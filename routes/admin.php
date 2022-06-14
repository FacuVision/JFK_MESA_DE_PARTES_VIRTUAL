<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\SecretaryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AplicantController;
use App\Http\Controllers\Admin\CollectiveController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\OfficeController;
use App\Http\Controllers\Admin\ProcedingArchivateController;
use App\Http\Controllers\Admin\ProcedingController;
use App\Http\Controllers\Admin\AdmTracingProcedingController;
use App\Http\Controllers\Admin\TypeDocumentController;
use App\Http\Controllers\Admin\TypeProcedingController;
use App\Http\Controllers\Aplicant\TracingProcedingController;
use Illuminate\Support\Facades\Route;

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
//Route::get('/', [HomeController::class,'index'])->middleware('can:admin.index')->name('admin.index');
//Route::resource('users', UserController::class)->names('admin.users');
//Route::resource('districts', DistrictController::class)->names('admin.districts');




//NUNCA PONER MIDDLEWARES EN LAS BENDITAS RUTAS

Route::get('/', [HomeController::class,'index'])->name('admin.index');

//administracion de usuarios (admin)
Route::resource('users', UserController::class)->names('admin.users');
//administracion de secretarios (admin)
Route::resource('secretaries', SecretaryController::class)->names('admin.secretaries');
//administracion de solicitantes (admin)
Route::resource('aplicants', AplicantController::class)->names('admin.aplicants');
//administracion de tipos de documentos (admin)
Route::resource('typedocuments',TypeDocumentController::class)->names('admin.typedocuments');
//administracion de oficinas (admin)
Route::resource('offices', OfficeController::class)->names('admin.offices');
//administracion de tipos de procedimientos (admin)
Route::resource('typeprocedings',TypeProcedingController::class)->names('admin.typeprocedings');
//administracion de procedimientos (secretario)
Route::resource('procedings', ProcedingController::class)->names('secretaries.procedings');
//administracion de procedimientos archivados (secretario)
Route::resource('archivateprocedings', ProcedingArchivateController::class)->names('secretaries.archivate.procedings');
//seguimiento de expedientes del secretario
Route::resource('tracing', AdmTracingProcedingController::class)->names('secretaries.tracing');

//rechazar expediente (secretario)
Route::get('procedings/{proceding}/reject', [CollectiveController::class,'reject'])->name('secretaries.procedings.reject');

//arpobar expediente (secretario)
Route::get('procedings/{proceding}/dont_reject', [CollectiveController::class,'dont_reject'])->name('secretaries.procedings.dont_reject');

//subsanar expediente (secretario)
Route::put('procedings_sub/{sub_proceding}', [CollectiveController::class,'subsanar_expediente'])->name('secretaries.procedings.subsanar_expediente');

//graficos
Route::get('procedings/proceding/graficos', [CollectiveController::class, 'graficos'])->name('admin.procedings.graficos');
