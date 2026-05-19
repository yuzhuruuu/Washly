<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

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

    public function editKurirProfile(Request $request): View
    {
        return view('kurir.profile', [
            'user' => $request->user(),
        ]);
    }

    public function updateKurirProfile(Request $request)
    {
        $user = Auth::guard('kurir')->user();

        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'string', 'max:15'],
        ]);

        $user->update($request->only(['nama', 'no_hp']));

        return Redirect::route('kurir.profile.edit')->with('status', 'profile-updated');
    }

    public function editKurirSettings(Request $request): View
    {
        return view('kurir.settings', [
            'user' => $request->user(),
        ]);
    }

    public function updateKurirSettings(Request $request)
    {
        $user = Auth::guard('kurir')->user();

        $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:kurirs,username,' . $user->id_kurir . ',id_kurir'],
            'notify_new_task' => ['nullable', 'boolean'],
            'no_hp' => ['nullable', 'string', 'max:15'],
        ]);

        $user->update($request->only(['username', 'notify_new_task', 'no_hp']));

        return Redirect::route('kurir.settings.edit')->with('status', 'profile-updated');
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

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
