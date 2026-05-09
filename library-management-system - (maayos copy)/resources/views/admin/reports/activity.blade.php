@extends('layouts.app')

@section('title', 'Activity Log')

@section('content')
<div class="space-y-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Activity Log</h1>
    </div>

    <div class="rounded-lg bg-white shadow">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200 bg-gray-50">
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">User</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Action</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Description</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($logs as $log)
                        <tr class="border-b border-gray-100">
                            <td class="px-6 py-4">{{ $log->user->name }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-block rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-800 capitalize">
                                    {{ $log->action }}
                                </span>
                            </td>
                            <td class="px-6 py-4">{{ $log->description }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ $log->created_at->format('M d, Y H:i A') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">No activity logs</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="border-t border-gray-200 px-6 py-4">
            {{ $logs->links() }}
        </div>
    </div>
</div>
@endsection
