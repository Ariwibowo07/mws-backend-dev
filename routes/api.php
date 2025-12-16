<?php

use App\Http\Controllers\Admin\EmotionalCheckinsController;
use App\Http\Controllers\Admin\GamificationController;
use App\Http\Controllers\Admin\InterventionController;
use App\Http\Controllers\Admin\MentorController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\ProgressController;
use App\Http\Controllers\Admin\StrategyController;
use App\Http\Controllers\admin\TeacherStudentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Teacher\DashboardController;
use App\Models\EmotionalCheckin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::post('auth/google/token', [AuthController::class, 'loginWithToken']);

Route::controller(UserController::class)->group(function () {
    Route::get('user', 'index');
    Route::get('user/{uuid}', 'get');
    Route::post('user', 'store');
    Route::patch('user/{uuid}', 'update');
    Route::delete('user/{uuid}', 'destroy');
});

/*
|--------------------------------------------------------------------------
| Emotional Check-in Routes
|--------------------------------------------------------------------------
*/
Route::controller(EmotionalCheckinsController::class)
    ->middleware(['auth:sanctum']) // semua route wajib login
    ->group(function () {
        Route::get('emotional-checkin', 'index')->middleware('permission:index emotional checkin');
        Route::get('emotional-checkin/{id}', 'get')->middleware('permission:get emotional checkin');
        Route::post('emotional-checkin', 'store')->middleware('permission:create emotional checkin');
        Route::patch('emotional-checkin/{uuid}', 'update')->middleware('permission:update emotional checkin');
        Route::delete('emotional-checkin/{id}', 'destroy')->middleware('permission:delete emotional checkin');
    });

Route::post('/send-emotional-checkin/{checkin}', function (Request $request, $checkin) {
    $checkin = EmotionalCheckin::findOrFail($checkin);

    return app(NotificationController::class)->sendToSelected($checkin);
});

Route::middleware(['auth:sanctum', 'role:Teacher|SE Teacher'])
    ->prefix('teacher')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index']);
        Route::get('{teacherId}/students', [TeacherStudentController::class, 'index']);

        Route::post('/interventions', [InterventionController::class, 'store']);
        Route::post('/interventions/group', [InterventionController::class, 'storeGroup']);
        Route::get('/interventions/{id}', [InterventionController::class, 'show']);
        Route::patch('/interventions/{id}', [InterventionController::class, 'update']);
        Route::delete('/interventions/{id}', [InterventionController::class, 'destroy']);
        Route::post('/interventions/{id}/progress', [ProgressController::class, 'store']);

        Route::get('/mentors', [MentorController::class, 'index']);
        Route::post('/mentors/{id}/assign-student', [MentorController::class, 'assignStudent']);

        Route::get('/strategies', [StrategyController::class, 'index']);
        Route::post('/strategies', [StrategyController::class, 'store']);
        Route::put('/strategies/{id}', [StrategyController::class, 'update']);
        Route::delete('/strategies/{id}', [StrategyController::class, 'destroy']);

        Route::get('/gamification/profile', [GamificationController::class, 'profile']);
        Route::post('/gamification/checkin', [GamificationController::class, 'checkin']);
    });
