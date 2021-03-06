<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RequestController as RequestApi;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('request.logging')->group(function() {
    Route::post('/fibonacci', [RequestApi::class, 'calculateFibonacci'])
        ->name('fibonacci');
    Route::post('/dns', [RequestApi::class, 'getDnsFields'])
        ->name('dns');
});
