<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-8">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
        <p class="mt-2 text-gray-600">Welcome to the Library Management System</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
        <div class="rounded-lg bg-white p-6 shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Total Books</p>
                    <p class="text-3xl font-bold text-gray-900"><?php echo e($stats['total_books']); ?></p>
                </div>
                <div class="text-4xl text-blue-500">📚</div>
            </div>
        </div>

        <div class="rounded-lg bg-white p-6 shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Total Borrowers</p>
                    <p class="text-3xl font-bold text-gray-900"><?php echo e($stats['total_borrowers']); ?></p>
                </div>
                <div class="text-4xl text-green-500">👥</div>
            </div>
        </div>

        <div class="rounded-lg bg-white p-6 shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Borrowed Books</p>
                    <p class="text-3xl font-bold text-gray-900"><?php echo e($stats['total_borrowed_books']); ?></p>
                </div>
                <div class="text-4xl text-yellow-500">📖</div>
            </div>
        </div>

        <div class="rounded-lg bg-white p-6 shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Overdue Books</p>
                    <p class="text-3xl font-bold text-gray-900"><?php echo e($stats['overdue_books']); ?></p>
                </div>
                <div class="text-4xl text-red-500">⚠️</div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="rounded-lg bg-white p-6 shadow">
        <h2 class="mb-4 text-lg font-semibold text-gray-900">Quick Actions</h2>
        <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-5">
            <a href="<?php echo e(route('admin.books.create')); ?>" class="rounded-lg bg-blue-50 p-4 text-center hover:bg-blue-100">
                <p class="font-medium text-blue-900">Add Book</p>
            </a>
            <a href="<?php echo e(route('admin.categories.create')); ?>" class="rounded-lg bg-green-50 p-4 text-center hover:bg-green-100">
                <p class="font-medium text-green-900">Add Category</p>
            </a>
            <a href="<?php echo e(route('admin.borrowers.create')); ?>" class="rounded-lg bg-purple-50 p-4 text-center hover:bg-purple-100">
                <p class="font-medium text-purple-900">Register Borrower</p>
            </a>
            <a href="<?php echo e(route('admin.overdue-books')); ?>" class="rounded-lg bg-red-50 p-4 text-center hover:bg-red-100">
                <p class="font-medium text-red-900">Overdue Books</p>
            </a>
            <a href="<?php echo e(route('admin.reports.borrowing')); ?>" class="rounded-lg bg-indigo-50 p-4 text-center hover:bg-indigo-100">
                <p class="font-medium text-indigo-900">Reports</p>
            </a>
        </div>
    </div>

    <!-- Recent Transactions -->
    <div class="rounded-lg bg-white p-6 shadow">
        <h2 class="mb-4 text-lg font-semibold text-gray-900">Recent Transactions</h2>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="px-4 py-2 text-left font-medium text-gray-700">Borrower</th>
                        <th class="px-4 py-2 text-left font-medium text-gray-700">Book</th>
                        <th class="px-4 py-2 text-left font-medium text-gray-700">Borrow Date</th>
                        <th class="px-4 py-2 text-left font-medium text-gray-700">Due Date</th>
                        <th class="px-4 py-2 text-left font-medium text-gray-700">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $recentTransactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-b border-gray-100">
                            <td class="px-4 py-3"><?php echo e($transaction->borrower->user->name); ?></td>
                            <td class="px-4 py-3"><?php echo e($transaction->book->title); ?></td>
                            <td class="px-4 py-3"><?php echo e($transaction->borrow_date->format('M d, Y')); ?></td>
                            <td class="px-4 py-3"><?php echo e($transaction->due_date->format('M d, Y')); ?></td>
                            <td class="px-4 py-3">
                                <?php if($transaction->status === 'borrowed'): ?>
                                    <span class="inline-block rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-800">Borrowed</span>
                                <?php elseif($transaction->status === 'returned'): ?>
                                    <span class="inline-block rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-800">Returned</span>
                                <?php else: ?>
                                    <span class="inline-block rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-800">Overdue</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="px-4 py-4 text-center text-gray-500">No transactions found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp1\htdocs\library-management-system\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>