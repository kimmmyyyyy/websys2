<?php

namespace App\Http\Controllers;

use App\Models\BookTransaction;
use App\Models\Book;
use App\Models\Borrower;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookTransactionController extends Controller
{
    // =========================
    // BORROW BOOK
    // =========================
    public function borrowBook(Request $request)
    {
        $validated = $request->validate([
            'borrower_id' => 'required|exists:borrowers,id',
            'book_id' => 'required|exists:books,id',
            'due_date' => 'required|date|after:today',
        ]);

        $borrower = Borrower::findOrFail($validated['borrower_id']);

        if ($borrower->status !== 'active') {
            return back()->with('error', 'Borrower account is not active.');
        }

        $book = Book::findOrFail($validated['book_id']);

        if ($book->available_copies <= 0) {
            return back()->with('error', 'Book is not available.');
        }

            $transaction = BookTransaction::create([
                'borrower_id' => $validated['borrower_id'],
                'book_id' => $validated['book_id'],
                'borrow_date' => Carbon::now('Asia/Manila'),
                'borrow_time' => Carbon::now('Asia/Manila')->toTimeString(),
                'due_date' => Carbon::parse($validated['due_date'])->setTime(23, 59, 0),
                'status' => 'borrowed',
            ]);
    
        $book->decrement('available_copies');

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'borrow',
            'description' => "{$borrower->user->name} borrowed '{$book->title}'",
            'model_type' => 'BookTransaction',
            'model_id' => $transaction->id,
        ]);

        return back()->with('success', 'Book borrowed successfully.');
    }

    // =========================
    // RETURN BOOK
    // =========================
    public function returnBook(Request $request, BookTransaction $transaction)
    {
        $validated = $request->validate([
            'return_date' => 'required|date',
        ]);

        $returnDate = Carbon::parse($validated['return_date']);

        $transaction->update([
            'return_date' => $returnDate,
            'status' => 'returned',
        ]);

        $transaction->book->increment('available_copies');

        $fine = $transaction->calculateFine();

        if ($fine > 0) {
            $transaction->update([
                'fine_amount' => $fine,
            ]);
        }

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'return',
            'description' => "{$transaction->borrower->user->name} returned '{$transaction->book->title}'",
            'model_type' => 'BookTransaction',
            'model_id' => $transaction->id,
        ]);

        return back()->with('success', 'Book returned successfully.');
    }

    // =========================
    // OVERDUE LIST
    // =========================
    public function listOverdue(Request $request)
    {
        $overdueBooks = BookTransaction::with([
            'borrower.user',
            'book'
        ])
            ->whereNull('return_date')
            ->orderBy('due_date', 'asc')
            ->paginate(15);

        return view('admin.overdue.index', compact('overdueBooks'));
    }

    // =========================
    // MARK FINE AS PAID
    // =========================
    public function markFineAsPaid(BookTransaction $transaction)
    {
        $transaction->update([
            'fine_paid' => true,
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'fine_paid',
            'description' => "Fine marked as paid for transaction #{$transaction->id}",
            'model_type' => 'BookTransaction',
            'model_id' => $transaction->id,
        ]);

        return back()->with('success', 'Fine marked as paid.');
    }

    // =========================
    // UPDATE DUE DATE
    // =========================
    public function updateDueDate(Request $request, BookTransaction $transaction)
    {
        $request->validate([
            'due_date' => 'required|date|after:today',
        ]);

        $transaction->update([
            'due_date' => Carbon::parse($request->due_date)->setTime(23, 59, 0),
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'update_due_date',
            'description' => "Updated due date for transaction #{$transaction->id}",
            'model_type' => 'BookTransaction',
            'model_id' => $transaction->id,
        ]);

        return back()->with('success', 'Due date updated successfully.');
    }
}
