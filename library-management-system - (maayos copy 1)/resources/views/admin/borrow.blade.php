@extends('layouts.app')

@section('title', 'Borrow Book')

@section('content')
<div class="space-y-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Borrow Book</h1>
    </div>

    <div class="rounded-lg bg-white p-6 shadow">
        <form method="POST" action="{{ route('admin.borrow-book') }}" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <div>
                    <label for="borrower_id" class="block text-sm font-medium text-gray-700">Borrower</label>
                    <select name="borrower_id" id="borrower_id" required class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2">
                        <option value="">Select Borrower</option>
                        @foreach (\App\Models\Borrower::where('status', 'active')->with('user')->get() as $borrower)
                            <option value="{{ $borrower->id }}" {{ old('borrower_id') == $borrower->id ? 'selected' : '' }}>
                                {{ $borrower->user->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('borrower_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="book_id" class="block text-sm font-medium text-gray-700">Book</label>
                    <select name="book_id" id="book_id" required class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2">
                        <option value="">Select Book</option>
                        @foreach (\App\Models\Book::where('available_copies', '>', 0)->get() as $book)
                            <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }}>
                                {{ $book->title }} (Available: {{ $book->available_copies }})
                            </option>
                        @endforeach
                    </select>
                    @error('book_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="borrow_date" class="block text-sm font-medium text-gray-700">Borrow Date</label>
                    <input type="date" name="borrow_date" id="borrow_date" required class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2" value="{{ old('borrow_date', date('Y-m-d')) }}">
                    @error('borrow_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="due_date" class="block text-sm font-medium text-gray-700">Due Date</label>
                    <input type="date" name="due_date" id="due_date" required class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2" value="{{ old('due_date', date('Y-m-d', strtotime('+14 days'))) }}">
                    @error('due_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="rounded-md bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
                    Borrow Book
                </button>
                <a href="{{ route('admin.dashboard') }}" class="rounded-md border border-gray-300 px-4 py-2 text-gray-700 hover:bg-gray-50">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
