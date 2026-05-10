<?php $__env->startSection('content'); ?>
<div class="space-y-16 py-12">
    <!-- Hero Section -->
    <div class="text-center">
        <h1 class="text-5xl font-bold tracking-tight text-gray-900">
            Library Management System
        </h1>
        <p class="mt-6 text-lg text-gray-600">
            Efficiently manage your library's books, borrowers, and lending operations
        </p>
        <?php if(auth()->check()): ?>
            <div class="mt-8 flex justify-center gap-4">
                <?php if(auth()->user()->isAdmin()): ?>
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="rounded-lg bg-blue-600 px-8 py-3 text-white hover:bg-blue-700">
                        Go to Admin Dashboard
                    </a>
                <?php else: ?>
                    <a href="<?php echo e(route('user.dashboard')); ?>" class="rounded-lg bg-blue-600 px-8 py-3 text-white hover:bg-blue-700">
                        Go to My Dashboard
                    </a>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="mt-8 flex justify-center gap-4">
                <a href="<?php echo e(route('login')); ?>" class="rounded-lg bg-blue-600 px-8 py-3 text-white hover:bg-blue-700">
                    Sign In
                </a>
                <a href="<?php echo e(route('register')); ?>" class="rounded-lg border border-gray-300 px-8 py-3 text-gray-700 hover:bg-gray-50">
                    Create Account
                </a>
            </div>
        <?php endif; ?>
    </div>

    <!-- Features Section -->
    <div class="grid grid-cols-1 gap-12 md:grid-cols-3">
        <div class="text-center">
            <div class="mb-4 flex justify-center text-4xl">📚</div>
            <h3 class="text-lg font-semibold text-gray-900">Book Management</h3>
            <p class="mt-2 text-gray-600">
                Easily add, edit, and manage your library's book collection with categories
            </p>
        </div>

        <div class="text-center">
            <div class="mb-4 flex justify-center text-4xl">👥</div>
            <h3 class="text-lg font-semibold text-gray-900">Borrower Management</h3>
            <p class="mt-2 text-gray-600">
                Register and manage borrowers with membership tracking and status control
            </p>
        </div>

        <div class="text-center">
            <div class="mb-4 flex justify-center text-4xl">📊</div>
            <h3 class="text-lg font-semibold text-gray-900">Reports & Analytics</h3>
            <p class="mt-2 text-gray-600">
                Generate comprehensive reports on borrowing, returns, and fines
            </p>
        </div>

        <div class="text-center">
            <div class="mb-4 flex justify-center text-4xl">📖</div>
            <h3 class="text-lg font-semibold text-gray-900">Borrow & Return</h3>
            <p class="mt-2 text-gray-600">
                Track book borrowing and returns with automatic due date and fine calculation
            </p>
        </div>

        <div class="text-center">
            <div class="mb-4 flex justify-center text-4xl">⚠️</div>
            <h3 class="text-lg font-semibold text-gray-900">Overdue Tracking</h3>
            <p class="mt-2 text-gray-600">
                Monitor overdue books and automatically calculate late fees
            </p>
        </div>

        <div class="text-center">
            <div class="mb-4 flex justify-center text-4xl">📋</div>
            <h3 class="text-lg font-semibold text-gray-900">Activity Logs</h3>
            <p class="mt-2 text-gray-600">
                Keep detailed logs of all system activities for audit and tracking purposes
            </p>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\library-management-system\resources\views/index.blade.php ENDPATH**/ ?>