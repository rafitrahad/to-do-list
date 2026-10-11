<?php

use App\Http\Controllers\Task\TaskManagementController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TaskManagementController::class, 'index'])->name('task.index');

// replace the page
//create a task
Route::post('/tasks', [TaskManagementController::class, 'store']);


Route::get('/tasks/search', [TaskManagementController::class, 'toSearch'])->name('task.toSearch');

//delete from list
Route::delete('/tasks/{id}', [TaskManagementController::class, 'destroy'])->name('task.delete');

//edit
Route::get('/tasks/{id}', [TaskManagementController::class, 'edit'])->name('task.edit');

//update
Route::post('/tasks/{id}', [TaskManagementController::class, 'update'])->name('task.update');
