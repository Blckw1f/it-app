<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::post('/projects', [ProjectController::class, 'store'])->name('project.store');
