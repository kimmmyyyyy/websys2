@extends('layouts.app')

@section('title', 'Search Books')

@section('content')
<div class="space-y-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Search Books</h1>
    </div>

    <!-- Search Form -->
    <div class="rounded-lg bg-white p-6 shadow">
        <form method="GET" action="{{ route('books.search') }}" class="flex gap-4">
            <input 
                type="text" 
                name="q" 
                placeholder="Search by title, author, or ISBN..." 
                class="flex-1 rounded-md border border-gray-300 px-4 py-2"
                value="{{ request('q') }}"
            >
            <button type="submit" class="rounded-md bg-blue-600 px-6 py-2 text-white hover:bg-blue-700">
                Search
            </button>
        </form>
    </div>

    <!-- Search Results -->
    @if ($books->count() > 0)
        <div>
            <h2 class="text-lg font-semibold text-gray-900 mb-4">
                Found {{ $books->total() }} book{{ $books->total() !== 1 ? 's' : '' }}
                @if ($query)
                    for "{{ $query }}"
                @endif
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($books as $book)
                    <div class="rounded-lg bg-white p-6 shadow-md border border-gray-200 hover:shadow-lg transition flex flex-col">
                        <h3 class="text-lg font-bold text-gray-900 line-clamp-2">{{ $book->title }}</h3>
                        <p class="text-sm text-gray-600 mt-1">by {{ $book->author }}</p>
                        
                        <div class="mt-3 text-xs text-gray-500 space-y-1">
                            <p><strong>ISBN:</strong> {{ $book->isbn }}</p>
                            <p><strong>Category:</strong> {{ $book->category->name ?? 'N/A' }}</p>
                            <p><strong>Published:</strong> {{ $book->publication_year ?? 'N/A' }}</p>
                        </div>

                        <p class="mt-3 text-sm text-gray-700 line-clamp-3">{{ $book->description ?? 'No description available' }}</p>

                        <div class="mt-auto pt-4 border-t border-gray-200">
                            @if ($book->available_copies > 0)
                                <p class="text-sm font-medium text-green-600 mb-3">
                                    ✓ Available ({{ $book->available_copies }} copies)
                                </p>
                                <form method="POST" action="{{ route('book.request-borrow') }}" class="inline-block w-full">
                                    @csrf
                                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                                    <button type="submit" class="w-full rounded-md bg-blue-600 hover:bg-blue-700 text-white py-2 font-medium transition">
                                        Borrow This Book
                                    </button>
                                </form>
                            @else
                                <p class="text-sm font-medium text-red-600 mb-3">
                                    ✗ Currently Unavailable
                                </p>
                                <button disabled class="w-full rounded-md bg-gray-300 text-gray-600 py-2 font-medium cursor-not-allowed">
                                    Not Available
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $books->links() }}
            </div>
        </div>
    @elseif (request('q'))
        <div class="rounded-lg bg-yellow-50 p-6 border border-yellow-200 text-center">
            <p class="text-yellow-800">No books found for "{{ $query }}". Try a different search term.</p>
        </div>
    @else
        <div class="rounded-lg bg-blue-50 p-6 border border-blue-200 text-center">
            <p class="text-blue-800">Enter a search term or browse all available books</p>
        </div>
    @endif
</div>
@endsection
