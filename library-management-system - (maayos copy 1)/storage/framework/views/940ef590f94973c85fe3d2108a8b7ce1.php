<?php $__env->startSection('title', 'Overdue Books'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">

    <!-- PAGE TITLE -->
    <div>
        <h1 class="text-3xl font-bold text-gray-900">
            Overdue Books
        </h1>
    </div>

    <!-- TABLE CONTAINER -->
    <div class="bg-white rounded-xl shadow overflow-hidden">

        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-gray-200">

                <!-- TABLE HEADER -->
                <thead class="bg-gray-50">
                    <tr>

                        <th scope="col"
                            class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wide">
                            Borrower
                        </th>

                        <th scope="col"
                            class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wide">
                            Book
                        </th>

                        <th scope="col"
                            class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wide">
                            Borrow Date
                        </th>

                        <th scope="col"
                            class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wide">
                            Due Date
                        </th>

                        <th scope="col"
                            class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wide">
                            Days Overdue
                        </th>

                        <th scope="col"
                            class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wide">
                            Fine Amount
                        </th>

                        <th scope="col"
                            class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wide">
                            Manage Due Date
                        </th>

                        <th scope="col"
                            class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wide">
                            Actions
                        </th>

                    </tr>
                </thead>

                <!-- TABLE BODY -->
                <tbody class="divide-y divide-gray-100 bg-white">

                    <?php $__empty_1 = true; $__currentLoopData = $overdueBooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                    <tr class="hover:bg-gray-50 transition">

                        <!-- BORROWER -->
                        <td class="px-6 py-4 text-sm text-gray-800">
                            <?php echo e($transaction->borrower->user->name ?? 'N/A'); ?>

                        </td>

                        <!-- BOOK -->
                        <td class="px-6 py-4 text-sm text-gray-800">
                            <?php echo e($transaction->book->title ?? 'N/A'); ?>

                        </td>

                        <!-- BORROW DATE -->
                        <td class="px-6 py-4 text-sm text-gray-700">
                            <?php echo e($transaction->borrow_date ? $transaction->borrow_date->format('M d, Y') : 'N/A'); ?>

                        </td>

                 

                        <!-- DUE DATE -->
                        <td class="px-6 py-4 text-sm font-semibold text-red-600">
                            <?php echo e($transaction->due_date ? $transaction->due_date->format('M d, Y') : 'N/A'); ?>

                        </td>

                        <!-- DAYS OVERDUE -->
                        <!-- <td class="px-6 py-4 text-sm text-gray-700">
                            <?php echo e($transaction->due_date ? $transaction->due_date->diffInDays(now()) : 0); ?> day(s)
                        </td> -->
                           <!-- DAYS OVERDUE -->
<td class="px-6 py-4 text-sm text-gray-700">
    <?php echo e($transaction->due_date ? abs((int) now()->diffInDays($transaction->due_date, false)) : 0); ?> day(s)
</td>

                        <!-- FINE AMOUNT -->
                        <td class="px-6 py-4 text-sm font-bold text-red-600">
                            ₱<?php echo e(number_format($transaction->calculateFine(), 2)); ?>

                        </td>

                        <!-- UPDATE DUE DATE -->
                        <td class="px-6 py-4">

                            <form method="POST"
                                  action="<?php echo e(route('admin.update-due-date', $transaction)); ?>"
                                  class="flex items-center gap-2">

                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>

                                <input type="date"
                                       name="due_date"
                                       value="<?php echo e($transaction->due_date ? $transaction->due_date->format('Y-m-d') : ''); ?>"
                                       class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring focus:ring-blue-200">

                                <button type="submit"
                                        class="bg-gray-800 hover:bg-gray-900 text-white text-xs px-3 py-2 rounded-lg transition">
                                    Update
                                </button>

                            </form>

                        </td>

                        <!-- ACTIONS -->
                        <td class="px-6 py-4">

                            <div class="flex flex-col gap-2">

                                <!-- RETURN BOOK -->
                                <form method="POST"
                                      action="<?php echo e(route('admin.return-book', $transaction)); ?>">

                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>

                                    <button type="submit"
                                            onclick="return confirm('Return this book?')"
                                            class="text-blue-600 hover:text-blue-800 hover:underline text-sm">
                                        Return Book
                                    </button>

                                </form>

                                <!-- MARK FINE PAID -->
                                <?php if(!$transaction->fine_paid && $transaction->fine_amount > 0): ?>

                                <form method="POST"
                                      action="<?php echo e(route('admin.mark-fine-paid', $transaction)); ?>">

                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>

                                    <button type="submit"
                                            class="text-green-600 hover:text-green-800 hover:underline text-sm">
                                        Mark Fine Paid
                                    </button>

                                </form>

                                <?php endif; ?>

                            </div>

                        </td>

                    </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                    <!-- EMPTY STATE -->
                    <tr>
                        <td colspan="8"
                            class="px-6 py-10 text-center text-gray-500 text-sm">
                            No overdue books found.
                        </td>
                    </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>

        <!-- PAGINATION -->
        <div class="border-t border-gray-200 px-6 py-4 bg-gray-50">
            <?php echo e($overdueBooks->links()); ?>

        </div>

    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp1\htdocs\library-management-system - (maayos copy)\resources\views/admin/overdue/index.blade.php ENDPATH**/ ?>