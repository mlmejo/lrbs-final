<?php

namespace App\Http\Controllers;

use App\Models\LearningOutcome;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function create(LearningOutcome $learn_outcome)
    {
        return view('tasks.create', compact('learn_outcome'));
    }

    public function store(Request $request, LearningOutcome $learn_outcome)
    {
        $validated = $request->validate([
            'title' => ['required', 'string'],
        ]);

        $learn_outcome->tasks()->create($validated);

        return redirect()->route('learn_outcomes.tasks.create', $learn_outcome)
            ->with('status', $request->title . ' created.');
    }

    public function edit(LearningOutcome $learn_outcome, Task $task)
    {
        return view('tasks.edit', compact('learn_outcome', 'task'));
    }

    public function update(Request $request, LearningOutcome $learn_outcome, Task $task)
    {
        $validated = $request->validate([
            'title' => ['required', 'string'],
        ]);

        $task->update($validated);

        return redirect()->route('learn_outcomes.tasks.edit', [$learn_outcome, $task])
            ->with('status', $request->title . ' updated.');
    }

    public function destroy(LearningOutcome $learn_outcome, Task $task)
    {
        $message = $task->title . ' deleted.';

        $task->delete();

        return redirect()->route(
            'competencies.learn_outcomes.edit',
            [$learn_outcome->competency, $learn_outcome,]
        )->with('status', $message);
    }
}
