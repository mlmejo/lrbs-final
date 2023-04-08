<?php

namespace App\Http\Controllers;

use App\Models\Competency;
use App\Models\LearningOutcome;
use Illuminate\Http\Request;

class LearningOutcomeController extends Controller
{
    public function create(Competency $competency)
    {
        return view('learn_outcomes.create', compact('competency'));
    }

    public function store(Request $request, Competency $competency)
    {
        $validated = $request->validate([
            'objective' => ['required', 'string'],
        ]);

        $competency->learn_outcomes()->create($validated);

        return redirect()->route('competencies.learn_outcomes.create', $competency)
            ->with('status', $request->objective . ' created.');
    }

    public function edit(Competency $competency, LearningOutcome $learn_outcome)
    {
        $tasks = $learn_outcome->tasks();

        return view('learn_outcomes.edit', compact(
            'competency',
            'learn_outcome',
            'tasks',
        ));
    }

    public function update(
        Request $request,
        Competency $competency,
        LearningOutcome $learn_outcome,
    ) {
        $validated = $request->validate([
            'objective' => ['required', 'string'],
        ]);

        $learn_outcome->update($validated);

        return redirect()->route(
            'competencies.learn_outcomes.edit',
            [$competency, $learn_outcome],
        )
            ->with('status', $request->objective . ' updated.');
    }

    public function destroy(Competency $competency, LearningOutcome $learn_outcome)
    {
        $message = $learn_outcome->objective . ' deleted.';

        $learn_outcome->delete();

        return redirect()->route(
            'qualifications.competencies.edit',
            [$competency->qualification, $competency],
        )->with('status', $message);
    }
}
