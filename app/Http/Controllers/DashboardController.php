<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = $request->user();

        if ($user->hasRole('admin')) {
            return view('admin.dashboard');
        } else if ($user->hasRole('trainer')) {
            return view('trainers.dashboard');
        } else if ($user->hasRole('trainee')) {
            return view('trainees.dashboard');
        }
    }
}
