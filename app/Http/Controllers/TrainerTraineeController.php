<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Registration;
use App\Models\Trainee;
use App\Models\Trainer;
use Illuminate\Http\Request;

class TrainerTraineeController extends Controller
{
    public function index(Request $request, Trainer $trainer)
    {
        $trainees = $request->user()
            ->trainer
            ->trainees()
            ->distinct(['trainee_id'])
            ->get();

        return view('trainers.trainees.index', compact('trainees'));
    }

    public function create()
    {
        return view('trainers.trainees.create', [
            'trainees' => Trainee::all(),
            'programs' => Program::orderBy('title')->get(),
        ]);
    }

    public function store(Request $request, Trainer $trainer)
    {
        $request->validate([
            'qualification_id' => ['required', 'exists:qualifications,id'],
            'trainee_id' => ['required', 'exists:trainees,id'],
        ]);

        Registration::create([
            'qualification_id' => $request->qualification_id,
            'trainee_id' => $request->trainee_id,
            'trainer_id' => $trainer->id,
        ]);

        return redirect()->route('trainers.trainees.create', $trainer)
            ->with('status', 'LRB created.');
    }

    public function edit(Trainer $trainer, Trainee $trainee)
    {
        $qualifications = $trainee->qualifications;
        $programs = Program::orderBy('title')->get();

        return view(
            'trainers.trainees.edit',
            compact('trainer', 'trainee', 'programs'),
        );
    }
}
