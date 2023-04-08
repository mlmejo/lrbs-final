<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Qualification;
use Illuminate\Contracts\View\View as ViewView;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class QualificationController extends Controller
{
    public function index(): View
    {
        return view('qualifications.index', [
            'qualifications' => Qualification::orderBy('title')->get(),
        ]);
    }

    public function create(): ViewView
    {
        return view('qualifications.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'unique:qualifications'],
            'duration' => ['required', 'integer'],
        ]);

        Qualification::create($validated);

        return redirect()->route('qualifications.create')
            ->with('status', $request->title . ' created.');
    }

    public function edit(Qualification $qualification): View
    {
        return view('qualifications.edit', compact('qualification'));
    }

    public function update(Request $request, Qualification $qualification): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', Rule::unique('qualifications')->ignore($qualification)],
            'duration' => ['integer'],
        ]);

        $qualification->update($validated);

        return redirect()->route('qualifications.edit', $qualification)
            ->with('status', $request->title . ' updated');
    }

    public function destroy(Qualification $qualification): RedirectResponse
    {
        $message = $qualification->title . ' deleted.';

        $qualification->delete();

        return redirect()->route('qualifications.index')
            ->with('status', $message);
    }
}
