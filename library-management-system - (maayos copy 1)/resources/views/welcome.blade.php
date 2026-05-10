@extends('layouts.app')

@section('title', 'Library Management System')

@section('content')
<div class="rounded-[2rem] border border-slate-200 bg-white/90 p-10 shadow-2xl shadow-slate-200/50">
    <div class="space-y-8 text-center">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.35em] text-slate-500">Library management</p>
            <h1 class="mt-4 text-5xl font-semibold tracking-tight text-slate-900 sm:text-6xl">A clean, modern system for your library</h1>
            <p class="mx-auto mt-4 max-w-2xl text-base leading-8 text-slate-600">Manage books, borrowers, returns, and reports in one polished dashboard built for clarity and efficiency.</p>
        </div>

        <div class="flex flex-col items-center justify-center gap-3 sm:flex-row sm:justify-center">
            <a href="{{ route('login') }}" class="btn btn-primary rounded-full px-8 py-3 text-sm shadow-lg shadow-brand-500/10">Sign In</a>
            <a href="{{ route('register') }}" class="btn btn-outline rounded-full px-8 py-3 text-sm">Create account</a>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6 shadow-sm">
                <h2 class="text-lg font-semibold text-slate-900">Organized catalog</h2>
                <p class="mt-3 text-sm text-slate-600">Track books, categories, and availability clearly.</p>
            </div>
            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6 shadow-sm">
                <h2 class="text-lg font-semibold text-slate-900">Borrower insights</h2>
                <p class="mt-3 text-sm text-slate-600">View membership and borrowing history in one place.</p>
            </div>
            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6 shadow-sm">
                <h2 class="text-lg font-semibold text-slate-900">Reporting</h2>
                <p class="mt-3 text-sm text-slate-600">Generate overdue and fine summaries effortlessly.</p>
            </div>
        </div>
    </div>
</div>
@endsection
