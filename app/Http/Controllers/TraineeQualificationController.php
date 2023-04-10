<?php

namespace App\Http\Controllers;

use App\Models\Trainee;
use Illuminate\Http\Request;

class TraineeQualificationController extends Controller
{
    public function index(Request $request, Trainee $trainee)
    {
        $registrations = $request->user()
            ->trainee
            ->registrations()
            ->get();

        return view('trainees.qualifications.index', compact('registrations'));
    }
}
