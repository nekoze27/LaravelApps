<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Carbon\Carbon;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            // 'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase',
            'email', 'max:255', 'unique:'.User::class],
            'description' => ['nullable', 'string', 'max:2000'],
            'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:20480'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            // 'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'description' => $request->description,
            'profile_path' => isset($profilePicturePath) ? $profilePicturePath : null,
            'password' => Hash::make($request->password),
        ]);

        // プロフィール画像の保存
        if ($request->hasFile('profile_picture')) {
            // ユーザーがアップロードした画像ファイルを取り出し、安全なファイル名に変換して保存
            $file = $request->file('profile_picture');
            // ファイル名をmd5文字列に変換。ファイル名、ユーザー名、および現在の日付文字列を使用
            $md5Filename = md5($file->getClientOriginalName() . $request->username . Carbon::now()->toDateString()) . '.' . $file->getClientOriginalExtension();
            $profilePicturePath = $request->file('profile_picture')->store(sprintf('/users/profiles/profile_pictures/%s', $md5Filename), 'public');

            $user->profile_path = $profilePicturePath;
            $user->save();

        } else {
            $profilePicturePath = null;
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
