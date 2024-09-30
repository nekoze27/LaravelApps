<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Job;

Route::get('/', function () {
    return view('front.home');
})->name('front.home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/jobs', function() {
    return view('front.jobs', [
        'jobsItems' => \App\Models\Job::query()->orderByDesc('created_at')->paginate(10)
    ]);
})->name('front.jobs');

Route::get('/take-home-pay', function () {
    return view('front.calculator');
})->name('front.calculator');

require __DIR__.'/auth.php';
