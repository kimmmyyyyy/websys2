@extends('layouts.app')

@section('title', 'Add Book')

@section('content')
<div class="space-y-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Add New Book</h1>
    </div>

    <div class="rounded-lg bg-white p-6 shadow">
        <form method="POST" action="{{ route('admin.books.store') }}" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" name="title" id="title" required class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2" value="{{ old('title') }}">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="author" class="block text-sm font-medium text-gray-700">Author</label>
                    <input type="text" name="author" id="author" required class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2" value="{{ old('author') }}">
                    @error('author')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="isbn" class="block text-sm font-medium text-gray-700">ISBN</label>
                    <input type="text" name="isbn" id="isbn" required class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2" value="{{ old('isbn') }}">
                    @error('isbn')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                    <select name="category_id" id="category_id" required class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="total_copies" class="block text-sm font-medium text-gray-700">Total Copies</label>
                    <input type="number" name="total_copies" id="total_copies" required min="1" class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2" value="{{ old('total_copies') }}">
                    @error('total_copies')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="published_year" class="block text-sm font-medium text-gray-700">Published Year</label>
                    <input type="number" name="published_year" id="published_year" min="1900" max="{{ date('Y') }}" class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2" value="{{ old('published_year') }}">
                    @error('published_year')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="publisher" class="block text-sm font-medium text-gray-700">Publisher</label>
                    <input type="text" name="publisher" id="publisher" class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2" value="{{ old('publisher') }}">
                </div>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="4" class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2">{{ old('description') }}</textarea>
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="rounded-md bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
                    Add Book
                </button>
                <a href="{{ route('admin.books.index') }}" class="rounded-md border border-gray-300 px-4 py-2 text-gray-700 hover:bg-gray-50">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
