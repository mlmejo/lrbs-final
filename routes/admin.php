<?php

use App\Http\Controllers\CompetencyController;
use App\Http\Controllers\OutcomeController;
use App\Http\Controllers\QualificationController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::resource('qualifications', QualificationController::class);
    Route::resource('qualifications.competencies', CompetencyController::class);
    Route::resource('competencies.outcomes', OutcomeController::class);
    Route::resource('outcomes.tasks', TaskController::class);
});
