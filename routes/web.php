<?php

use App\Http\Controllers\ForSuperAdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WorkloadController;
use App\Http\Controllers\SubworkloadController;

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/testtest', function () {
    return view('test');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/manage', [UserController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('manage');

Route::get('/workload', [WorkloadController::class, 'index'])->middleware(['auth', 'verified'])->name('workload');
Route::get('/workloads/{id}', [WorkloadController::class, 'show'])->middleware(['auth', 'verified'])->name('workloads.show');
Route::get('/summary/{id}', [WorkloadController::class, 'summary'])->middleware(['auth', 'verified'])->name('workloads.summary');
Route::get('/view-report', [WorkloadController::class, 'view_report'])->middleware(['auth', 'verified'])->name('workloads.view-report');
route::get('/manage-subworkload-list-by-id/{userId}/{workloadId}', [ForSuperAdminController::class, 'index'])->name('manage-subworkload-list-by-id');
route::get('/staff-manage-subworkload-list-by-id/{userId}/{workloadId}', [ForSuperAdminController::class, 'staff'])->name('staff-manage-subworkload-list-by-id');
route::get('/view-report-by-id/{userId}/{workloadId}', [ForSuperAdminController::class, 'summary'])->name('summary-by-id');
route::get('/print-all-workload/{userId}', [ForSuperAdminController::class, 'print_all_workload'])->name('print-all-workload');
route::get('/print-all-workload-superadmin/{userId}', [ForSuperAdminController::class, 'print_all_workload_superadmin'])->name('print-all-workload-superadmin');
Route::post('/subworkloads/update-scores', [SubworkloadController::class, 'updateScores'])->name('subworkloads.updateScores');
// web.php
Route::get('/search-users', [UserController::class, 'searchUsers']);
Route::get('/fetch-user-workloads/{userId}', [UserController::class, 'fetchUserWorkloads']);

Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('edit-user');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');

Route::get('/users/create', [UserController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('users.create');

// Route::post('/users', [UserController::class, 'store'])
//     ->middleware(['auth', 'verified'])
//     ->name('users.store');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
// /move-subject/${move_subworkloadId}/${move_userid}/${modal_move_professor_2}
Route::put('/move-subject/{subworkloadId}/{own_userid}/{final_userid}', [ForSuperAdminController::class, 'move_subject_inuser'])->name('move_subject.update');

route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
route::delete('/images/{id}/{userId}/{index}', [UserController::class, 'destroy_score'])->name('images.destroy');
route::delete('/remove-subjects/{id}/{userId}', [UserController::class, 'destroy_subjects'])->name('subjects.destroy');

//     Route::get('/', function () {
//         return view('auth.login');
//     });

// Route::middleware(['auth', 'role:admin'])->group(function () {
//     Route::get('/dashboard', function () {
//         return 'Admin Dashboard';
//     });
// });

// Route::middleware(['auth', 'role:user'])->group(function () {
//     Route::get('/user', function () {
//         return 'User Dashboard';
//     });
// });



require __DIR__ . '/auth.php';
