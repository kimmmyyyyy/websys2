@extends('layouts.app')

@section('title', 'Books Management')

@section('content')
<div class="space-y-8">

    <!-- HEADER -->
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

        <div>
            <h1 class="text-4xl font-bold tracking-tight text-slate-900">
                Library Books
            </h1>
          
        </div>

        <a href="{{ route('admin.books.create') }}"
           class="inline-flex items-center gap-2 rounded-2xl bg-slate-900 px-5 py-3 text-sm font-medium text-white shadow-sm transition hover:bg-slate-800">
            + Add Book
        </a>

    </div>

    <!-- FILTER TOOLBAR -->
    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">

        <form method="GET"
              action="{{ route('admin.books.index') }}"
              class="grid gap-5 md:grid-cols-4">

            <!-- SEARCH -->
            <div class="md:col-span-2">
                <label class="text-sm font-medium text-slate-700">Search</label>

                <input type="text"
                       name="q"
                       value="{{ request('q') }}"
                       placeholder="Search title, author, ISBN..."
                       class="mt-2 w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm shadow-sm focus:border-cyan-500 focus:ring-4 focus:ring-cyan-100" />
            </div>

            <!-- CATEGORY -->
            <div>
                <label class="text-sm font-medium text-slate-700">Category</label>

                <select name="category_id"
                        class="mt-2 w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm shadow-sm focus:border-cyan-500 focus:ring-4 focus:ring-cyan-100">

                    <option value="">All Categories</option>

                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- STATUS -->
            <div>
                <label class="text-sm font-medium text-slate-700">Status</label>

                <select name="availability"
                        class="mt-2 w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm shadow-sm focus:border-cyan-500 focus:ring-4 focus:ring-cyan-100">

                    <option value="">All</option>
                    <option value="available" {{ request('availability') == 'available' ? 'selected' : '' }}>
                        Available
                    </option>
                    <option value="unavailable" {{ request('availability') == 'unavailable' ? 'selected' : '' }}>
                        Unavailable
                    </option>
                </select>
            </div>

            <!-- BUTTONS -->
            <div class="md:col-span-4 flex gap-3 pt-2">

                <button type="submit"
                        class="rounded-2xl bg-slate-900 px-6 py-3 text-sm font-medium text-white shadow-sm hover:bg-slate-800">
                    Search
                </button>

                <a href="{{ route('admin.books.index') }}"
                   class="rounded-2xl border border-slate-200 bg-white px-6 py-3 text-sm font-medium text-slate-700 shadow-sm hover:bg-slate-50">
                    Reset
                </a>

            </div>

        </form>
    </div>

    <!-- TABLE -->
    <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-slate-50">
                    <tr class="text-left text-xs font-semibold uppercase tracking-wider text-slate-500">

                        <th class="px-6 py-4">Title</th>
                        <th class="px-6 py-4">Author</th>
                        <th class="px-6 py-4">Category</th>
                        <th class="px-6 py-4">ISBN</th>
                        <th class="px-6 py-4">Copies</th>
                        <th class="px-6 py-4">Available</th>
                        <th class="px-6 py-4">Actions</th>

                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">

                    @forelse ($books as $book)
                        <tr class="transition hover:bg-slate-50">

                            <td class="px-6 py-4 font-medium text-slate-900">
                                {{ $book->title }}
                            </td>

                            <td class="px-6 py-4 text-slate-600">
                                {{ $book->author }}
                            </td>

                            <td class="px-6 py-4 text-slate-600">
                                {{ $book->category->name }}
                            </td>

                            <td class="px-6 py-4 text-slate-600">
                                {{ $book->isbn }}
                            </td>

                            <td class="px-6 py-4 text-slate-600">
                                {{ $book->total_copies }}
                            </td>

                            <td class="px-6 py-4">
                                <span class="rounded-full px-3 py-1 text-xs font-semibold
                                    {{ $book->available_copies > 0
                                        ? 'bg-green-100 text-green-700'
                                        : 'bg-red-100 text-red-700' }}">
                                    {{ $book->available_copies }}
                                </span>
                            </td>

                            <td class="px-6 py-4 flex gap-4">

                                <a href="{{ route('admin.books.edit', $book) }}"
                                   class="text-cyan-600 font-medium hover:underline">
                                    Edit
                                </a>

                                <form method="POST"
                                      action="{{ route('admin.books.destroy', $book) }}"
                                      onsubmit="return confirm('Delete this book?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="text-red-500 font-medium hover:underline">
                                        Delete
                                    </button>

                                </form>

                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-10 text-center text-slate-500">
                                No books found
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

        <!-- PAGINATION -->
        <div class="border-t border-slate-100 px-6 py-4">
            {{ $books->links() }}
        </div>

    </div>

</div>
@endsection