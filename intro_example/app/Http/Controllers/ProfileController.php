<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Carbon\Carbon;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $validatedArray = $request->validated();
        $previousProfileFilePath = $user->profile_path;

        // プロフィール画像の更新がある場合は処理を行う
        if ($request->hasFile('profile_picture')) {

            // 以前のプロフィール画像が存在する場合は削除（必要に応じて）
            if ($user->profile_path) {
                Storage::disk('public')->delete($previousProfileFilePath);
            }

            // 新しいプロフィール画像を保存
            $file = $request->file('profile_picture');
            $md5Filename = md5($file->getClientOriginalName() . $user->username . Carbon::now()->toDateString()) . '.' . $file->getClientOriginalExtension();
            $profilePicturePath = $file->store(sprintf('/users/profiles/profile_pictures/%s', $md5Filename), 'public');

            // プロフィール画像のパスをユーザーモデルに保存
            $user->profile_path = $profilePicturePath;
        }

        // 他のプロフィール情報の更新
        $user->fill([
            'username' => $validatedArray['username'],
            'email' => $validatedArray['email'],
            'description' => $validatedArray['description'],
        ]);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');

        // $request->user()->fill($request->validated());

        // if ($request->user()->isDirty('email')) {
        //     $request->user()->email_verified_at = null;
        // }

        // $request->user()->save();

        // return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        $previousProfileFilePath = $user->profile_path;

        Auth::logout();

        // プロフィール画像の削除
        if ($user->profile_path) {
            Storage::disk('public')->delete($previousProfileFilePath);
        }

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
