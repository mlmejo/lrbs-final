<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Role;
use App\Models\Trainee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class TraineeController extends Controller
{
    public function index()
    {
        return view('trainees.index', [
            'trainees' => Trainee::all(),
        ]);
    }

    public function create()
    {
        return view('trainees.create', [
            'programs' => Program::orderBy('title')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'program_id' => ['required', 'integer', 'exists:programs,id'],
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
            'name' => 'trainee',
        ]);

        $user->roles()->attach($role);

        Trainee::create([
            'program_id' => $request->program_id,
            'user_id' => $user->id,
        ]);

        return redirect()->route('trainees.create')
            ->with('status', 'Account created.');
    }

    public function edit(Trainee $trainee)
    {
        return view('trainees.edit', [
            'programs' => Program::orderBy('title')->get(),
            'trainee' => $trainee,
        ]);
    }

    public function update(Request $request, Trainee $trainee)
    {
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($trainee->user),
            ],
        ]);

        $trainee->update($validated);

        return redirect()->route('trainees.edit', $trainee)
            ->with('status', 'Account updated.');
    }

    public function destroy(Trainee $trainee)
    {
        $trainee->user->delete();

        return redirect()->route('trainees.index')
            ->with('status', 'Account deleted.');
    }
}
