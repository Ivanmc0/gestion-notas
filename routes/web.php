<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\GradeController;
use Illuminate\Support\Facades\Route;

// Redirige la ruta raíz al dashboard
Route::get('/', function () {
    return redirect('/dashboard');
});

// Ruta del dashboard (usando AdminLTE)
Route::get('/dashboard', function () {
    return view('adminlte::page'); // Vista personalizada de AdminLTE
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas de perfil (generadas por Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas para admin (protegidas por rol)
Route::group(['middleware' => ['auth', 'verified', 'role:admin']], function () {
    Route::resource('students', StudentController::class);
});

// Rutas para docentes (protegidas por rol)
Route::group(['middleware' => ['auth', 'verified', 'role:docente']], function () {
    Route::get('/grades', [GradeController::class, 'index'])->name('grades.index');
});

require __DIR__.'/auth.php';