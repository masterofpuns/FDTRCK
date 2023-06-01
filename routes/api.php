<?php

use App\Http\Controllers;
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

Route::get('languages', Controllers\LanguageController::class)->name('languages');
Route::get('contact', Controllers\ContactItemController::class)->name('contact');
Route::get('about', Controllers\AboutController::class)->name('about');

Route::resource('fdtrcks', Controllers\FdtrckController::class)->only(['index', 'show']);
Route::resource('categories', Controllers\CategoryController::class)->only(['index', 'show']);
