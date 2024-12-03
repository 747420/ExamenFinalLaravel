<?php

/**
 * Web Routes
 * 
 * This file defines the web routes for the application.
 * 
 * @author Jheivy Stiven Moreno Silva
 */

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CategoryController;

// Home route
Route::get('/', function () { return view('home'); })->name('home');

// Authentication routes
Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
Route::post('/register/create', [RegisterController::class, 'store'])->name('register.store');
Route::get('/logout', [RegisterController::class, 'logout'])->name('logout');
Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::post('/login/authenticate', [LoginController::class, 'authenticate'])->name('login.authenticate');

// Protected routes
Route::middleware('auth')->group(function () {
    // Tasks routes
    Route::get('/tasks/list', [TaskController::class,'index'])->name("tasks.list");
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    Route::patch('/tasks/{id}/toggle', [TaskController::class, 'toggleComplete'])->name('tasks.toggle-complete');
    
    // Categories routes
    Route::get('/categories/list', [CategoryController::class,'index'])->name("categories.index");
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
});
