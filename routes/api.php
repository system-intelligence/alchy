<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\alchyController;

Route::get('/alchies/latest', [alchyController::class, 'latest']);