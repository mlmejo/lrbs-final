<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Trainer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class TrainerController extends Controller
{
    public function index()
    {
        return view('trainers.index', [
            'trainers' => Trainer::all(),
        ]);
    }

    public function create()
    {
        return view('trainers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $role = Role::firstOrCreate([
            'name' => 'trainer',
        ]);

        $user->roles()->attach($role);

        Trainer::create([
            'user_id' => $user->id,
        ]);

        return redirect()->route('trainers.create')
            ->with('status', 'Account created.');
    }

    public function edit(Trainer $trainer)
    {
        return view('trainers.edit', compact('trainer'));
    }

    public function update(Request $request, Trainer $trainer)
    {
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($trainer->user),
            ],
        ]);

        $trainer->user()->update($validated);

        return redirect()->route('trainers.edit', $trainer)
            ->with('status', 'Account updated.');
    }

    public function destroy(Trainer $trainer)
    {
        $trainer->user->delete();

        return redirect()->route('trainers.index')
            ->with('status', 'Account deleted.');
    }
}
