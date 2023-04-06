<?php

namespace App\Http\Controllers;

use App\Models\Outcome;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function create(Outcome $outcome)
    {
        return view('tasks.create', compact('outcome'));
    }

    public function store(Request $request, Outcome $outcome)
    {
        $validated = $request->validate([
            'title' => ['required', 'string'],
        ]);

        $outcome->tasks()->create($validated);

        return redirect()->route('outcomes.tasks.create', $outcome)
            ->with('status', $request->title . ' created.');
    }

    public function edit(Outcome $outcome, Task $task)
    {
        return view('tasks.edit', compact('outcome', 'task'));
    }

    public function update(Request $request, Outcome $outcome, Task $task)
    {
        $validated = $request->validate([
            'title' => ['required', 'string'],
        ]);

        $task->update($validated);

        return redirect()->route('outcomes.tasks.edit', [$outcome, $task])
            ->with('status', $request->title . ' updated.');
    }

    public function destroy(Outcome $outcome, Task $task)
    {
        $message = $task->title . ' deleted.';

        $task->delete();

        return redirect()->route(
            'competencies.outcomes.edit',
            [$outcome->competency, $outcome,]
        )->with('status', $message);
    }
}
