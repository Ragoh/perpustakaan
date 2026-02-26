<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\PasswordResetController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - PerpusKu Library System
|--------------------------------------------------------------------------
*/

// ===== Auth Routes (Guest) =====
Route::middleware('guest')->group(function () {
    Route::get('/login', fn() => view('auth.login'))->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', fn() => view('auth.register'))->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    Route::get('/forgot-password', fn() => view('auth.forgot-password'))->name('password.request');
    Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', fn() => view('auth.reset-password'))->name('password.reset');
    Route::post('/reset-password', [PasswordResetController::class, 'reset'])->name('password.update');
});

// ===== Logout (Auth) =====
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// ===== Public Routes =====
Route::get('/', fn() => view('user.index'))->name('home');
Route::get('/books', fn() => view('user.books.index'))->name('books.index');
Route::get('/books/{id}', fn() => view('user.books.show'))->name('books.show');

// ===== User Routes (Auth Required) =====
Route::middleware('auth')->group(function () {
    Route::get('/loans', fn() => view('user.loans.index'))->name('loans.index');
    Route::get('/loans/create/{book_id?}', fn() => view('user.loans.create'))->name('loans.create');
    Route::get('/reviews/create/{book_id}', fn() => view('user.reviews.create'))->name('reviews.create');
});

// ===== Petugas Routes =====
Route::prefix('petugas')->name('petugas.')->middleware(['auth', 'role:petugas,admin'])->group(function () {
    Route::get('/', fn() => view('petugas.dashboard.index'))->name('dashboard');
    
    // Books CRUD
    Route::get('/books', fn() => view('petugas.books.index'))->name('books.index');
    Route::get('/books/create', fn() => view('petugas.books.create'))->name('books.create');
    Route::get('/books/{id}/edit', fn() => view('petugas.books.edit'))->name('books.edit');
    
    // Categories CRUD
    Route::get('/categories', fn() => view('petugas.categories.index'))->name('categories.index');
    Route::get('/categories/create', fn() => view('petugas.categories.create'))->name('categories.create');
    Route::get('/categories/{id}/edit', fn() => view('petugas.categories.edit'))->name('categories.edit');
    
    // Loans Management
    Route::get('/loans', fn() => view('petugas.loans.index'))->name('loans.index');
    
    // Reports
    Route::get('/reports', fn() => view('petugas.reports.index'))->name('reports.index');
});

// ===== Admin Routes =====
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', fn() => view('admin.dashboard.index'))->name('dashboard');
    
    // Users Management
    Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    Route::get('/users/{id}/edit', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update');
    
    // Reports
    Route::get('/reports', fn() => view('admin.reports.index'))->name('reports.index');
});
