<?php

use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

//newCode: Home
Route::get('/', [TransactionController::class, 'home'])
    ->name('home');

//newCode: Summary
Route::get('/summary', [TransactionController::class, 'summary'])
    ->name('summary');

//newCode: More
Route::get('/more', function () {
    return view('more.index');
})->name('more');

//newCode: Transactions
Route::resource('transactions', TransactionController::class);
