<?php

namespace App\Http\Controllers;

use App\Models\LearningOutcome;
use App\Models\Registration;
use App\Models\Remark;
use Illuminate\Http\Request;

class RemarkController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'registration' => ['required', 'integer', 'exists:registrations,id'],
        ]);

        $registration = Registration::find($request->registration);

        $basic_competencies = $registration->qualification
            ->competencies()
            ->where('category', 'basic')
            ->get();

        $common_competencies = $registration->qualification
            ->competencies()
            ->where('category', 'common')
            ->get();

        $core_competencies = $registration->qualification
            ->competencies()
            ->where('category', 'core')
            ->get();

        return view('remarks.index', compact(
            'registration',
            'basic_competencies',
            'common_competencies',
            'core_competencies',
        ));
    }

    public function create(Request $request)
    {
        $request->validate([
            'registration' => ['integer', 'exists:registrations,id'],
            'learn_outcome' => ['integer', 'exists:learn_outcomes,id'],
        ]);

        $registration = Registration::find($request->registration);
        $learn_outcome = LearningOutcome::find($request->learn_outcome);
        $remark = $registration->getRemark($learn_outcome);

        return view('remarks.create', compact('registration', 'learn_outcome', 'remark'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'registration' => ['integer', 'exists:registrations,id'],
            'learn_outcome' => ['integer', 'exists:learn_outcomes,id'],
            'content' => ['required', 'string'],
        ]);

        $registration = Registration::find($request->registration);
        $learn_outcome = LearningOutcome::find($request->learn_outcome);
        $remark = $registration->getRemark($learn_outcome);

        if ($remark === null) {
            Remark::create([
                'registration_id' => $registration->id,
                'learn_outcome_id' => $learn_outcome->id,
                'content' => $request->content,
            ]);
        } else {
            $remark->update(['content' => $request->content]);
        }

        return redirect()->route('remarks.index', ['registration' => $registration])
            ->with('status', 'Updated remark');
    }

    public function show(Request $request)
    {
        $request->validate([
            'registration' => ['required', 'integer', 'exists:registrations,id'],
        ]);

        $registration = Registration::find($request->registration);

        $basic_competencies = $registration->qualification
            ->competencies()
            ->where('category', 'basic')
            ->get();

        $common_competencies = $registration->qualification
            ->competencies()
            ->where('category', 'common')
            ->get();

        $core_competencies = $registration->qualification
            ->competencies()
            ->where('category', 'core')
            ->get();

        return view('remarks.show', compact(
            'registration',
            'basic_competencies',
            'common_competencies',
            'core_competencies',
        ));
    }
}
