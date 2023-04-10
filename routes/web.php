<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\ProgramQualificationController;
use App\Http\Controllers\RemarkController;
use App\Http\Controllers\TraineeQualificationController;
use App\Http\Controllers\TrainerTraineeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', '/register');

Route::get('/dashboard', DashboardController::class);

Route::resource('trainers.trainees', TrainerTraineeController::class)
    ->middleware('auth');

Route::get(
    '/programs/{program}/qualifications',
    [ProgramQualificationController::class, 'index'],
)->middleware('auth');

Route::resource('remarks', RemarkController::class)
    ->except(['show'])
    ->middleware('auth');

Route::resource('trainees.qualifications', TraineeQualificationController::class)
    ->middleware('auth');

Route::get('/trainees/remarks', [RemarkController::class, 'show'])
    ->middleware('auth')->name('remarks.show');

Route::get('/remarks/print', PrintController::class)
    ->middleware('auth')->name('print');

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
