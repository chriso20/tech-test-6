<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Media;
use App\Models\Poster;

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

Route::resource('get', App\Http\Controllers\GetController::class);
Route::delete('truncate', function () {
    Media::truncate();
    Poster::truncate();
    return 1;
});
Route::resource('media', App\Http\Controllers\MediaController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
