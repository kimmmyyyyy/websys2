<?php $__env->startSection('title', 'Borrowing Report'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Borrowing Report</h1>
        <p class="mt-2 text-gray-600">Current and historical borrowing records</p>
    </div>

    <div class="rounded-lg bg-white shadow">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200 bg-gray-50">
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Borrower</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Book</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Borrow Date</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Due Date</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-b border-gray-100">
                            <td class="px-6 py-4"><?php echo e($transaction->borrower->user->name); ?></td>
                            <td class="px-6 py-4"><?php echo e($transaction->book->title); ?></td>
                            <td class="px-6 py-4"><?php echo e($transaction->borrow_date->format('M d, Y')); ?></td>
                            <td class="px-6 py-4"><?php echo e($transaction->due_date->format('M d, Y')); ?></td>
                            <td class="px-6 py-4">
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
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">No transactions</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="border-t border-gray-200 px-6 py-4">
            <?php echo e($transactions->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\library-management-system\resources\views/admin/reports/borrowing.blade.php ENDPATH**/ ?>