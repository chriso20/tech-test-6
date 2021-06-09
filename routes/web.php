<?php

use Illuminate\Support\Facades\Route;
use App\Models\Media;
use App\Models\Poster;

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

Route::get('/test', function () {
    $media = Media::create(['title' => 'media title 16', 'year' => '1916']);
    $media->save();

    $poster = new Poster(['poster_url' => '16_POSTER_URL']);
    $media->poster()->save($poster);
    echo "DONE";
})->where('any', '.*');
Route::get('{any}', function () {
    return view('app');
})->where('any', '.*');
