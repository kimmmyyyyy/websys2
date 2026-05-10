<?php $__env->startSection('content'); ?>
<div class="relative overflow-hidden py-12">

    <!-- Background Glow -->
    <div class="absolute inset-0 -z-10">
        <div class="absolute left-1/2 top-0 h-[500px] w-[500px] -translate-x-1/2 rounded-full bg-cyan-100 blur-3xl opacity-40"></div>
    </div>

    <div class="mx-auto max-w-7xl space-y-20 px-6">

        <!-- Hero Section -->
        <section class="relative overflow-hidden rounded-[32px] border border-slate-200/70 bg-white/80 backdrop-blur-xl shadow-[0_20px_60px_rgba(15,23,42,0.08)]">
            
            <!-- Decorative Gradient -->
            <div class="absolute inset-0 bg-gradient-to-br from-cyan-50 via-white to-slate-50"></div>

            <div class="relative px-10 py-20 text-center lg:px-24">
                
                <!-- Title -->
                <h1 class="mx-auto max-w-4xl text-5xl font-bold tracking-tight text-slate-900 lg:text-6xl">
                    Library
                    <span class="bg-gradient-to-r from-cyan-600 to-blue-600 bg-clip-text text-transparent">
                        Management System
                    </span>
                </h1>

                <!-- Subtitle -->
                <p class="mx-auto mt-6 max-w-2xl text-lg leading-8 text-slate-600">
                    Streamline book tracking, borrower management, reporting, and daily library operations with a clean and professional workspace.
                </p>

                <!-- Buttons -->
                <?php if(auth()->check()): ?>
                    <div class="mt-10 flex flex-wrap justify-center gap-4">
                        <?php if(auth()->user()->isAdmin()): ?>
                            <a href="<?php echo e(route('admin.dashboard')); ?>"
                               class="rounded-full bg-slate-900 px-8 py-3 text-sm font-medium text-white transition hover:-translate-y-0.5 hover:bg-slate-800">
                                Open Admin Dashboard
                            </a>
                        <?php else: ?>
                            <a href="<?php echo e(route('user.dashboard')); ?>"
                               class="rounded-full bg-slate-900 px-8 py-3 text-sm font-medium text-white transition hover:-translate-y-0.5 hover:bg-slate-800">
                                Open My Dashboard
                            </a>
                        <?php endif; ?>

                        <a href="#features"
                           class="rounded-full border border-slate-300 bg-white px-8 py-3 text-sm font-medium text-slate-700 transition hover:bg-slate-100">
                            Explore Features
                        </a>
                    </div>
                <?php else: ?>
                    <div class="mt-10 flex flex-wrap justify-center gap-4">
                        <a href="<?php echo e(route('login')); ?>"
                           class="rounded-full bg-slate-900 px-8 py-3 text-sm font-medium text-white transition hover:-translate-y-0.5 hover:bg-slate-800">
                            Sign In
                        </a>

                        <a href="<?php echo e(route('register')); ?>"
                           class="rounded-full border border-slate-300 bg-white px-8 py-3 text-sm font-medium text-slate-700 transition hover:bg-slate-100">
                            Create Account
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features">

            <!-- Feature Cards -->
            <div class="grid gap-8 md:grid-cols-2 xl:grid-cols-3">

                <!-- Card -->
                <div class="group rounded-3xl border border-slate-200 bg-white p-8 shadow-sm transition duration-300 hover:-translate-y-2 hover:shadow-2xl">
                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-cyan-50 text-3xl">
                        📚
                    </div>

                    <h3 class="mt-6 text-xl font-semibold text-slate-900">
                        Book Management
                    </h3>

                    <p class="mt-3 leading-7 text-slate-600">
                        Organize your collection with categories, publishers, ISBN tracking, and inventory management.
                    </p>
                </div>

                <!-- Card -->
                <div class="group rounded-3xl border border-slate-200 bg-white p-8 shadow-sm transition duration-300 hover:-translate-y-2 hover:shadow-2xl">
                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-violet-50 text-3xl">
                        👥
                    </div>

                    <h3 class="mt-6 text-xl font-semibold text-slate-900">
                        Borrower Management
                    </h3>

                    <p class="mt-3 leading-7 text-slate-600">
                        Register members, manage profiles, and monitor borrower activity efficiently.
                    </p>
                </div>

                <!-- Card -->
                <div class="group rounded-3xl border border-slate-200 bg-white p-8 shadow-sm transition duration-300 hover:-translate-y-2 hover:shadow-2xl">
                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-50 text-3xl">
                        📊
                    </div>

                    <h3 class="mt-6 text-xl font-semibold text-slate-900">
                        Smart Reports
                    </h3>

                    <p class="mt-3 leading-7 text-slate-600">
                        Generate professional reports for borrowing history, overdue books, and fines.
                    </p>
                </div>

                <!-- Card -->
                <div class="group rounded-3xl border border-slate-200 bg-white p-8 shadow-sm transition duration-300 hover:-translate-y-2 hover:shadow-2xl">
                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-amber-50 text-3xl">
                        📖
                    </div>

                    <h3 class="mt-6 text-xl font-semibold text-slate-900">
                        Borrow & Return
                    </h3>

                    <p class="mt-3 leading-7 text-slate-600">
                        Simplify book circulation with automatic due date tracking and return monitoring.
                    </p>
                </div>

                <!-- Card -->
                <div class="group rounded-3xl border border-slate-200 bg-white p-8 shadow-sm transition duration-300 hover:-translate-y-2 hover:shadow-2xl">
                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-rose-50 text-3xl">
                        ⚠️
                    </div>

                    <h3 class="mt-6 text-xl font-semibold text-slate-900">
                        Overdue Monitoring
                    </h3>

                    <p class="mt-3 leading-7 text-slate-600">
                        Detect overdue books instantly and automate fine calculations with reminders.
                    </p>
                </div>

                <!-- Card -->
                <div class="group rounded-3xl border border-slate-200 bg-white p-8 shadow-sm transition duration-300 hover:-translate-y-2 hover:shadow-2xl">
                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-sky-50 text-3xl">
                        📋
                    </div>

                    <h3 class="mt-6 text-xl font-semibold text-slate-900">
                        Activity Logs
                    </h3>

                    <p class="mt-3 leading-7 text-slate-600">
                        Maintain secure records of system actions, transactions, and administrative activities.
                    </p>
                </div>

            </div>
        </section>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp1\htdocs\library-management-system - (maayos copy)\resources\views/index.blade.php ENDPATH**/ ?>