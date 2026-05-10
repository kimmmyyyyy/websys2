

<?php $__env->startSection('title', 'My Library Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-8">

    <div>
        <h1 class="text-3xl font-bold text-gray-900">My Library Dashboard</h1>
        <p class="mt-2 text-gray-600">Welcome, <?php echo e(auth()->user()->name); ?></p>
    </div>

    <?php if(!$borrower): ?>

        <div class="rounded-lg bg-blue-50 p-6 border border-blue-200">
            <p class="text-sm text-blue-800">
                You haven't been registered as a borrower yet. Please contact the library administrator to get registered.
            </p>
        </div>

    <?php else: ?>

    <!-- QUICK STATS -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

        <div class="rounded-lg bg-blue-50 p-4 border border-blue-200">
            <p class="text-sm text-blue-600 font-medium">Currently Borrowed</p>
            <p class="mt-1 text-2xl font-bold text-blue-900"><?php echo e($borrowedBooks->count()); ?></p>
        </div>

        <div class="rounded-lg bg-red-50 p-4 border border-red-200">
            <p class="text-sm text-red-600 font-medium">Overdue</p>
            <p class="mt-1 text-2xl font-bold text-red-900"><?php echo e($overdue); ?></p>
        </div>

        <div class="rounded-lg bg-green-50 p-4 border border-green-200">
            <p class="text-sm text-green-600 font-medium">Member Since</p>
            <p class="mt-1 text-lg font-bold text-green-900">
                <?php echo e($borrower->created_at->format('M Y')); ?>

            </p>
        </div>

        <div class="rounded-lg bg-purple-50 p-4 border border-purple-200">
            <p class="text-sm text-purple-600 font-medium">ID</p>
            <p class="mt-1 text-lg font-bold text-purple-900">
                <?php echo e($borrower->membership_id); ?>

            </p>
        </div>

    </div>

    <!-- 🔴 OVERDUE SECTION -->
    <div class="rounded-lg bg-white shadow border border-gray-200 p-6">

        <h2 class="text-lg font-semibold text-gray-900 mb-4">
            Overdue Books
        </h2>

        <?php if($overdueBooks->count() > 0): ?>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">

                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left font-semibold text-gray-700">Book</th>
                            <th class="px-4 py-2 text-left font-semibold text-gray-700">Due Date</th>
                            <th class="px-4 py-2 text-left font-semibold text-gray-700">Days Late</th>
                            <th class="px-4 py-2 text-left font-semibold text-gray-700">Status</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">

                        <?php $__currentLoopData = $overdueBooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <?php
                                $dueDate = \Carbon\Carbon::parse($transaction->due_date);
                                $daysLate = $dueDate->diffInDays(now('Asia/Manila'));
                            ?>

                            <tr class="hover:bg-gray-50">

                                <td class="px-4 py-3 font-medium text-gray-900">
                                    <?php echo e($transaction->book->title); ?>

                                </td>

                                <td class="px-4 py-3 text-gray-600">
                                    <?php echo e($dueDate->format('M d, Y')); ?>

                                </td>

                                <td class="px-4 py-3 text-red-600 font-semibold">
                                    <?php echo e($daysLate); ?> days late
                                </td>

                                <td class="px-4 py-3">
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                        Overdue
                                    </span>
                                </td>

                            </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </tbody>

                </table>
            </div>

        <?php else: ?>

            <p class="text-gray-500 text-sm">No overdue books 🎉</p>

        <?php endif; ?>

    </div>

    <!-- CURRENT BORROWED BOOKS -->
    <div class="rounded-lg bg-white p-6 shadow">

        <h2 class="mb-4 text-lg font-semibold text-gray-900">
            Currently Borrowed Books
        </h2>

        <?php if($borrowedBooks->count() > 0): ?>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">

                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="px-4 py-2 text-left font-medium text-gray-700">Book Title</th>
                            <th class="px-4 py-2 text-left font-medium text-gray-700">Borrow Date</th>
                            <th class="px-4 py-2 text-left font-medium text-gray-700">Due Date</th>
                            <th class="px-4 py-2 text-left font-medium text-gray-700">Days Left</th>
                            <th class="px-4 py-2 text-left font-medium text-gray-700">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php $__currentLoopData = $borrowedBooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <tr class="border-b border-gray-100 hover:bg-gray-50">

                                <td class="px-4 py-3">
                                    <?php echo e($transaction->book->title); ?>

                                </td>

                                <td class="px-4 py-3">
                                    <?php echo e(\Carbon\Carbon::parse($transaction->borrow_date)->format('M d, Y')); ?>

                                    <div class="text-xs text-slate-400">
    <?php if(!empty($transaction->borrow_time)): ?>
        <?php echo e(\Carbon\Carbon::parse($transaction->borrow_time)->format('h:i A')); ?>

    <?php endif; ?>
</div>
                                </td>

                                <td class="px-4 py-3">
                                    <?php echo e(\Carbon\Carbon::parse($transaction->due_date)->format('M d, Y')); ?>

                                    <div class="text-xs text-slate-400">
    <?php if(!empty($transaction->due_date)): ?>
        <?php echo e(\Carbon\Carbon::parse($transaction->due_date)->format('h:i A')); ?>

    <?php endif; ?>
            </div>
                                </td>

                                <td class="px-4 py-3">

                                    <?php
                                        $dueDate = \Carbon\Carbon::parse($transaction->due_date)->startOfDay();
                                        $today = now()->startOfDay();
                                        $daysLeft = $today->diffInDays($dueDate, false);
                                    ?>

                                    <span class="font-semibold
                                        <?php if($daysLeft < 0): ?> text-red-600
                                        <?php elseif($daysLeft <= 2): ?> text-orange-600
                                        <?php else: ?> text-green-600 <?php endif; ?>">

                                        <?php if($daysLeft < 0): ?>
                                            <?php echo e(abs($daysLeft)); ?> days overdue
                                        <?php elseif($daysLeft == 0): ?>
                                            Due today
                                        <?php elseif($daysLeft <= 2): ?>
                                            <?php echo e($daysLeft); ?> days left (Due soon)
                                        <?php else: ?>
                                            <?php echo e($daysLeft); ?> days left
                                        <?php endif; ?>

                                    </span>

                                </td>

                                <td class="px-4 py-3">
                                    <form method="POST" action="<?php echo e(route('book.return', $transaction->id)); ?>">
                                        <?php echo csrf_field(); ?>
                                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-xs">
                                            Return
                                        </button>
                                    </form>
                                </td>

                            </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </tbody>

                </table>
            </div>

        <?php else: ?>
            <p class="text-gray-500 py-4 text-center">No books currently borrowed</p>
        <?php endif; ?>

    </div>

    <!-- BORROWING HISTORY -->
    <div class="rounded-lg bg-white p-6 shadow">

        <h2 class="mb-4 text-lg font-semibold text-gray-900">
            Borrowing History
        </h2>

        <?php if($borrowingHistory->count() > 0): ?>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="px-4 py-2 text-left">Book Title</th>
                            <th class="px-4 py-2 text-left">Borrow Date</th>
                            <th class="px-4 py-2 text-left">Due Date</th>
                            <th class="px-4 py-2 text-left">Return Date</th>
                            <th class="px-4 py-2 text-left">Fine</th>
                            <th class="px-4 py-2 text-left">Status</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php $__currentLoopData = $borrowingHistory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <tr class="border-b">

                                <td class="px-4 py-3">
                                    <?php echo e($transaction->book->title); ?>

                                </td>

                                <td class="px-4 py-3">
                                    <?php echo e(\Carbon\Carbon::parse($transaction->borrow_date)->format('M d, Y')); ?>

                                </td>

                                <td class="px-4 py-3">
                                    <?php echo e(\Carbon\Carbon::parse($transaction->due_date)->format('M d, Y')); ?>

                                </td>

                                <td class="px-4 py-3">
                                    <?php echo e($transaction->return_date
                                        ? \Carbon\Carbon::parse($transaction->return_date)->format('M d, Y')
                                        : '—'); ?>

                                </td>

                                <td class="px-4 py-3">
                                    <?php
                                        $fine = $transaction->fine_amount ?? 0;
                                        if (empty($fine)) {
                                            $fine = $transaction->calculateFine();
                                        }
                                    ?>

                                    <?php if($fine > 0): ?>
                                        <span class="text-red-600 font-semibold">
                                            ₱<?php echo e(number_format($fine, 2)); ?>

                                        </span>
                                    <?php else: ?>
                                        <span class="text-gray-500">—</span>
                                    <?php endif; ?>
                                </td>

                                <td class="px-4 py-3">
                                    <span class="px-3 py-1 rounded text-xs font-semibold
                                        <?php if($transaction->status === 'borrowed'): ?>
                                            bg-blue-100 text-blue-800
                                        <?php elseif($transaction->status === 'returned'): ?>
                                            bg-green-100 text-green-800
                                        <?php else: ?>
                                            bg-red-100 text-red-800
                                        <?php endif; ?>">
                                        <?php echo e(ucfirst($transaction->status)); ?>

                                    </span>
                                </td>

                            </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </tbody>

                </table>
            </div>

            <?php if($borrowingHistory->total() > 10): ?>
                <div class="mt-4">
                    <?php echo e($borrowingHistory->links()); ?>

                </div>
            <?php endif; ?>

        <?php else: ?>
            <p class="text-gray-500 py-4 text-center">No borrowing history</p>
        <?php endif; ?>

    </div>

    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\websys2\library-management-system - (maayos copy 1)\resources\views/user/dashboard.blade.php ENDPATH**/ ?>