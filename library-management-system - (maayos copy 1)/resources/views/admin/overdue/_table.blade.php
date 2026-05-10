<div class="overflow-x-auto">
    <table class="w-full">
        <thead>
            <tr class="border-b border-gray-200 bg-gray-50">
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Borrower</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Book</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Borrow Date</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Due Date</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Days Overdue</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Fine Amount</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($overdueBooks as $transaction)
                <tr class="border-b border-gray-100">
                    <td class="px-6 py-4">{{ $transaction->borrower->user->name }}</td>
                    <td class="px-6 py-4">{{ $transaction->book->title }}</td>
                    <td class="px-6 py-4">{{ $transaction->borrow_date->format('M d, Y') }}</td>
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
                    <td class="space-x-2 px-6 py-4">
                        <form method="POST" action="{{ route('admin.return-book', $transaction) }}" class="inline">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="return_date" value="{{ date('Y-m-d') }}">
                            <button type="submit" class="text-blue-600 hover:text-blue-800" onclick="return confirm('Mark as returned?')">Return</button>
                        </form>
                        @if ($transaction->fine_amount > 0 && !$transaction->fine_paid)
                            <form method="POST" action="{{ route('admin.mark-fine-paid', $transaction) }}" class="inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="text-green-600 hover:text-green-800" onclick="return confirm('Mark fine as paid?')">Mark Paid</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">No overdue books</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="border-t border-gray-200 px-6 py-4">
    {{ $overdueBooks->links() }}
</div>
