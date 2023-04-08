<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Trainee;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index(Request $request)
    {
        $trainees = $request->user()
            ->trainer
            ->trainees
            ->distinct(['trainee_id']);

        return view('registrations.index', compact('trainees'));
    }

    public function create()
    {
        return view('registrations.create', [
            'trainees' => Trainee::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'qualification_id' => ['required', 'exists:qualifications,id'],
            'trainee_id' => ['required', 'exists:trainees,id'],
        ]);

        $registration = new Registration($validated);

        $request
            ->user()
            ->trainer
            ->registrations()
            ->save($registration);

        return redirect()->route('trainees.create');
    }
}
