<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\DealController;
use App\Http\Controllers\TodoController;

// ダッシュボード
Route::get('/', function () {
    return redirect()->route('dashboard');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// リソースルート
Route::resource('companies', CompanyController::class);
Route::resource('cards', CardController::class);
Route::resource('deals', DealController::class);
Route::resource('todos', TodoController::class);


