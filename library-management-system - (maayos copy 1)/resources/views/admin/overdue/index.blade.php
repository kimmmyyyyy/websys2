@extends('layouts.app')

@section('title', 'Overdue Books')

@section('content')
<div class="space-y-6">

    <!-- PAGE TITLE -->
    <div>
        <h1 class="text-3xl font-bold text-gray-900">
            Overdue Books
        </h1>
    </div>

    <!-- TABLE CONTAINER -->
    <div class="bg-white rounded-xl shadow overflow-hidden">

        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-gray-200">

                <!-- TABLE HEADER -->
                <thead class="bg-gray-50">
                    <tr>

                        <th scope="col"
                            class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wide">
                            Borrower
                        </th>

                        <th scope="col"
                            class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wide">
                            Book
                        </th>

                        <th scope="col"
                            class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wide">
                            Borrow Date
                        </th>

                        <th scope="col"
                            class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wide">
                            Due Date
                        </th>

                        <th scope="col"
                            class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wide">
                            Days Overdue
                        </th>

                        <th scope="col"
                            class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wide">
                            Fine Amount
                        </th>

                        <th scope="col"
                            class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wide">
                            Manage Due Date
                        </th>

                        <th scope="col"
                            class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wide">
                            Actions
                        </th>

                    </tr>
                </thead>

                <!-- TABLE BODY -->
                <tbody class="divide-y divide-gray-100 bg-white">

                    @forelse ($overdueBooks as $transaction)

                    <tr class="hover:bg-gray-50 transition">

                        <!-- BORROWER -->
                        <td class="px-6 py-4 text-sm text-gray-800">
                            {{ $transaction->borrower->user->name ?? 'N/A' }}
                        </td>

                        <!-- BOOK -->
                        <td class="px-6 py-4 text-sm text-gray-800">
                            {{ $transaction->book->title ?? 'N/A' }}
                        </td>

                        <!-- BORROW DATE -->
                        <td class="px-6 py-4 text-sm text-gray-700">
                            {{ $transaction->borrow_date ? $transaction->borrow_date->format('M d, Y') : 'N/A' }}
                        </td>

                 

                        <!-- DUE DATE -->
                        <td class="px-6 py-4 text-sm font-semibold text-red-600">
                            {{ $transaction->due_date ? $transaction->due_date->format('M d, Y') : 'N/A' }}
                        </td>

                        <!-- DAYS OVERDUE -->
                        <!-- <td class="px-6 py-4 text-sm text-gray-700">
                            {{ $transaction->due_date ? $transaction->due_date->diffInDays(now()) : 0 }} day(s)
                        </td> -->
                           <!-- DAYS OVERDUE -->
<td class="px-6 py-4 text-sm text-gray-700">
    {{ $transaction->due_date ? abs((int) now()->diffInDays($transaction->due_date, false)) : 0 }} day(s)
</td>

                        <!-- FINE AMOUNT -->
                        <td class="px-6 py-4 text-sm font-bold text-red-600">
                            ₱{{ number_format($transaction->calculateFine(), 2) }}
                        </td>

                        <!-- UPDATE DUE DATE -->
                        <td class="px-6 py-4">

                            <form method="POST"
                                  action="{{ route('admin.update-due-date', $transaction) }}"
                                  class="flex items-center gap-2">

                                @csrf
                                @method('PUT')

                                <input type="date"
                                       name="due_date"
                                       value="{{ $transaction->due_date ? $transaction->due_date->format('Y-m-d') : '' }}"
                                       class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring focus:ring-blue-200">

                                <button type="submit"
                                        class="bg-gray-800 hover:bg-gray-900 text-white text-xs px-3 py-2 rounded-lg transition">
                                    Update
                                </button>

                            </form>

                        </td>

                        <!-- ACTIONS -->
                        <td class="px-6 py-4">

                            <div class="flex flex-col gap-2">

                                <!-- RETURN BOOK -->
                                <form method="POST"
                                      action="{{ route('admin.return-book', $transaction) }}">

                                    @csrf
                                    @method('PUT')

                                    <button type="submit"
                                            onclick="return confirm('Return this book?')"
                                            class="text-blue-600 hover:text-blue-800 hover:underline text-sm">
                                        Return Book
                                    </button>

                                </form>

                                <!-- MARK FINE PAID -->
                                @if(!$transaction->fine_paid && $transaction->fine_amount > 0)

                                <form method="POST"
                                      action="{{ route('admin.mark-fine-paid', $transaction) }}">

                                    @csrf
                                    @method('PUT')

                                    <button type="submit"
                                            class="text-green-600 hover:text-green-800 hover:underline text-sm">
                                        Mark Fine Paid
                                    </button>

                                </form>

                                @endif

                            </div>

                        </td>

                    </tr>

                    @empty

                    <!-- EMPTY STATE -->
                    <tr>
                        <td colspan="8"
                            class="px-6 py-10 text-center text-gray-500 text-sm">
                            No overdue books found.
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <!-- PAGINATION -->
        <div class="border-t border-gray-200 px-6 py-4 bg-gray-50">
            {{ $overdueBooks->links() }}
        </div>

    </div>

</div>
@endsection