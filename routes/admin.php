<?php

use App\Http\Controllers\CompetencyController;
use App\Http\Controllers\LearningOutcomeController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ProgramQualificationController;
use App\Http\Controllers\QualificationController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TraineeController;
use App\Http\Controllers\TrainerController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::resource('programs', ProgramController::class);
    Route::resource('programs.qualifications', ProgramQualificationController::class)
        ->except('index');
    Route::resource('qualifications', QualificationController::class);
    Route::resource('qualifications.competencies', CompetencyController::class);
    Route::resource('competencies.learn_outcomes', LearningOutcomeController::class);
    Route::resource('learn_outcomes.tasks', TaskController::class);
    Route::resource('trainees', TraineeController::class);
    Route::resource('trainers', TrainerController::class);
});
