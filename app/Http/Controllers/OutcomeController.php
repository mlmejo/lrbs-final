<?php

namespace App\Http\Controllers;

use App\Models\Competency;
use App\Models\Outcome;
use Illuminate\Http\Request;

class OutcomeController extends Controller
{
    public function create(Competency $competency)
    {
        return view('outcomes.create', compact('competency'));
    }

    public function store(Request $request, Competency $competency)
    {
        $validated = $request->validate([
            'objective' => ['required', 'string'],
        ]);

        $competency->outcomes()->create($validated);

        return redirect()->route('competencies.outcomes.create', $competency)
            ->with('status', $request->objective . ' created.');
    }

    public function edit(Competency $competency, Outcome $outcome)
    {
        $tasks = $outcome->tasks();

        return view('outcomes.edit', compact(
            'competency',
            'outcome',
            'tasks',
        ));
    }

    public function update(Request $request, Competency $competency, Outcome $outcome)
    {
        $validated = $request->validate([
            'objective' => ['required', 'string'],
        ]);

        $outcome->update($validated);

        return redirect()->route('competencies.outcomes.edit', [$competency, $outcome])
            ->with('status', $request->objective . ' updated.');
    }

    public function destroy(Competency $competency, Outcome $outcome)
    {
        $message = $outcome->objective . ' deleted.';

        $outcome->delete();

        return redirect()->route(
            'qualifications.competencies.edit',
            [$competency->qualification, $competency]
        )->with('status', $message);
    }
}
