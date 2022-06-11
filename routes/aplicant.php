<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Aplicant\ProcedingController;
use App\Http\Controllers\Aplicant\TracingProcedingController;

//redaccion de expedientes (aplicant)
Route::resource('procedings', ProcedingController::class)->names('aplicants.procedings');

//Seguimiento de trámite (usuario)
Route::resource('tracings', TracingProcedingController::class)->names('aplicants.tracings');


