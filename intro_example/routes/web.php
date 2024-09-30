<?php

use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;


Route::get('/', function () {
    // return view('welcome');
    // fakerオブジェクトを生成
    $faker = fake();
    // 4から10のランダムな文を生成
    $chatMessages = $faker->sentences($faker->numberBetween(4, 10));
    // 最新の10ユーザーを取得
    $users = User::orderBy('created_at', 'desc')->take(10)->get();
    // 'welcome'ビューを表示し、生成したチャットメッセージをビューに渡す
    // 取得したユーザー情報をビューに渡す
    return view('welcome', [
        'chatMessages'=>$chatMessages,
        'users' => $users
    ]);
});

Route::get('/dashboard', function () {
    $faker = fake();
    return view('dashboard', [
        'welcomeMessages' => $faker->paragraphs(5),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/about_us', function() {
    return view('about_us');
});

Route::get('/users/profile/{user}', function(User $user) {
    return view('user-profile', [
        'userInfo' => [
            'username'=>
            $user->username,
            'profileImageLink'=> Storage::url($user->profile_path),
            'description'=>$user->description,
        ],
    ]);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
