<?php

namespace App\Http\Controllers;

use App\Models\BookTransaction;
use App\Models\Book;
use App\Models\Borrower;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function borrowingReport(Request $request)
    {
        // Default to view "All dates" when no specific date is provided
        $isAll = $request->has('all') || !$request->has('date');

        $query = BookTransaction::with(['borrower.user', 'book']);

        // FILTER LOGIC
        if (!$isAll) {

            $date = $request->date
                ? Carbon::parse($request->date)
                : Carbon::today();

            $query->whereDate('borrow_date', $date);
        }

        $transactions = $query
            ->orderByDesc('borrow_date')
            ->paginate(50);

        // CHART DATE LOGIC
        $chartDate = (!$isAll)
            ? ($request->date ? Carbon::parse($request->date) : Carbon::today())
            : null;

        $booksQuery = BookTransaction::selectRaw('book_id, COUNT(*) as total')
            ->groupBy('book_id')
            ->orderByDesc('total')
            ->with('book')
            ->take(10);

        if ($chartDate) {
            $booksQuery->whereDate('borrow_date', $chartDate);
        }

        $books = $booksQuery->get();

        $chartData = [
            'labels' => $books->map(fn ($b) => $b->book->title),
            'totals' => $books->map(fn ($b) => $b->total),
        ];

        return view('admin.reports.borrowing', compact(
            'transactions',
            'chartData'
        ));
    }

    public function exportBorrowingReport(Request $request)
    {
        $isAll = $request->has('all') || !$request->has('date');

        $query = BookTransaction::with(['borrower.user', 'book']);

        // SAME FILTER LOGIC AS REPORT
        $date = null;

        if (!$isAll) {
            $date = $request->date
                ? Carbon::parse($request->date)
                : Carbon::today();

            $query->whereDate('borrow_date', $date);
        }

        $transactions = $query
            ->orderByDesc('borrow_date')
            ->get();

        // CHART DATA FOR PDF
        $chartDate = (!$isAll)
            ? ($request->date ? Carbon::parse($request->date) : Carbon::today())
            : null;

        $booksQuery = BookTransaction::selectRaw('book_id, COUNT(*) as total')
            ->groupBy('book_id')
            ->orderByDesc('total')
            ->with('book')
            ->take(10);

        if ($chartDate) {
            $booksQuery->whereDate('borrow_date', $chartDate);
        }

        $books = $booksQuery->get();

       $pdf = Pdf::loadView('admin.reports.borrowing-pdf', [
    'transactions' => $transactions,
    'books' => $books,
    'date' => $date,
]);

        return $pdf->download('borrowing-report.pdf');
    }

    public function overdueReport(Request $request)
    {
        $isAll = $request->has('all') || !$request->has('date');

        $baseQuery = BookTransaction::with(['borrower.user', 'book'])
            ->whereNotNull('due_date')
            ->where(function ($q) {
                $q->where('status', 'borrowed')
                  ->orWhere('status', 'overdue');
            })
            ->whereDate('due_date', '<', Carbon::today());

        if (!$isAll) {
            $date = $request->date
                ? Carbon::parse($request->date)
                : Carbon::today();

            $baseQuery->whereDate('due_date', $date);
        }

        $overdueTransactions = (clone $baseQuery)
            ->orderByDesc('due_date')
            ->paginate(50);

        // compute total pending fines across all matching overdue transactions
        $allOverdue = (clone $baseQuery)->orderByDesc('due_date')->get();

        $totalPendingFines = $allOverdue->sum(fn ($t) => $t->calculateFine());

        return view('admin.reports.overdue', compact(
            'overdueTransactions',
            'totalPendingFines'
        ));
    }

    public function fineReport()
    {
        $transactions = BookTransaction::where('fine_amount', '>', 0)
            ->with(['borrower.user', 'book'])
            ->paginate(50);

        // Sum across all transactions with fines (not just the current page)
        $totalFines = BookTransaction::where('fine_amount', '>', 0)
            ->sum('fine_amount');

        $totalPaidFines = BookTransaction::where('fine_amount', '>', 0)
            ->where('fine_paid', true)
            ->sum('fine_amount');

        $totalPendingFines = $totalFines - $totalPaidFines;

        return view('admin.reports.fine', compact(
            'transactions',
            'totalFines',
            'totalPaidFines',
            'totalPendingFines'
        ));
    }

    public function activityLog()
    {
        $logs = ActivityLog::with('user')
            ->latest()
            ->paginate(50);

        return view('admin.reports.activity', compact('logs'));
    }

    public function borrowerStatistics()
    {
        $borrowers = Borrower::with(['user', 'transactions'])
            ->paginate(50);

        $stats = [
            'total_borrowers' => Borrower::count(),
            'active_borrowers' => Borrower::where('status', 'active')->count(),
            'suspended_borrowers' => Borrower::where('status', 'suspended')->count(),
            'total_books_borrowed' => BookTransaction::count(),
            'currently_borrowed' => BookTransaction::where('status', 'borrowed')->count(),
            'overdue_books' => BookTransaction::where('status', 'overdue')->count(),
        ];

        return view('admin.reports.borrower-statistics', compact(
            'borrowers',
            'stats'
        ));
    }
}