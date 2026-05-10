<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Library Management System'); ?></title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-slate-100 text-slate-900 antialiased flex flex-col">

    <?php if(auth()->check() && !request()->is('login', 'register')): ?>
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

                    <?php if(auth()->user()->isAdmin()): ?>

                        <a href="<?php echo e(route('admin.dashboard')); ?>" class="rounded-full px-4 py-2 hover:bg-slate-100 transition">
                            Dashboard
                        </a>

                        <a href="<?php echo e(route('admin.books.index')); ?>" class="rounded-full px-4 py-2 hover:bg-slate-100 transition">
                            Books
                        </a>

                        <a href="<?php echo e(route('admin.categories.index')); ?>" class="rounded-full px-4 py-2 hover:bg-slate-100 transition">
                            Categories
                        </a>

                        <a href="<?php echo e(route('admin.borrowers.index')); ?>" class="rounded-full px-4 py-2 hover:bg-slate-100 transition">
                            Borrowers
                        </a>

                        <a href="<?php echo e(route('admin.overdue-books')); ?>" class="rounded-full px-4 py-2 hover:bg-slate-100 transition">
                            Overdue
                        </a>

                        <a href="<?php echo e(route('admin.reports.borrowing')); ?>" class="rounded-full px-4 py-2 hover:bg-slate-100 transition">
                            Reports
                        </a>
                           <a href="<?php echo e(route('admin.reports.activity')); ?>" class="transition hover:text-cyan-600">
                    Activity Logs
                </a>

                    <?php else: ?>

                        <a href="<?php echo e(route('user.dashboard')); ?>" class="rounded-full px-4 py-2 hover:bg-slate-100 transition">
                            My Books
                        </a>

                        <a href="<?php echo e(route('books.search')); ?>" class="rounded-full px-4 py-2 hover:bg-slate-100 transition">
                            Search
                        </a>

                        <a href="<?php echo e(route('user.profile')); ?>" class="rounded-full px-4 py-2 hover:bg-slate-100 transition">
                            Profile
                        </a>

                    <?php endif; ?>

                </nav>

                <div class="flex items-center gap-2">

                    <span class="hidden sm:inline rounded-full bg-slate-100 px-4 py-2 text-slate-700">
                        <?php echo e(auth()->user()->name); ?>

                    </span>

                    <form method="POST" action="<?php echo e(route('logout')); ?>" class="inline">
                        <?php echo csrf_field(); ?>
                        <button type="submit"
                            class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 shadow-sm transition hover:bg-slate-50">
                            Logout
                        </button>
                    </form>

                </div>

            </div>
        </header>
    <?php endif; ?>

    <!-- MAIN CONTENT -->
    <main class="mx-auto w-full max-w-7xl flex-1 px-4 py-10 sm:px-6 lg:px-8">

        <?php if(session('success')): ?>
            <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm text-emerald-900 shadow-sm">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 px-5 py-4 text-sm text-rose-900 shadow-sm">
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>

    </main>

    <!-- FOOTER -->
    <footer class="border-t border-slate-200 bg-white px-6 py-8 shadow-sm">

        <div class="mx-auto flex max-w-7xl flex-wrap justify-center gap-6 text-sm font-medium text-slate-500">

            <?php if(auth()->check() && auth()->user()->isAdmin()): ?>

                <a href="<?php echo e(route('admin.dashboard')); ?>" class="transition hover:text-cyan-600">
                    Dashboard
                </a>

                <a href="<?php echo e(route('admin.books.index')); ?>" class="transition hover:text-cyan-600">
                    Books
                </a>

                <a href="<?php echo e(route('admin.categories.index')); ?>" class="transition hover:text-cyan-600">
                    Categories
                </a>

                <a href="<?php echo e(route('admin.borrowers.index')); ?>" class="transition hover:text-cyan-600">
                    Borrowers
                </a>

                <a href="<?php echo e(route('admin.overdue-books')); ?>" class="transition hover:text-cyan-600">
                    Overdue
                </a>

                <a href="<?php echo e(route('admin.reports.borrowing')); ?>" class="transition hover:text-cyan-600">
                    Reports
                </a>

                 <a href="<?php echo e(route('admin.reports.activity')); ?>" class="transition hover:text-cyan-600">
                    Activity Logs
                </a>

            <?php else: ?>

                <a href="<?php echo e(route('user.dashboard')); ?>" class="transition hover:text-cyan-600">
                    Dashboard
                </a>

                <a href="<?php echo e(route('books.search')); ?>" class="transition hover:text-cyan-600">
                    Search
                </a>

                <a href="<?php echo e(route('user.profile')); ?>" class="transition hover:text-cyan-600">
                    Profile
                </a>

            <?php endif; ?>

        </div>

        <div class="mt-6 text-center text-sm text-slate-400">
            © <?php echo e(date('Y')); ?> Camela. All rights reserved.
        </div>

    </footer>

</body>
</html><?php /**PATH C:\xampp1\htdocs\library-management-system - (maayos copy)\resources\views/layouts/app.blade.php ENDPATH**/ ?>