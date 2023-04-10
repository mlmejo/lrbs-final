<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function __invoke(Request $request)
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

        return view('remarks.print', compact(
            'registration',
            'basic_competencies',
            'common_competencies',
            'core_competencies',
        ));
    }
}
