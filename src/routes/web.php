<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\DealController;
use App\Http\Controllers\TodoController;
use App\Models\Company;
use App\Models\Card;
use App\Models\Deal;
use App\Models\Todo;


Route::get('/', function () {
    return redirect()->route('dashboard');
});

// ダッシュボード
Route::get('/dashboard', function () {
    $stats = [
        'companies' => Company::count(),
        'cards' => Card::count(),
        'deals' => Deal::whereIn('status', ['lead', 'proposal', 'negotiation'])->count(),
        'amount' => Deal::whereIn('status', ['lead', 'proposal', 'negotiation'])->sum('amount'),
    ];

    $recentCards = Card::with('company')->latest()->take(4)->get();
    $recentDeals = Deal::with('company')->latest()->take(4)->get();
    $todos       = Todo::with(['deal', 'card'])->where('is_done', false)->take(4)->get();

    return view('dashboard', compact('stats', 'recentCards', 'recentDeals', 'todos'));
})->name('dashboard');

// リソースルート
Route::resource('companies', CompanyController::class); //　会社
Route::resource('companies.cards', CardController::class)->shallow(); //　会社に紐づく名刺
Route::resource('deals', DealController::class); //　商談
Route::resource('todos', TodoController::class); //　Todo
Route::patch('/todos/{todo}/toggle', [TodoController::class, 'toggle'])->name('todos.toggle'); //　Todoの完了/未完了切り替え

//　認証ルート
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
