<?php


use App\Http\Controllers\Controller;
use App\Http\Controllers\dummy;
use App\Http\Controllers\dummyController;
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
    return view('textboxes');
});


// Route::get('/dummy/citybeginsWith', [dummyController::class, 'citybeginsWith']);
// Route::get('/dummy/stateBeginsWith', [dummyController::class, 'stateBeginsWith']);

Route::get('/dummy/countrySearch', [dummyController::class, 'countrySearch']);
Route::get('/dummy/citySearch', [dummyController::class, 'citySearch']);
Route::get('/dummy/city', [dummyController::class, 'city']);
Route::get('/dummy/country', [dummyController::class, 'country']);

