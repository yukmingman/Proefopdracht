<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PassportAuthController;
use App\Http\Controllers\Api\SubjecItemController;

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

Route::post('register', [PassportAuthController::class, 'register']);
Route::post('login', [PassportAuthController::class, 'login']);


Route::middleware('auth:api')->group(function () {
    Route::get('get-user', [PassportAuthController::class, 'userInfo']);
    Route::post('addgrade', [SubjecItemController::class, 'addGrade']);
    Route::post('deletegrade', [SubjecItemController::class, 'deleteGrade']);
    Route::post('modifygrade', [SubjecItemController::class, 'modifyGrade']);
    Route::get('grades', [SubjecItemController::class, 'index']);
});
