<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RedirectController;

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

//routes to get redirects/stats/logs
Route::prefix('redirects')->group(function() {
    Route::get('/', [RedirectController::class, 'list']);
    Route::post('/', [RedirectController::class, 'create']);
    Route::put('/{code}', [RedirectController::class, 'update']);
    Route::delete('/{code}', [RedirectController::class, 'delete']);
    Route::patch('/{code}', [RedirectController::class, 'activateInactivate']);
    Route::get('/{code}/stats', [RedirectController::class, 'stats']);
    Route::get('/{code}/logs', [RedirectController::class, 'logs']);
});
