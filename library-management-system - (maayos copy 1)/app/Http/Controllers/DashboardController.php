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
        | AUTO UPDATE OVERDUE STATUS
        |--------------------------------------------------------------------------
        */

      BookTransaction::where('status', 'borrowed')
    ->whereNotNull('due_date')
    ->where('due_date', '<', now())
    ->update([
        'status' => 'overdue'
    ]);

        /*
        |--------------------------------------------------------------------------
        | DATE FILTER
        |--------------------------------------------------------------------------
        */

        $date = $request->date
            ? Carbon::parse($request->date)
            : Carbon::today();

        // ✅ ADDED SAFETY FLAGS (DO NOT REMOVE ORIGINAL LOGIC)
        $viewAll = $request->has('all');
        $isFiltered = !$viewAll && $request->date;
        $isFuture = Carbon::parse($date)->isFuture();

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD STATS
        |--------------------------------------------------------------------------
        */

        // $stats = [

        //     'total_books' => Book::count(),

        //     'total_borrowers' => Borrower::count(),

        //     'total_borrowed_books' => BookTransaction::where('status', 'borrowed')
        //         ->count(),

            // 'overdue_books' => BookTransaction::where('status', 'borrowed')
            //     ->whereNotNull('due_date')
            //     ->whereDate('due_date', '<', now())
            //     ->count(),

    //         'overdue_books'=> BookTransaction::where(function ($query) {
    //     $query->where('status', 'borrowed')
    //           ->orWhere('status', 'overdue');
    // })
    // ->whereNotNull('due_date')
    // ->whereDate('borrow_date', $date)
    // ->when(!$viewAll, function ($query) {
    //     $query->whereDate('due_date', today());
    // })
    // ->when($viewAll, function ($query) {
    //     $query->whereDate('due_date', '<=', today());
    // })
    // ->count()
    //     ];

    $stats = [

    'total_books' => Book::count(),

    'total_borrowers' => Borrower::count(),

    'total_borrowed_books' => BookTransaction::where('status', 'borrowed')
        ->count(),

    'overdue_books' => BookTransaction::where(function ($query) {
            $query->where('status', 'borrowed')
                  ->orWhere('status', 'overdue');
        })
        ->whereNotNull('due_date')
        ->when(!$viewAll, function ($query) {
            // TODAY ONLY
            $query->whereDate('due_date', today());
        })
        ->when($viewAll, function ($query) {
            // VIEW ALL OVERDUE
            $query->whereDate('due_date', '<=', today());
        })
        ->count(),
];

        /*
        |----------------------------------------------------------------------
        | APPLY FILTER ONLY IF VALID (PREVENT EMPTY FUTURE DATA ISSUE)
        |----------------------------------------------------------------------
        */

        if ($isFiltered && !$isFuture) {

            $stats['total_books'] = Book::whereDate('created_at', $date)->count();

            $stats['total_borrowers'] = Borrower::whereDate('created_at', $date)->count();

            $stats['total_borrowed_books'] = BookTransaction::where('status', 'borrowed')
                ->whereDate('borrow_date', $date)
                ->count();

            $stats['overdue_books'] = BookTransaction::where('status', 'borrowed')
                ->whereNotNull('due_date')
                ->whereDate('due_date', '<', now())
                ->whereDate('borrow_date', $date)
                ->count();
        }

        /*
        |--------------------------------------------------------------------------
        | GRAPH DATA
        |--------------------------------------------------------------------------
        */

        $labels = [];
        $borrowedData = [];
        $returnedData = [];
        $overdueData = [];

//         for ($i = 6; $i >= 0; $i--) {

//     $day = $date->copy()->subDays($i);

//     $labels[] = $day->format('M d');

//     $borrowedData[] = BookTransaction::whereDate('borrow_date', $day)
//         ->count();

//     $returnedData[] = BookTransaction::whereDate('return_date', $day)
//         ->count();

//     $overdueData[] = BookTransaction::whereDate('due_date', $day)
//         ->where(function ($query) {
//             $query->where('status', 'overdue')
//                   ->orWhere('status', 'borrowed');
//         })
//         ->count();
// }

for ($i = 6; $i >= 0; $i--) {

    $day = $date->copy()->subDays($i);

    $labels[] = $day->format('M d');

    $borrowedData[] = BookTransaction::whereDate('borrow_date', $day)
        ->count();

    $returnedData[] = BookTransaction::whereDate('return_date', $day)
        ->count();

    // ✅ FIXED OVERDUE LOGIC
    $overdueData[] = BookTransaction::where(function ($query) {
            $query->where('status', 'borrowed')
                  ->orWhere('status', 'overdue');
        })
        ->whereDate('due_date', '<', $day)
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
        | RECENT TRANSACTIONS
        |--------------------------------------------------------------------------
        */

        $recentTransactionsQuery = BookTransaction::with([
            'borrower.user',
            'book'
        ]);

        /*
        |--------------------------------------------------------------------------
        | FILTER TRANSACTIONS (SAFE FIX)
        |--------------------------------------------------------------------------
        */

        if (!$viewAll && !$isFuture) {
            $recentTransactionsQuery->whereDate('borrow_date', $date);
        }

        /*
        |--------------------------------------------------------------------------
        | GET TRANSACTIONS
        |--------------------------------------------------------------------------
        */

        $recentTransactions = $recentTransactionsQuery
            ->latest()
            ->take(10)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

        return view('admin.dashboard', compact(
            'stats',
            'recentTransactions',
            'chartData',
            'date'
        ));
    }
}