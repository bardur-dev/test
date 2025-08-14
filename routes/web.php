<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Dashboard (перенаправляем на задачи)
    Route::get('/dashboard', function () {
        return redirect()->route('tasks.index');
    })->name('dashboard');

    // Ресурсные маршруты для задач
    Route::resource('tasks', TaskController::class)->except([
        'create', 'edit', 'show' // Исключаем ненужные маршруты
    ]);

    // Альтернативно можно явно указать только нужные маршруты:
    // Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    // Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    // Route::patch('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    // Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
});
