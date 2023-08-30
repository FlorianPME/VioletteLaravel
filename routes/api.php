<?php

use App\Http\Controllers\Api\CivilityController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\api\OrganisationController;
use App\Http\Controllers\api\PersonController;
use App\Http\Controllers\Api\SectorController;
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
Route::apiResource('people', PersonController::class);

Route::get('allmen', [PersonController::class, 'displayAllMen']);

Route::apiResource('organisations', OrganisationController::class);
Route::apiResource('sectors', SectorController::class);
Route::apiResource('locations', LocationController::class);
Route::apiResource('civilities', CivilityController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
