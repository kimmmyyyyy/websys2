@extends('layouts.app')

@section('title', 'Borrowers Management')

@section('content')
<div class="space-y-8">

    <!-- HEADER -->
    <<!-- HEADER -->
<div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

    <div>
        <h1 class="text-4xl font-bold tracking-tight text-slate-900">
            Library Borrowers
        </h1>
        <p class="mt-1 text-sm text-slate-500">
            Manage registered library members
        </p>
    </div>

    <div class="flex items-center gap-4">

        <!-- 📊 STATS CARD -->
        <div class="rounded-2xl border border-slate-200 bg-white px-5 py-3 shadow-sm flex items-center gap-4">

            <div>
                <p class="text-xs text-slate-500">Total Borrowers</p>
              <p class="text-xl font-bold text-slate-900 text-center">
    {{ $totalBorrowers }}
</p>
            </div>

        </div>

        <!-- REGISTER BUTTON -->
        <a href="{{ route('admin.borrowers.create') }}"
           class="inline-flex items-center gap-2 rounded-2xl bg-slate-900 px-5 py-3 text-sm font-medium text-white shadow-sm hover:bg-slate-800">
            + Register Borrower
        </a>

    </div>

</div>

    <!-- SEARCH CARD -->
    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">

        <form method="GET"
              action="{{ route('admin.borrowers.index') }}"
              class="grid gap-5 md:grid-cols-3">

            <!-- SEARCH -->
            <div class="md:col-span-2">
                <label class="text-sm font-medium text-slate-700">
                    Search Borrowers
                </label>

                <input type="text"
                       name="q"
                       value="{{ request('q') }}"
                       placeholder="Name, email, membership ID..."
                       class="mt-2 w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm shadow-sm focus:border-cyan-500 focus:ring-4 focus:ring-cyan-100" />
            </div>

            <!-- BUTTONS -->
            <div class="flex items-end gap-3">

                <button type="submit"
                        class="w-full rounded-2xl bg-slate-900 px-5 py-3 text-sm font-medium text-white shadow-sm hover:bg-slate-800">
                    Search
                </button>

                <a href="{{ route('admin.borrowers.index') }}"
                   class="w-full rounded-2xl border border-slate-200 bg-white px-5 py-3 text-center text-sm font-medium text-slate-700 shadow-sm hover:bg-slate-50">
                    Reset
                </a>

            </div>

        </form>
    </div>

    <!-- TABLE -->
    <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <!-- HEADER -->
                <thead class="bg-slate-50">
                    <tr class="text-left text-xs font-semibold uppercase tracking-wider text-slate-500">

                        <th class="px-6 py-4">Name</th>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-6 py-4">CP</th>
                        <th class="px-6 py-4">Address</th>
                        <th class="px-6 py-4">Membership ID</th>
                        <th class="px-6 py-4">Member Since</th>
                        <th class="px-6 py-4">Account Created</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Actions</th>

                    </tr>
                </thead>

                <!-- BODY -->
                <tbody class="divide-y divide-slate-100">

                    @forelse ($borrowers as $borrower)

                        <tr class="transition hover:bg-slate-50">

                            <td class="px-6 py-4 font-medium text-slate-900">
                                {{ $borrower->user->name }}
                            </td>

                            <td class="px-6 py-4 text-slate-600">
                                {{ $borrower->user->email }}
                            </td>

                            <td class="px-6 py-4 text-slate-600">
                                {{ $borrower->user->phone }}
                            </td>

                            <td class="px-6 py-4 text-slate-600">
                                {{ $borrower->user->address }}
                            </td>

                            <td class="px-6 py-4 font-mono text-sm text-slate-700">
                                {{ $borrower->membership_id }}
                            </td>

                            <td class="px-6 py-4 text-slate-600">
                                {{ $borrower->membership_date->format('M d, Y') }}
                            </td>

                            <td class="px-6 py-4 text-slate-600">
                                {{ $borrower->created_at->format('M d, Y') }}
                            </td>

                            <td class="px-6 py-4">

                                @if ($borrower->status === 'active')
                                    <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                        Active
                                    </span>

                                @elseif ($borrower->status === 'suspended')
                                    <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                        Suspended
                                    </span>

                                @else
                                    <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">
                                        Inactive
                                    </span>
                                @endif

                            </td>

                            <td class="px-6 py-4 flex gap-4">

                                <a href="{{ route('admin.borrowers.edit', $borrower) }}"
                                   class="font-medium text-cyan-600 hover:underline">
                                    Edit
                                </a>

                                <form method="POST"
                                      action="{{ route('admin.borrowers.destroy', $borrower) }}"
                                      onsubmit="return confirm('Are you sure?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="font-medium text-red-500 hover:underline">
                                        Delete
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="9" class="px-6 py-10 text-center text-slate-500">
                                No borrowers found
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <!-- PAGINATION -->
        <div class="border-t border-slate-100 px-6 py-4">
            {{ $borrowers->links() }}
        </div>

    </div>

</div>
@endsection