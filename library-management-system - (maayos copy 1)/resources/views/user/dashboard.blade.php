@extends('layouts.app')

@section('title', 'My Library Dashboard')

@section('content')
<div class="space-y-8">

    <div>
        <h1 class="text-3xl font-bold text-gray-900">My Library Dashboard</h1>
        <p class="mt-2 text-gray-600">Welcome, {{ auth()->user()->name }}</p>
    </div>

    @if (!$borrower)

        <div class="rounded-lg bg-blue-50 p-6 border border-blue-200">
            <p class="text-sm text-blue-800">
                You haven't been registered as a borrower yet. Please contact the library administrator to get registered.
            </p>
        </div>

    @else

    <!-- QUICK STATS -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

        <div class="rounded-lg bg-blue-50 p-4 border border-blue-200">
            <p class="text-sm text-blue-600 font-medium">Currently Borrowed</p>
            <p class="mt-1 text-2xl font-bold text-blue-900">{{ $borrowedBooks->count() }}</p>
        </div>

        <div class="rounded-lg bg-red-50 p-4 border border-red-200">
            <p class="text-sm text-red-600 font-medium">Overdue</p>
            <p class="mt-1 text-2xl font-bold text-red-900">{{ $overdue }}</p>
        </div>

        <div class="rounded-lg bg-green-50 p-4 border border-green-200">
            <p class="text-sm text-green-600 font-medium">Member Since</p>
            <p class="mt-1 text-lg font-bold text-green-900">
                {{ $borrower->created_at->format('M Y') }}
            </p>
        </div>

        <div class="rounded-lg bg-purple-50 p-4 border border-purple-200">
            <p class="text-sm text-purple-600 font-medium">ID</p>
            <p class="mt-1 text-lg font-bold text-purple-900">
                {{ $borrower->membership_id }}
            </p>
        </div>

    </div>

    <!-- 🔴 OVERDUE SECTION -->
    <div class="rounded-lg bg-white shadow border border-gray-200 p-6">

        <h2 class="text-lg font-semibold text-gray-900 mb-4">
            Overdue Books
        </h2>

        @if ($overdueBooks->count() > 0)

            <div class="overflow-x-auto">
                <table class="w-full text-sm">

                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left font-semibold text-gray-700">Book</th>
                            <th class="px-4 py-2 text-left font-semibold text-gray-700">Due Date</th>
                            <th class="px-4 py-2 text-left font-semibold text-gray-700">Days Late</th>
                            <th class="px-4 py-2 text-left font-semibold text-gray-700">Status</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">

                        @foreach ($overdueBooks as $transaction)

                            @php
                                $dueDate = \Carbon\Carbon::parse($transaction->due_date);
                                $daysLate = $dueDate->diffInDays(now('Asia/Manila'));
                            @endphp

                            <tr class="hover:bg-gray-50">

                                <td class="px-4 py-3 font-medium text-gray-900">
                                    {{ $transaction->book->title }}
                                </td>

                                <td class="px-4 py-3 text-gray-600">
                                    {{ $dueDate->format('M d, Y') }}
                                </td>

                                <td class="px-4 py-3 text-red-600 font-semibold">
                                    {{ $daysLate }} days late
                                </td>

                                <td class="px-4 py-3">
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                        Overdue
                                    </span>
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>
            </div>

        @else

            <p class="text-gray-500 text-sm">No overdue books 🎉</p>

        @endif

    </div>

    <!-- CURRENT BORROWED BOOKS -->
    <div class="rounded-lg bg-white p-6 shadow">

        <h2 class="mb-4 text-lg font-semibold text-gray-900">
            Currently Borrowed Books
        </h2>

        @if ($borrowedBooks->count() > 0)

            <div class="overflow-x-auto">
                <table class="w-full text-sm">

                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="px-4 py-2 text-left font-medium text-gray-700">Book Title</th>
                            <th class="px-4 py-2 text-left font-medium text-gray-700">Borrow Date</th>
                            <th class="px-4 py-2 text-left font-medium text-gray-700">Due Date</th>
                            <th class="px-4 py-2 text-left font-medium text-gray-700">Days Left</th>
                            <th class="px-4 py-2 text-left font-medium text-gray-700">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($borrowedBooks as $transaction)

                            <tr class="border-b border-gray-100 hover:bg-gray-50">

                                <td class="px-4 py-3">
                                    {{ $transaction->book->title }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ \Carbon\Carbon::parse($transaction->borrow_date)->format('M d, Y') }}
                                    <div class="text-xs text-slate-400">
    @if(!empty($transaction->borrow_time))
        {{ \Carbon\Carbon::parse($transaction->borrow_time)->format('h:i A') }}
    @endif
</div>
                                </td>

                                <td class="px-4 py-3">
                                    {{ \Carbon\Carbon::parse($transaction->due_date)->format('M d, Y') }}
                                    <div class="text-xs text-slate-400">
    @if(!empty($transaction->due_date))
        {{ \Carbon\Carbon::parse($transaction->due_date)->format('h:i A') }}
    @endif
            </div>
                                </td>

                                <td class="px-4 py-3">

                                    @php
                                        $dueDate = \Carbon\Carbon::parse($transaction->due_date)->startOfDay();
                                        $today = now()->startOfDay();
                                        $daysLeft = $today->diffInDays($dueDate, false);
                                    @endphp

                                    <span class="font-semibold
                                        @if ($daysLeft < 0) text-red-600
                                        @elseif ($daysLeft <= 2) text-orange-600
                                        @else text-green-600 @endif">

                                        @if ($daysLeft < 0)
                                            {{ abs($daysLeft) }} days overdue
                                        @elseif ($daysLeft == 0)
                                            Due today
                                        @elseif ($daysLeft <= 2)
                                            {{ $daysLeft }} days left (Due soon)
                                        @else
                                            {{ $daysLeft }} days left
                                        @endif

                                    </span>

                                </td>

                                <td class="px-4 py-3">
                                    <form method="POST" action="{{ route('book.return', $transaction->id) }}">
                                        @csrf
                                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-xs">
                                            Return
                                        </button>
                                    </form>
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>
            </div>

        @else
            <p class="text-gray-500 py-4 text-center">No books currently borrowed</p>
        @endif

    </div>

    <!-- BORROWING HISTORY -->
    <div class="rounded-lg bg-white p-6 shadow">

        <h2 class="mb-4 text-lg font-semibold text-gray-900">
            Borrowing History
        </h2>

        @if ($borrowingHistory->count() > 0)

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="px-4 py-2 text-left">Book Title</th>
                            <th class="px-4 py-2 text-left">Borrow Date</th>
                            <th class="px-4 py-2 text-left">Due Date</th>
                            <th class="px-4 py-2 text-left">Return Date</th>
                            <th class="px-4 py-2 text-left">Fine</th>
                            <th class="px-4 py-2 text-left">Status</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($borrowingHistory as $transaction)

                            <tr class="border-b">

                                <td class="px-4 py-3">
                                    {{ $transaction->book->title }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ \Carbon\Carbon::parse($transaction->borrow_date)->format('M d, Y') }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ \Carbon\Carbon::parse($transaction->due_date)->format('M d, Y') }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ $transaction->return_date
                                        ? \Carbon\Carbon::parse($transaction->return_date)->format('M d, Y')
                                        : '—' }}
                                </td>

                                <td class="px-4 py-3">
                                    @php
                                        $fine = $transaction->fine_amount ?? 0;
                                        if (empty($fine)) {
                                            $fine = $transaction->calculateFine();
                                        }
                                    @endphp

                                    @if ($fine > 0)
                                        <span class="text-red-600 font-semibold">
                                            ₱{{ number_format($fine, 2) }}
                                        </span>
                                    @else
                                        <span class="text-gray-500">—</span>
                                    @endif
                                </td>

                                <td class="px-4 py-3">
                                    <span class="px-3 py-1 rounded text-xs font-semibold
                                        @if ($transaction->status === 'borrowed')
                                            bg-blue-100 text-blue-800
                                        @elseif ($transaction->status === 'returned')
                                            bg-green-100 text-green-800
                                        @else
                                            bg-red-100 text-red-800
                                        @endif">
                                        {{ ucfirst($transaction->status) }}
                                    </span>
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>
            </div>

            @if ($borrowingHistory->total() > 10)
                <div class="mt-4">
                    {{ $borrowingHistory->links() }}
                </div>
            @endif

        @else
            <p class="text-gray-500 py-4 text-center">No borrowing history</p>
        @endif

    </div>

    @endif
</div>
@endsection