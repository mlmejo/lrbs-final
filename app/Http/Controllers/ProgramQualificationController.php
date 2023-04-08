<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Qualification;
use Illuminate\Http\Request;

class ProgramQualificationController extends Controller
{
    public function index(Program $program)
    {
        return response()->json([
            'qualifications' => $program->qualifications,
        ]);
    }

    public function store(Request $request, Program $program)
    {
        $request->validate([
            'qualificationIds' => ['array'],
        ]);

        if (!$request->qualificationIds) {
            $program->qualifications()->detach();
        } else {
            $qualifications = Qualification::findMany(
                array_values($request->qualificationIds)
            );

            $program->qualifications()->sync($qualifications);
        }

        return redirect()->route('programs.edit', $program)
            ->with('status', 'Added qualifications.');
    }
}
