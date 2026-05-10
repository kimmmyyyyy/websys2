<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BorrowerController;
use App\Http\Controllers\BookTransactionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;

// Public routes
Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// User routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/books/search', [UserController::class, 'search'])->name('books.search');
    Route::get('/books/browse', [UserController::class, 'browse'])->name('books.browse');
    Route::get('/books/{book}/detail', [UserController::class, 'bookDetail'])->name('book.detail');
    Route::post('/books/borrow', [UserController::class, 'requestBorrow'])->name('book.request-borrow');
    Route::post('/books/{transaction}/return', [UserController::class, 'returnBook'])->name('book.return');
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('/borrowing-history', [UserController::class, 'history'])->name('user.history');
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');

    // Books
    Route::resource('books', BookController::class)->except('show');

    // Categories
    Route::resource('categories', CategoryController::class)->except('show');

    // Borrowers
    Route::resource('borrowers', BorrowerController::class)->except('show');

    // Book Transactions
  Route::post('/borrow-book', [BookTransactionController::class, 'borrowBook'])
    ->name('borrow-book');

Route::get('/overdue-books', [BookTransactionController::class, 'listOverdue'])
    ->name('overdue-books');

Route::put('/transactions/{transaction}/due-date',
    [BookTransactionController::class, 'updateDueDate']
)->name('update-due-date');

Route::put('/transactions/{transaction}/return',
    [BookTransactionController::class, 'returnBook']
)->name('return-book');

Route::put('/transactions/{transaction}/mark-fine-paid',
    [BookTransactionController::class, 'markFineAsPaid']
)->name('mark-fine-paid');

    // Reports
    Route::get('/reports/borrowing', [ReportController::class, 'borrowingReport'])->name('reports.borrowing');
    Route::get('/reports/overdue', [ReportController::class, 'overdueReport'])->name('reports.overdue');
    Route::get('/reports/fine', [ReportController::class, 'fineReport'])->name('reports.fine');
    Route::get('/reports/activity', [ReportController::class, 'activityLog'])->name('reports.activity');
    Route::get('/reports/borrower-statistics', [ReportController::class, 'borrowerStatistics'])->name('reports.borrower-statistics');
   Route::get('/reports/borrowing/export', [ReportController::class, 'exportBorrowingReport'])
    ->name('reports.borrowing.export');
    
});
