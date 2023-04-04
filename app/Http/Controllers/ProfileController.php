<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        return redirect()->route('profile.edit')->with('status', 'Profile updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        return redirect('/');
    }
}
