<?php

use App\Http\Controllers\Api\NetworkController;
use App\Http\Controllers\Api\DeviceController;
use Illuminate\Support\Facades\Route;

Route::get('/networks', [NetworkController::class, 'index']);
Route::get('/networks/{id}', [NetworkController::class, 'show']);
Route::post('/networks', [NetworkController::class, 'store']);

Route::get('/devices', [DeviceController::class, 'index']);
Route::get('/devices/{id}', [DeviceController::class, 'show']);
