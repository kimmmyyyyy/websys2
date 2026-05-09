@extends('layouts.app')

@section('title', 'Borrower Statistics')

@section('content')
<div class="space-y-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Borrower Statistics</h1>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
        <div class="rounded-lg bg-white p-6 shadow">
            <p class="text-sm text-gray-600">Total Borrowers</p>
            <p class="text-3xl font-bold text-gray-900">{{ $stats['total_borrowers'] }}</p>
        </div>

        <div class="rounded-lg bg-white p-6 shadow">
            <p class="text-sm text-gray-600">Active Borrowers</p>
            <p class="text-3xl font-bold text-green-600">{{ $stats['active_borrowers'] }}</p>
        </div>

        <div class="rounded-lg bg-white p-6 shadow">
            <p class="text-sm text-gray-600">Suspended</p>
            <p class="text-3xl font-bold text-red-600">{{ $stats['suspended_borrowers'] }}</p>
        </div>

        <div class="rounded-lg bg-white p-6 shadow">
            <p class="text-sm text-gray-600">Total Borrowed</p>
            <p class="text-3xl font-bold text-blue-600">{{ $stats['total_books_borrowed'] }}</p>
        </div>

        <div class="rounded-lg bg-white p-6 shadow">
            <p class="text-sm text-gray-600">Currently Borrowed</p>
            <p class="text-3xl font-bold text-yellow-600">{{ $stats['currently_borrowed'] }}</p>
        </div>

        <div class="rounded-lg bg-white p-6 shadow">
            <p class="text-sm text-gray-600">Overdue Books</p>
            <p class="text-3xl font-bold text-red-600">{{ $stats['overdue_books'] }}</p>
        </div>
    </div>

    <!-- Borrowers Table -->
    <div class="rounded-lg bg-white shadow">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200 bg-gray-50">
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Name</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Membership ID</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Status</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Total Borrowed</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Active Loans</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($borrowers as $borrower)
                        <tr class="border-b border-gray-100">
                            <td class="px-6 py-4">{{ $borrower->user->name }}</td>
                            <td class="px-6 py-4 font-mono text-sm">{{ $borrower->membership_id }}</td>
                            <td class="px-6 py-4">
                                @if ($borrower->status === 'active')
                                    <span class="inline-block rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-800">Active</span>
                                @elseif ($borrower->status === 'suspended')
                                    <span class="inline-block rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-800">Suspended</span>
                                @else
                                    <span class="inline-block rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-800">Inactive</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-semibold">{{ count($borrower->transactions) }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="rounded-full bg-blue-100 px-3 py-1 text-sm font-semibold text-blue-800">
                                    {{ $borrower->transactions->where('status', 'borrowed')->count() }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">No borrowers</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="border-t border-gray-200 px-6 py-4">
            {{ $borrowers->links() }}
        </div>
    </div>
</div>
@endsection
