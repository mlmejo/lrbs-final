<?php

namespace App\Http\Controllers;

use App\Models\Competency;
use App\Models\Qualification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CompetencyController extends Controller
{
    public function create(Qualification $qualification): View
    {
        return view('competencies.create', compact('qualification'));
    }

    public function store(Request $request, Qualification $qualification): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string'],
            'category' => ['required', Rule::in(['basic', 'common', 'core'])],
        ]);

        $qualification->competencies()->create($validated);

        return redirect()->route('qualifications.competencies.create', $qualification)
            ->with('status', $request->title . ' created.');
    }

    public function edit(Qualification $qualification, Competency $competency)
    {
        return view('competencies.edit', compact(
            'qualification',
            'competency',
        ));
    }

    public function update(Request $request, Qualification $qualification, Competency $competency)
    {
        $validated = $request->validate([
            'title' => ['required', 'string'],
            'category' => ['required', Rule::in(['basic', 'common', 'core'])],
        ]);

        $competency->update($validated);

        return redirect()->route('qualifications.competencies.edit', [$qualification, $competency])
            ->with('status', $request->title . ' updated.');
    }

    public function destroy(Qualification $qualification, Competency $competency)
    {
        $message = $competency->title . ' deleted';

        $competency->delete();

        return redirect()->route('qualifications.edit', $qualification)
            ->with('status', $message);
    }
}
