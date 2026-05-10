<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Library Management System')</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-slate-100 text-slate-900 antialiased flex flex-col">

    @if (auth()->check() && !request()->is('login', 'register'))
        <header class="sticky top-0 z-20 border-b border-slate-200 bg-white/90 backdrop-blur shadow-sm">

            <div class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-3 px-4 py-4 sm:px-6 lg:px-8">

                <a href="/" class="flex items-center gap-3 text-slate-900">
                    <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-slate-900 text-sm font-semibold text-white shadow">
                        L
                    </span>

                    <div>
                        <p class="text-base font-semibold tracking-tight">Library Management</p>
                    </div>
                </a>

                <nav class="flex flex-wrap items-center gap-2 text-sm font-medium text-slate-700">

                    @if (auth()->user()->isAdmin())

                        <a href="{{ route('admin.dashboard') }}" class="rounded-full px-4 py-2 hover:bg-slate-100 transition">
                            Dashboard
                        </a>

                        <a href="{{ route('admin.books.index') }}" class="rounded-full px-4 py-2 hover:bg-slate-100 transition">
                            Books
                        </a>

                        <a href="{{ route('admin.categories.index') }}" class="rounded-full px-4 py-2 hover:bg-slate-100 transition">
                            Categories
                        </a>

                        <a href="{{ route('admin.borrowers.index') }}" class="rounded-full px-4 py-2 hover:bg-slate-100 transition">
                            Borrowers
                        </a>

                        <a href="{{ route('admin.overdue-books') }}" class="rounded-full px-4 py-2 hover:bg-slate-100 transition">
                            Overdue
                        </a>

                        <a href="{{ route('admin.reports.borrowing') }}" class="rounded-full px-4 py-2 hover:bg-slate-100 transition">
                            Reports
                        </a>
                           <a href="{{ route('admin.reports.activity') }}" class="transition hover:text-cyan-600">
                    Activity Logs
                </a>

                    @else

                        <a href="{{ route('user.dashboard') }}" class="rounded-full px-4 py-2 hover:bg-slate-100 transition">
                            My Books
                        </a>

                        <a href="{{ route('books.search') }}" class="rounded-full px-4 py-2 hover:bg-slate-100 transition">
                            Search
                        </a>

                        <a href="{{ route('user.profile') }}" class="rounded-full px-4 py-2 hover:bg-slate-100 transition">
                            Profile
                        </a>

                    @endif

                </nav>

                <div class="flex items-center gap-2">

                    <span class="hidden sm:inline rounded-full bg-slate-100 px-4 py-2 text-slate-700">
                        {{ auth()->user()->name }}
                    </span>

                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit"
                            class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 shadow-sm transition hover:bg-slate-50">
                            Logout
                        </button>
                    </form>

                </div>

            </div>
        </header>
    @endif

    <!-- MAIN CONTENT -->
    <main class="mx-auto w-full max-w-7xl flex-1 px-4 py-10 sm:px-6 lg:px-8">

        @if (session('success'))
            <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm text-emerald-900 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 px-5 py-4 text-sm text-rose-900 shadow-sm">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')

    </main>

    <!-- FOOTER -->
    <footer class="border-t border-slate-200 bg-white px-6 py-8 shadow-sm">

        <div class="mx-auto flex max-w-7xl flex-wrap justify-center gap-6 text-sm font-medium text-slate-500">

            @if (auth()->check() && auth()->user()->isAdmin())

                <a href="{{ route('admin.dashboard') }}" class="transition hover:text-cyan-600">
                    Dashboard
                </a>

                <a href="{{ route('admin.books.index') }}" class="transition hover:text-cyan-600">
                    Books
                </a>

                <a href="{{ route('admin.categories.index') }}" class="transition hover:text-cyan-600">
                    Categories
                </a>

                <a href="{{ route('admin.borrowers.index') }}" class="transition hover:text-cyan-600">
                    Borrowers
                </a>

                <a href="{{ route('admin.overdue-books') }}" class="transition hover:text-cyan-600">
                    Overdue
                </a>

                <a href="{{ route('admin.reports.borrowing') }}" class="transition hover:text-cyan-600">
                    Reports
                </a>

                 <a href="{{ route('admin.reports.activity') }}" class="transition hover:text-cyan-600">
                    Activity Logs
                </a>

            @else

                <a href="{{ route('user.dashboard') }}" class="transition hover:text-cyan-600">
                    Dashboard
                </a>

                <a href="{{ route('books.search') }}" class="transition hover:text-cyan-600">
                    Search
                </a>

                <a href="{{ route('user.profile') }}" class="transition hover:text-cyan-600">
                    Profile
                </a>

            @endif

        </div>

        <div class="mt-6 text-center text-sm text-slate-400">
            © {{ date('Y') }} Camela. All rights reserved.
        </div>

    </footer>

</body>
</html>