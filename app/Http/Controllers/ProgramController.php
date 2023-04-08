<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Qualification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProgramController extends Controller
{
    public function index(): View
    {
        return view('programs.index', [
            'programs' => Program::orderBy('title')->get(),
        ]);
    }

    public function create(): View
    {
        return view('programs.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'unique:programs'],
        ]);

        Program::create($validated);

        return redirect()->route('programs.create')
            ->with('status', $request->title . ' created.');
    }

    public function edit(Program $program): View
    {
        return view('programs.edit', [
            'program' => $program,
            'qualifications' => Qualification::orderBy('title')->get(),
        ]);
    }

    public function update(Request $request, Program $program): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', Rule::unique('programs')->ignore($program)],
        ]);

        $program->update($validated);

        return redirect()->route('programs.edit', $program)
            ->with('status', $request->title . ' updated.');
    }

    public function destroy(Program $program)
    {
        $message = $program->title . ' deleted.';

        $program->delete();

        return redirect()->route('programs.index')
            ->with('status', $message);
    }
}
