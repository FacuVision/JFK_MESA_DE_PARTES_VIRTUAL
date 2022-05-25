<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\SecretaryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AplicantController;
use App\Http\Controllers\Admin\CollectiveController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\OfficeController;
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


Route::get('/', [HomeController::class,'index'])->name('admin.index');


Route::resource('users', UserController::class)->names('admin.users');
Route::resource('secretaries', SecretaryController::class)->names('admin.secretaries');
Route::resource('aplicants', AplicantController::class)->names('admin.aplicants');
Route::resource('typedocuments',TypeDocumentController::class)->names('admin.typedocuments');
Route::resource('offices', OfficeController::class)->names('admin.offices');
Route::resource('typeprocedings',TypeProcedingController::class)->names('admin.typeprocedings');
//Route::resource('districts', DistrictController::class)->names('admin.districts');
Route::resource('procedings', ProcedingController::class)->names('secretary.procedings');


//rechazar expediente
Route::get('procedings/{proceding}/reject', [CollectiveController::class,'reject'])->name('secretary.procedings.reject');

//arpobar expediente
Route::get('procedings/{proceding}/dont_reject', [CollectiveController::class,'dont_reject'])->name('secretary.procedings.dont_reject');

//subsanar expediente
Route::put('procedings/{proceding}', [CollectiveController::class,'subsanar_expediente'])->name('secretary.procedings.subsanar_expediente');

