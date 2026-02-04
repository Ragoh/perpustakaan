<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - PerpusKu Library System
|--------------------------------------------------------------------------
*/

// ===== User Routes =====
Route::get('/', fn() => view('user.index'))->name('home');
Route::get('/books', fn() => view('user.books.index'))->name('books.index');
Route::get('/books/{id}', fn() => view('user.books.show'))->name('books.show');
Route::get('/loans', fn() => view('user.loans.index'))->name('loans.index');
Route::get('/loans/create/{book_id?}', fn() => view('user.loans.create'))->name('loans.create');
Route::get('/reviews/create/{book_id}', fn() => view('user.reviews.create'))->name('reviews.create');

// ===== Petugas Routes =====
Route::prefix('petugas')->name('petugas.')->group(function () {
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
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', fn() => view('admin.dashboard.index'))->name('dashboard');
    
    // Users Management
    Route::get('/users', fn() => view('admin.users.index'))->name('users.index');
    Route::get('/users/{id}/edit', fn() => view('admin.users.edit'))->name('users.edit');
    
    // Roles Management
    Route::get('/roles', fn() => view('admin.roles.index'))->name('roles.index');
    
    // Reports
    Route::get('/reports', fn() => view('admin.reports.index'))->name('reports.index');
});
