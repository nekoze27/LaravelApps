<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Food;

Route::get('/', function () {
    return view('front.home');
})->name('front.home');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/food', function () {
    return view('front.food',[
        'foodItems' => Food::query()->orderByDesc('created_at')->paginate(10)
    ]);
})->name('front.food');

Route::get('/calculator', function () {
    return view('front.calculator');
})->name('front.calculator');

require __DIR__.'/auth.php';
require __DIR__.'/dashboard.php';
