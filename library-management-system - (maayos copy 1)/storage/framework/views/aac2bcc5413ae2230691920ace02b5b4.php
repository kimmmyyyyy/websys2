

<?php $__env->startSection('title', 'Borrowing History'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Borrowing History</h1>
        <p class="mt-2 text-gray-600">View your complete borrowing history</p>
    </div>

    <!-- Back to Dashboard -->
    <a href="<?php echo e(route('user.dashboard')); ?>" class="inline-block bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">
        ← Back to Dashboard
    </a>

    <!-- History Table -->
    <?php if($history->count() > 0): ?>
        <div class="rounded-lg bg-white shadow-md border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Book Title</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Author</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Borrowed Date</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Due Date</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Return Date</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Fine</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php $__currentLoopData = $history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900"><?php echo e($transaction->book->title); ?></td>
                                <td class="px-6 py-4 text-sm text-gray-600"><?php echo e($transaction->book->author); ?></td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <?php echo e(\Carbon\Carbon::parse($transaction->borrow_date)->format('M d, Y')); ?>

                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <?php echo e(\Carbon\Carbon::parse($transaction->due_date)->format('M d, Y')); ?>

                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <?php echo e($transaction->return_date ? \Carbon\Carbon::parse($transaction->return_date)->format('M d, Y') : 'Still Borrowed'); ?>

                                </td>
                                <td class="px-6 py-4 text-sm font-medium">
                                    <?php if($transaction->fine_amount > 0): ?>
                                        <span class="text-red-600">₱<?php echo e(number_format($transaction->fine_amount, 2)); ?></span>
                                    <?php else: ?>
                                        <span class="text-gray-600">—</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="inline-block rounded-full px-3 py-1 text-xs font-semibold
                                        <?php if($transaction->status === 'borrowed'): ?>
                                            bg-blue-100 text-blue-800
                                        <?php elseif($transaction->status === 'returned'): ?>
                                            bg-green-100 text-green-800
                                        <?php else: ?>
                                            bg-red-100 text-red-800
                                        <?php endif; ?>
                                    ">
                                        <?php echo e(ucfirst($transaction->status)); ?>

                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="border-t border-gray-200 px-6 py-4 bg-gray-50">
                <?php echo e($history->links()); ?>

            </div>
        </div>
    <?php else: ?>
        <div class="rounded-lg bg-blue-50 p-6 border border-blue-200 text-center">
            <p class="text-blue-800">No borrowing history yet. Start by borrowing a book!</p>
            <a href="<?php echo e(route('books.search')); ?>" class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Browse Books
            </a>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp1\htdocs\library-management-system - Copy\resources\views/user/history.blade.php ENDPATH**/ ?>