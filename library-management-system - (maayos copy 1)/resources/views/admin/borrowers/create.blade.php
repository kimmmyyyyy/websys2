@extends('layouts.app')

@section('title', 'Register Borrower')

@section('content')
<div class="space-y-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Register New Borrower</h1>
    </div>

    <div class="rounded-lg bg-white p-6 shadow">
        <form method="POST" action="{{ route('admin.borrowers.store') }}" class="space-y-6">
            @csrf

            <div>
                <label for="user_id" class="block text-sm font-medium text-gray-700">User</label>
                <select name="user_id" id="user_id" required class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2">
                    <option value="">Select User</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
                @error('user_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="membership_date" class="block text-sm font-medium text-gray-700">Membership Date</label>
                <input type="date" name="membership_date" id="membership_date" required class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2" value="{{ old('membership_date', date('Y-m-d')) }}">
                @error('membership_date')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="rounded-md bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
                    Register Borrower
                </button>
                <a href="{{ route('admin.borrowers.index') }}" class="rounded-md border border-gray-300 px-4 py-2 text-gray-700 hover:bg-gray-50">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
