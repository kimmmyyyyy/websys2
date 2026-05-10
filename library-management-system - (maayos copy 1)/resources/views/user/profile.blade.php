@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="space-y-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">My Profile</h1>
    </div>

    <!-- Back to Dashboard -->
    <a href="{{ route('user.dashboard') }}" class="inline-block bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">
        ← Back to Dashboard
    </a>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <!-- Profile Info -->
        <div class="rounded-lg bg-white p-6 shadow lg:col-span-2 border border-gray-200">
            <h2 class="mb-6 text-xl font-semibold text-gray-900">Account Information</h2>
            
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Full Name</label>
                    <p class="mt-2 text-lg text-gray-900 font-medium">{{ $user->name }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Email Address</label>
                    <p class="mt-2 text-lg text-gray-900">{{ $user->email }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Member Since</label>
                    <p class="mt-2 text-lg text-gray-900">{{ $user->created_at->format('F d, Y') }}</p>
                </div>

                <div class="pt-4 border-t border-gray-200">
                    <a href="{{ route('user.history') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                        View Borrowing History
                    </a>
                </div>
            </div>
        </div>

        <!-- Borrower Info -->
        @if ($borrower)
            <div class="rounded-lg bg-white p-6 shadow border border-gray-200">
                <h2 class="mb-6 text-xl font-semibold text-gray-900">Borrower Information</h2>
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Membership ID</label>
                        <p class="mt-2 font-mono text-lg font-bold text-gray-900">{{ $borrower->membership_id }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status</label>
                        <p class="mt-2">
                            @if ($borrower->status === 'active')
                                <span class="inline-block rounded-full bg-green-100 px-4 py-2 text-sm font-semibold text-green-800">✓ Active</span>
                            @elseif ($borrower->status === 'suspended')
                                <span class="inline-block rounded-full bg-red-100 px-4 py-2 text-sm font-semibold text-red-800">⚠ Suspended</span>
                            @else
                                <span class="inline-block rounded-full bg-gray-100 px-4 py-2 text-sm font-semibold text-gray-800">○ Inactive</span>
                            @endif
                        </p>
                    </div>
<div>
    <label class="block text-sm font-medium text-slate-700">CP</label>
    <p class="mt-2 text-lg text-slate-600">
        {{ $borrower->user->phone ?? 'Not provided' }}
    </p>
</div>

<div>
    <label class="block text-sm font-medium text-slate-700">Address</label>
    <p class="mt-2 text-lg text-slate-600">
        {{ $borrower->user->address ?? 'Not provided' }}
    </p>
</div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Member Since</label>
                        <p class="mt-2 text-lg text-gray-900">{{ $borrower->created_at->format('F d, Y') }}</p>
                    </div>
                </div>
            </div>
        @else
            <div class="rounded-lg bg-yellow-50 p-6 border border-yellow-200">
                <h2 class="mb-4 text-lg font-semibold text-yellow-900">Not Registered as Borrower</h2>
                <p class="text-yellow-800">You need to be registered as a borrower to borrow books. Please contact the library administrator.</p>
            </div>
        @endif
    </div>
</div>
@endsection
