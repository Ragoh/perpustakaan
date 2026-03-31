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
Route::get('/books', [\App\Http\Controllers\User\BookController::class, 'index'])->name('books.index');
Route::get('/books/{id}', [\App\Http\Controllers\User\BookController::class, 'show'])->name('books.show');

// ===== User Routes (Auth + Role User Only) =====
Route::middleware(['auth', 'role:user'])->group(function () {
    // Peminjaman
    Route::get('/loans', [\App\Http\Controllers\User\LoanController::class, 'index'])->name('loans.index');
    Route::get('/loans/create/{book_id}', [\App\Http\Controllers\User\LoanController::class, 'create'])->name('loans.create');
    Route::post('/loans', [\App\Http\Controllers\User\LoanController::class, 'store'])->name('loans.store');
    Route::get('/loans/{id}/receipt', [\App\Http\Controllers\User\LoanController::class, 'receipt'])->name('loans.receipt');
    Route::post('/loans/{id}/return', [\App\Http\Controllers\User\LoanController::class, 'returnBook'])->name('loans.return');
    
    // Ulasan
    Route::get('/reviews/create/{book_id}', fn($book_id) => view('user.reviews.create', ['book' => \App\Models\Book::findOrFail($book_id)]))->name('reviews.create');
    Route::post('/reviews', [\App\Http\Controllers\User\ReviewController::class, 'store'])->name('reviews.store');
});

// ===== Petugas Routes =====
Route::prefix('petugas')->name('petugas.')->middleware(['auth', 'role:petugas,admin'])->group(function () {
    Route::get('/', fn() => view('petugas.dashboard.index'))->name('dashboard');
    
    // Categories CRUD
    Route::get('/categories', [\App\Http\Controllers\Petugas\CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [\App\Http\Controllers\Petugas\CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [\App\Http\Controllers\Petugas\CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}/edit', [\App\Http\Controllers\Petugas\CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{id}', [\App\Http\Controllers\Petugas\CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}', [\App\Http\Controllers\Petugas\CategoryController::class, 'destroy'])->name('categories.destroy');
    
    // Books CRUD
    Route::get('/books', [\App\Http\Controllers\Petugas\BookController::class, 'index'])->name('books.index');
    Route::get('/books/create', [\App\Http\Controllers\Petugas\BookController::class, 'create'])->name('books.create');
    Route::post('/books', [\App\Http\Controllers\Petugas\BookController::class, 'store'])->name('books.store');
    Route::get('/books/{id}/edit', [\App\Http\Controllers\Petugas\BookController::class, 'edit'])->name('books.edit');
    Route::put('/books/{id}', [\App\Http\Controllers\Petugas\BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{id}', [\App\Http\Controllers\Petugas\BookController::class, 'destroy'])->name('books.destroy');
    
    // Loans Management
    Route::get('/loans', [\App\Http\Controllers\Petugas\LoanController::class, 'index'])->name('loans.index');
    Route::get('/loans/{id}', [\App\Http\Controllers\Petugas\LoanController::class, 'show'])->name('loans.show');
    Route::post('/loans/{id}/approve', [\App\Http\Controllers\Petugas\LoanController::class, 'approve'])->name('loans.approve');
    Route::post('/loans/{id}/reject', [\App\Http\Controllers\Petugas\LoanController::class, 'reject'])->name('loans.reject');
    Route::post('/loans/{id}/borrowed', [\App\Http\Controllers\Petugas\LoanController::class, 'markBorrowed'])->name('loans.borrowed');
    Route::post('/loans/{id}/approve-return', [\App\Http\Controllers\Petugas\LoanController::class, 'approveReturn'])->name('loans.approve-return');
    Route::post('/loans/{id}/reject-return', [\App\Http\Controllers\Petugas\LoanController::class, 'rejectReturn'])->name('loans.reject-return');
    
    // Reports
    Route::get('/reports', [\App\Http\Controllers\Petugas\ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/preview', [\App\Http\Controllers\Petugas\ReportController::class, 'preview'])->name('reports.preview');
});

// ===== Admin Routes =====
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', fn() => view('admin.dashboard.index'))->name('dashboard');
    
    // Users Management
    Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    Route::get('/users/{id}/edit', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update');
    
    // Tambah Petugas
    Route::get('/petugas/create', [\App\Http\Controllers\Admin\UserController::class, 'createPetugas'])->name('petugas.create');
    Route::post('/petugas', [\App\Http\Controllers\Admin\UserController::class, 'storePetugas'])->name('petugas.store');
    
    // Reports
    Route::get('/reports', [\App\Http\Controllers\Admin\ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/preview', [\App\Http\Controllers\Admin\ReportController::class, 'preview'])->name('reports.preview');
});
