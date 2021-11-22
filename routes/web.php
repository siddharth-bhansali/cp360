<?php

use App\Http\Controllers\FieldsController;
use App\Http\Controllers\FormController;
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

Route::get('/', function() {
    return redirect(route('forms.create'));
})->name('home');

Route::resource('/fields', FieldsController::class)->middleware('auth')->except([
    'index'
]);
Route::resource('/forms', FormController::class)->only([
    'index', 'create', 'store'
]);
