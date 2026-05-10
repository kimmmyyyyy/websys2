@extends('layouts.app')

@section('title', 'Overdue Report')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Overdue Report</h1>
        </div>

        <!-- DATE FILTER -->
        <form method="GET" class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-white p-3 shadow-sm">

            <input
                type="date"
                name="date"
                value="{{ request('date') }}"
                class="rounded-xl border-slate-200 bg-slate-50 text-sm shadow-sm focus:border-cyan-500 focus:ring-cyan-500"
            >

            <button
                type="submit"
                class="rounded-xl bg-slate-900 px-5 py-2 text-sm font-medium text-white transition hover:bg-slate-800"
            >
                Filter
            </button>

            <a href="{{ route('admin.reports.overdue', ['all' => 1]) }}"
               class="rounded-xl bg-cyan-600 px-5 py-2 text-sm font-medium text-white transition hover:bg-cyan-700">
                View All
            </a>

        </form>
    </div>

    <div class="rounded-lg bg-white p-6 shadow">
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <div>
                <p class="text-sm text-gray-600">Total Overdue Books</p>
                <p class="text-3xl font-bold text-red-600">{{ $overdueTransactions->total() }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Total Pending Fines</p>
                <p class="text-3xl font-bold text-red-600">₱{{ number_format($totalPendingFines, 2) }}</p>
            </div>
        </div>
    </div>

    <div class="rounded-lg bg-white shadow">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200 bg-gray-50">
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Borrower</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Book</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Due Date</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Days Overdue</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Fine Penalty</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($overdueTransactions as $transaction)
                        <tr class="border-b border-gray-100">
                            <td class="px-6 py-4">{{ $transaction->borrower->user->name }}</td>
                            <td class="px-6 py-4">{{ $transaction->book->title }}</td>
                            <td class="px-6 py-4">
                                <span class="font-semibold text-red-600">{{ $transaction->due_date->format('M d, Y') }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="rounded-full bg-red-100 px-3 py-1 text-sm font-semibold text-red-800">
                                    {{ $transaction->due_date->diffInDays() }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-lg font-bold text-red-600">₱{{ number_format($transaction->calculateFine(), 2) }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">No overdue books</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="border-t border-gray-200 px-6 py-4">
            {{ $overdueTransactions->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection
