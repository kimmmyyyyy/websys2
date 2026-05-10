@extends('layouts.app')

@section('title', 'Edit Borrower')

@section('content')
<div class="space-y-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Edit Borrower</h1>
    </div>

    <div class="rounded-lg bg-white p-6 shadow">
        <form method="POST" action="{{ route('admin.borrowers.update', $borrower) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700">User</label>
                <input type="text" disabled class="mt-1 block w-full rounded-md border border-gray-300 bg-gray-100 px-3 py-2" value="{{ $borrower->user->name }}">
            </div>

            <div>
                <label for="membership_date" class="block text-sm font-medium text-gray-700">Membership Date</label>
                <input type="date" name="membership_date" id="membership_date" required class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2" value="{{ old('membership_date', $borrower->membership_date->format('Y-m-d')) }}">
                @error('membership_date')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status" required class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2">
                    <option value="active" {{ old('status', $borrower->status) === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status', $borrower->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    <option value="suspended" {{ old('status', $borrower->status) === 'suspended' ? 'selected' : '' }}>Suspended</option>
                </select>
                @error('status')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="rounded-md bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
                    Update Borrower
                </button>
                <a href="{{ route('admin.borrowers.index') }}" class="rounded-md border border-gray-300 px-4 py-2 text-gray-700 hover:bg-gray-50">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
