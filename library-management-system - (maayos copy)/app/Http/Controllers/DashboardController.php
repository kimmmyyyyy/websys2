<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrower;
use App\Models\BookTransaction;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function adminDashboard(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | DATE FILTER
        |--------------------------------------------------------------------------
        */

        $date = $request->date
            ? Carbon::parse($request->date)
            : Carbon::today();

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD STATS
        |--------------------------------------------------------------------------
        */

        $stats = [

            'total_books' => Book::count(),

            'total_borrowers' => Borrower::count(),

            'total_borrowed_books' => BookTransaction::whereDate('borrow_date', $date)
                ->count(),

            'overdue_books' => BookTransaction::whereDate('due_date', '<', $date)
                ->where('status', 'borrowed')
                ->count(),
        ];

        /*
        |--------------------------------------------------------------------------
        | GRAPH DATA (LAST 7 DAYS FROM SELECTED DATE)
        |--------------------------------------------------------------------------
        */

        $labels = [];
        $borrowedData = [];
        $returnedData = [];
        $overdueData = [];

        for ($i = 6; $i >= 0; $i--) {

            $day = $date->copy()->subDays($i);

            $labels[] = $day->format('M d');

            // Borrowed
            $borrowedData[] = BookTransaction::whereDate('borrow_date', $day)
                ->count();

            // Returned
            $returnedData[] = BookTransaction::whereDate('return_date', $day)
                ->count();

            // Overdue
            $overdueData[] = BookTransaction::whereDate('due_date', '<', $day)
                ->where('status', 'borrowed')
                ->count();
        }

        $chartData = [
            'labels' => $labels,
            'borrowed' => $borrowedData,
            'returned' => $returnedData,
            'overdue' => $overdueData,
        ];

        /*
        |--------------------------------------------------------------------------
        | RECENT TRANSACTIONS (FILTERED BY DATE)
        |--------------------------------------------------------------------------
        */

       $recentTransactionsQuery = BookTransaction::with(['borrower.user', 'book']);

if (!$request->has('all')) {

    $recentTransactionsQuery->whereDate('borrow_date', $date)
        ->take(10);

}

$recentTransactions = $recentTransactionsQuery
    ->latest()
    ->get();

        return view('admin.dashboard', compact(
            'stats',
            'recentTransactions',
            'chartData',
            'date'
        ));
    }
}