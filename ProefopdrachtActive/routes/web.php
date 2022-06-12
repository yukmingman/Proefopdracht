<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubjectItemController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/",[SubjectItemController::class,"index"]);

Route::post('/addGrade',[SubjectItemController::class,'saveItem'])->name('addGrade');

Route::post('/deleteGrade/{id}',[SubjectItemController::class,'deleteItem'])->name('deleteGrade');

Route::post('/modifyGrade/{id}',[SubjectItemController::class,'modifyItem'])->name('modifyGrade');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
