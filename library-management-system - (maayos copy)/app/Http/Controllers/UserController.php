<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookTransaction;
use App\Models\Borrower;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserController extends Controller
{
    // View user dashboard with borrowed books
    public function dashboard()
    {
        $user = Auth::user();
        $borrower = Borrower::where('user_id', $user->id)->first();

        if (!$borrower) {
            return view('user.not-registered');
        }

        $borrowedBooks = BookTransaction::where('borrower_id', $borrower->id)
            ->where('status', 'borrowed')
            ->with('book')
            ->get();

        $borrowingHistory = BookTransaction::where('borrower_id', $borrower->id)
            ->where('status', 'returned')
            ->with('book')
            ->latest('return_date')
            ->paginate(10);

        $overdue = BookTransaction::where('borrower_id', $borrower->id)
            ->where('status', 'borrowed')
            ->where('due_date', '<', Carbon::now()->toDateString())
            ->count();

        return view('user.dashboard', compact('borrowedBooks', 'borrowingHistory', 'borrower', 'overdue'));
    }

    // Search for books
    public function search(Request $request)
    {
        $query = $request->input('q');
        
        if ($query) {
            $books = Book::where('title', 'like', "%{$query}%")
                ->orWhere('author', 'like', "%{$query}%")
                ->orWhere('isbn', 'like', "%{$query}%")
                ->where('available_copies', '>', 0)
                ->with('category')
                ->paginate(12);
        } else {
            // Return all available books if no search query
            $books = Book::where('available_copies', '>', 0)
                ->with('category')
                ->paginate(12);
        }

        return view('user.search', compact('books', 'query'));
    }

    // Browse all available books
    public function browse()
    {
        $books = Book::where('available_copies', '>', 0)
            ->with('category')
            ->paginate(12);

        return view('user.browse', compact('books'));
    }

    // View book details
    public function bookDetail(Book $book)
    {
        return view('user.book-detail', compact('book'));
    }

    // Request to borrow a book
    public function requestBorrow(Request $request)
    {
        $user = Auth::user();
        $borrower = Borrower::where('user_id', $user->id)->first();

        if (!$borrower) {
            return back()->with('error', 'Please register as a borrower first.');
        }

        if ($borrower->status !== 'active') {
            return back()->with('error', 'Your borrower account is not active.');
        }

        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        $book = Book::find($validated['book_id']);

        if ($book->available_copies <= 0) {
            return back()->with('error', 'This book is not available right now.');
        }

        // Check if user already has this book borrowed
        $exists = BookTransaction::where('borrower_id', $borrower->id)
            ->where('book_id', $book->id)
            ->where('status', 'borrowed')
            ->exists();

        if ($exists) {
            return back()->with('error', 'You already have this book borrowed.');
        }

        $dueDate = Carbon::now()->addDays(14); // 14-day borrow period

        $transaction = BookTransaction::create([
            'borrower_id' => $borrower->id,
            'book_id' => $book->id,
            'borrow_date' => Carbon::now()->toDateString(),
            'due_date' => $dueDate->toDateString(),
            'status' => 'borrowed',
        ]);

        // Decrease available copies
        $book->update([
            'available_copies' => $book->available_copies - 1,
        ]);

        // Log activity
        ActivityLog::create([
            'user_id' => $user->id,
            'action' => 'borrow',
            'description' => "{$user->name} borrowed '{$book->title}'",
            'model_type' => 'BookTransaction',
            'model_id' => $transaction->id,
        ]);

        return back()->with('success', 'Book borrowed successfully! Due date: ' . $dueDate->format('M d, Y'));
    }

    // Return a borrowed book
    public function returnBook(Request $request, BookTransaction $transaction)
    {
        $user = Auth::user();
        $borrower = Borrower::where('user_id', $user->id)->first();

        if (!$borrower || $transaction->borrower_id !== $borrower->id) {
            return back()->with('error', 'You cannot return this book.');
        }

        $returnDate = Carbon::now()->toDateString();

        // Calculate fine if overdue
        $dueDate = Carbon::parse($transaction->due_date);
        $currentDate = Carbon::now();
        $fineAmount = 0;

        if ($currentDate->isAfter($dueDate)) {
            $daysOverdue = $currentDate->diffInDays($dueDate);
            $fineAmount = $daysOverdue * 10; // ₱10 per day
        }

        $transaction->update([
            'return_date' => $returnDate,
            'status' => 'returned',
            'fine_amount' => $fineAmount,
        ]);

        // Increase available copies
        $book = $transaction->book;
        $book->update([
            'available_copies' => $book->available_copies + 1,
        ]);

        // Log activity
        ActivityLog::create([
            'user_id' => $user->id,
            'action' => 'return',
            'description' => "{$user->name} returned '{$book->title}'",
            'model_type' => 'BookTransaction',
            'model_id' => $transaction->id,
        ]);

        $message = 'Book returned successfully!';
        if ($fineAmount > 0) {
            $message .= " Fine: ₱{$fineAmount}";
        }

        return back()->with('success', $message);
    }

    // View user profile
    public function profile()
    {
        $user = Auth::user();
        $borrower = Borrower::where('user_id', $user->id)->first();

        return view('user.profile', compact('user', 'borrower'));
    }

    // View borrowing history
    public function history()
    {
        $user = Auth::user();
        $borrower = Borrower::where('user_id', $user->id)->first();

        if (!$borrower) {
            return back()->with('error', 'Please register as a borrower first.');
        }

        $history = BookTransaction::where('borrower_id', $borrower->id)
            ->with('book')
            ->latest('created_at')
            ->paginate(20);

        return view('user.history', compact('history'));
    }
}
