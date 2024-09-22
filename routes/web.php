<?php

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
Route::post('/subworkloads/update-scores', [SubworkloadController::class, 'updateScores'])->name('subworkloads.updateScores');

Route::get('/users/create', [UserController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('users.create');

Route::post('/users', [UserController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('users.store');

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
