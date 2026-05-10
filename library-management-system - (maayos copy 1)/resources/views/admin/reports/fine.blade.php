@extends('layouts.app')

@section('title', 'Fine Report')

@section('content')
<div class="space-y-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Fine Report</h1>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
        <div class="rounded-lg bg-white p-6 shadow">
            <p class="text-sm text-gray-600">Total Fines</p>
            <p class="text-3xl font-bold text-gray-900">₱{{ number_format($totalFines, 2) }}</p>
        </div>

        <div class="rounded-lg bg-white p-6 shadow">
            <p class="text-sm text-gray-600">Fines Paid</p>
            <p class="text-3xl font-bold text-green-600">₱{{ number_format($totalPaidFines, 2) }}</p>
        </div>

        <div class="rounded-lg bg-white p-6 shadow">
            <p class="text-sm text-gray-600">Pending Fines</p>
            <p class="text-3xl font-bold text-red-600">₱{{ number_format($totalPendingFines, 2) }}</p>
        </div>
    </div>

    <!-- Fines Table -->
    <div class="rounded-lg bg-white shadow">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200 bg-gray-50">
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Borrower</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Book</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Due Date</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Fine Amount</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $transaction)
                        <tr class="border-b border-gray-100">
                            <td class="px-6 py-4">{{ $transaction->borrower->user->name }}</td>
                            <td class="px-6 py-4">{{ $transaction->book->title }}</td>
                            <td class="px-6 py-4">{{ $transaction->due_date->format('M d, Y') }}</td>
                            <td class="px-6 py-4">
                                <span class="font-bold text-red-600">₱{{ number_format($transaction->fine_amount, 2) }}</span>
                            </td>
                            <td class="px-6 py-4">
                                @if ($transaction->fine_paid)
                                    <span class="inline-block rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-800">Paid</span>
                                @else
                                    <span class="inline-block rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-800">Pending</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">No fines</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="border-t border-gray-200 px-6 py-4">
            {{ $transactions->links() }}
        </div>
    </div>
</div>
@endsection
