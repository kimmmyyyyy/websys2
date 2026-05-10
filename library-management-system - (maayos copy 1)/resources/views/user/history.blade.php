@extends('layouts.app')

@section('title', 'Borrowing History')

@section('content')
<div class="space-y-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Borrowing History</h1>
    </div>

    <!-- Back to Dashboard -->
    <a href="{{ route('user.dashboard') }}" class="inline-block bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">
        ← Back to Dashboard
    </a>

    <!-- History Table -->
    @if ($history->count() > 0)
        <div class="rounded-lg bg-white shadow-md border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Book Title</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Author</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Borrowed Date</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Due Date</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Return Date</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Fine</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($history as $transaction)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $transaction->book->title }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $transaction->book->author }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ \Carbon\Carbon::parse($transaction->borrow_date)->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ \Carbon\Carbon::parse($transaction->due_date)->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $transaction->return_date ? \Carbon\Carbon::parse($transaction->return_date)->format('M d, Y') : 'Still Borrowed' }}
                                </td>
                                <td class="px-6 py-4 text-sm font-medium">
                                    @if ($transaction->fine_amount > 0)
                                        <span class="text-red-600">₱{{ number_format($transaction->fine_amount, 2) }}</span>
                                    @else
                                        <span class="text-gray-600">—</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="inline-block rounded-full px-3 py-1 text-xs font-semibold
                                        @if ($transaction->status === 'borrowed')
                                            bg-blue-100 text-blue-800
                                        @elseif ($transaction->status === 'returned')
                                            bg-green-100 text-green-800
                                        @else
                                            bg-red-100 text-red-800
                                        @endif
                                    ">
                                        {{ ucfirst($transaction->status) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="border-t border-gray-200 px-6 py-4 bg-gray-50">
                {{ $history->links() }}
            </div>
        </div>
    @else
        <div class="rounded-lg bg-blue-50 p-6 border border-blue-200 text-center">
            <p class="text-blue-800">No borrowing history yet. Start by borrowing a book!</p>
            <a href="{{ route('books.search') }}" class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Browse Books
            </a>
        </div>
    @endif
</div>
@endsection
