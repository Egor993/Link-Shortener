<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkShortener;

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

Route::get('/', [LinkShortener::class, 'index'])->name('linkShortener');
Route::post('/', [LinkShortener::class, 'save'])->name('saveLink');
Route::get('{link}', [LinkShortener::class, 'redirect'])->name('redirect');
