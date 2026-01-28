<?php

use App\Http\Controllers\Api\NetworkController;
use App\Http\Controllers\Api\DeviceController;
use Illuminate\Support\Facades\Route;

// Networks API
Route::get('/networks', [NetworkController::class, 'index']);
Route::get('/networks/{id}', [NetworkController::class, 'show']);
Route::post('/networks', [NetworkController::class, 'store']);
Route::put('/networks/{id}', [NetworkController::class, 'update']);
Route::delete('/networks/{id}', [NetworkController::class, 'destroy']);

// Devices API
Route::get('/devices', [DeviceController::class, 'index']);
Route::get('/devices/{id}', [DeviceController::class, 'show']);
Route::post('/devices', [DeviceController::class, 'store']);
Route::put('/devices/{id}', [DeviceController::class, 'update']);
Route::delete('/devices/{id}', [DeviceController::class, 'destroy']);
