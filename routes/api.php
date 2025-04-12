<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\PriceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('cars')->group(function () {
    Route::get('/', [CarController::class, 'index']);
    Route::post('/', [CarController::class, 'store']);
    Route::get('/available', [CarController::class, 'availableCarsWithCache']);
    Route::get('/{id}', [CarController::class, 'show']);
    Route::patch('/{id}', [CarController::class, 'update']);
    Route::delete('/{id}', [CarController::class, 'destroy']);
});

Route::prefix('options')->group(function () {
    Route::get('/', [OptionController::class, 'index']);
    Route::post('/', [OptionController::class, 'store']);
    Route::get('/{id}', [OptionController::class, 'show']);
    Route::patch('/{id}', [OptionController::class, 'update']);
    Route::delete('/{id}', [OptionController::class, 'destroy']);
});

Route::prefix('configurations')->group(function () {
    Route::get('/', [ConfigurationController::class, 'index']);
    Route::post('/', [ConfigurationController::class, 'store']);
    Route::get('/{id}', [ConfigurationController::class, 'show']);
    Route::patch('/{id}', [ConfigurationController::class, 'update']);
    Route::delete('/{id}', [ConfigurationController::class, 'destroy']);
    Route::post('/{id}/options/{option_id}', [ConfigurationController::class, 'addOption']);
    Route::delete('/{id}/options/{option_id}', [ConfigurationController::class, 'removeOption']);
    Route::get('/{id}/options', [ConfigurationController::class, 'configurationOptionsList']);

});

Route::prefix('prices')->group(function () {
    Route::get('/', [PriceController::class, 'index']);
    Route::post('/', [PriceController::class, 'store']);
    Route::get('/{id}', [PriceController::class, 'show']);
    Route::patch('/{id}', [PriceController::class, 'update']);
    Route::delete('/{id}', [PriceController::class, 'destroy']);
});
