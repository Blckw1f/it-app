<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::post('/projects', [ProjectController::class, 'store'])->name('project.store');
Route::post('/tasks', [TaskController::class, 'store'])->name('task.store');
