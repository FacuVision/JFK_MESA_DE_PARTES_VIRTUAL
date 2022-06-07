<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Aplicant\ProcedingController;


Route::resource('procedings', ProcedingController::class)->names('aplicants.procedings');

