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
use App\Http\Controllers\Admin\TypeDocumentController;
use App\Http\Controllers\Admin\TypeProcedingController;
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

Route::get('/', [HomeController::class,'index'])->name('admin.index');


Route::resource('users', UserController::class)->names('admin.users');
Route::resource('secretaries', SecretaryController::class)->names('admin.secretaries');
Route::resource('aplicants', AplicantController::class)->names('admin.aplicants');
Route::resource('typedocuments',TypeDocumentController::class)->names('admin.typedocuments');
Route::resource('offices', OfficeController::class)->names('admin.offices');
Route::resource('typeprocedings',TypeProcedingController::class)->names('admin.typeprocedings');
Route::resource('procedings', ProcedingController::class)->names('secretaries.procedings');

Route::resource('archivateprocedings', ProcedingArchivateController::class)->names('secretaries.archivate.procedings');


//rechazar expediente
Route::get('procedings/{proceding}/reject', [CollectiveController::class,'reject'])->name('secretaries.procedings.reject');

//arpobar expediente
Route::get('procedings/{proceding}/dont_reject', [CollectiveController::class,'dont_reject'])->name('secretaries.procedings.dont_reject');

//subsanar expediente
Route::put('procedings_sub/{sub_proceding}', [CollectiveController::class,'subsanar_expediente'])->name('secretaries.procedings.subsanar_expediente');

