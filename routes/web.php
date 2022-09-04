<?php

use App\Http\Controllers\MemcachedController;
use App\Http\Controllers\RedisController;
use App\Http\Controllers\SortController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['as' => 'sort.', 'prefix' => 'sort'], function() {
    Route::get('/bubble', [SortController::class, 'bubble'])->name('bubble');
    Route::get('/quick', [SortController::class, 'quick'])->name('quick');
});

Route::get('/memcached', [MemcachedController::class, 'index'])->name('memcached');
Route::get('/redis', [RedisController::class, 'index'])->name('redis');
