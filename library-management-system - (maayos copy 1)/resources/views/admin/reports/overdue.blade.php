@extends('layouts.app')

@section('title', 'Overdue Report')

@section('content')
<div class="space-y-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Overdue Report</h1>
    </div>

    <div class="rounded-lg bg-white p-6 shadow">
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <div>
                <p class="text-sm text-gray-600">Total Overdue Books</p>
                <p class="text-3xl font-bold text-red-600">{{ count($overdueTransactions) }}</p>
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
            {{ $overdueTransactions->links() }}
        </div>
    </div>
</div>
@endsection
