<?php $__env->startSection('title', 'Overdue Books'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Overdue Books</h1>
        <p class="mt-2 text-gray-600">Books not returned by their due date</p>
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
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Days Overdue</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Fine Amount</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $overdueBooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-b border-gray-100">
                            <td class="px-6 py-4"><?php echo e($transaction->borrower->user->name); ?></td>
                            <td class="px-6 py-4"><?php echo e($transaction->book->title); ?></td>
                            <td class="px-6 py-4"><?php echo e($transaction->borrow_date->format('M d, Y')); ?></td>
                            <td class="px-6 py-4">
                                <span class="font-semibold text-red-600"><?php echo e($transaction->due_date->format('M d, Y')); ?></span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="rounded-full bg-red-100 px-3 py-1 text-sm font-semibold text-red-800">
                                    <?php echo e($transaction->due_date->diffInDays()); ?>

                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-lg font-bold text-red-600">₱<?php echo e(number_format($transaction->calculateFine(), 2)); ?></span>
                            </td>
                            <td class="space-x-2 px-6 py-4">
                                <form method="POST" action="<?php echo e(route('admin.return-book', $transaction)); ?>" class="inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <input type="hidden" name="return_date" value="<?php echo e(date('Y-m-d')); ?>">
                                    <button type="submit" class="text-blue-600 hover:text-blue-800" onclick="return confirm('Mark as returned?')">Return</button>
                                </form>
                                <?php if($transaction->fine_amount > 0 && !$transaction->fine_paid): ?>
                                    <form method="POST" action="<?php echo e(route('admin.mark-fine-paid', $transaction)); ?>" class="inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>
                                        <button type="submit" class="text-green-600 hover:text-green-800" onclick="return confirm('Mark fine as paid?')">Mark Paid</button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">No overdue books</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="border-t border-gray-200 px-6 py-4">
            <?php echo e($overdueBooks->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp1\htdocs\library-management-system - Copy\resources\views/admin/overdue/index.blade.php ENDPATH**/ ?>