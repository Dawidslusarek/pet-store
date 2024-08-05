<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;

Route::apiResource('pets', PetController::class);
