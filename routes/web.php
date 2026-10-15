<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

// Route::get('/tasks', function () {
//     return view('index');
// });

Route::get('/', [TaskController::class, 'index'])->name('tasks.index');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::get('/tasks/{id}', [TaskController::class, 'edit'])->name('tasks.edit');
Route::post('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');
//dd("search route");
Route::get('/tasks', [TaskController::class, 's'])->name('tasks.s');
Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');

// dd("restore route");
Route::get('/restore/tasks/{id}', [TaskController::class, 'restoreTask'])->name('tasks.restoreTask');
Route::get('/restore/View', [TaskController::class, 'restoreView'])->name('tasks.restoreView');
