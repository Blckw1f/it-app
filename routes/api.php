<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/projects', [ProjectController::class, 'index'])->name('project.index');
Route::post('/projects', [ProjectController::class, 'store'])->name('project.store');
Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('project.show');
Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('project.update');
Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('project.destroy');
Route::post('/tasks', [TaskController::class, 'store'])->name('task.store');
Route::get('/tasks/{task}', [TaskController::class, 'show'])->name('task.show');
Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('task.update');
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('task.destroy');
