<?php $__env->startSection('title', 'Activity Log'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">

    <!-- HEADER -->
    <div>
        <h1 class="text-3xl font-bold text-gray-900">
            My Activity Log
        </h1>

        <p class="mt-1 text-sm text-gray-500">
            View your borrowing and returning activities.
        </p>
    </div>

    <!-- ACTIVITY TABLE -->
    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

        <div class="overflow-x-auto">
            <table class="min-w-full">

                <!-- TABLE HEADER -->
                <thead class="bg-gray-50">
                    <tr class="border-b border-gray-200">

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide text-gray-500">
                            Action
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide text-gray-500">
                            Description
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide text-gray-500">
                            Date & Time
                        </th>

                    </tr>
                </thead>

                <!-- TABLE BODY -->
                <tbody class="divide-y divide-gray-100 bg-white">

                    <?php
                        $filteredLogs = $logs->filter(function ($log) {
                            return in_array($log->action, ['borrow', 'return']);
                        });
                    ?>

                    <?php $__empty_1 = true; $__currentLoopData = $filteredLogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                        <?php
                            $badgeColor = match($log->action) {
                                'borrow' => 'bg-blue-100 text-blue-700',
                                'return' => 'bg-purple-100 text-purple-700',
                                default => 'bg-gray-100 text-gray-700',
                            };
                        ?>

                        <tr class="transition hover:bg-gray-50">

                            <!-- ACTION -->
                            <td class="px-6 py-5">
                                <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold capitalize <?php echo e($badgeColor); ?>">
                                    <?php echo e($log->action); ?>

                                </span>
                            </td>

                            <!-- DESCRIPTION -->
                            <td class="px-6 py-5">
                                <p class="text-sm text-gray-700">
                                    <?php echo e($log->description); ?>

                                </p>
                            </td>

                            <!-- DATE -->
                            <td class="whitespace-nowrap px-6 py-5 text-sm text-gray-600">
                                <div>
                                    <p class="font-medium text-gray-800">
                                        <?php echo e($log->created_at->format('M d, Y')); ?>

                                    </p>

                                    <p class="text-xs text-gray-500">
                                        <?php echo e($log->created_at->format('h:i A')); ?>

                                    </p>
                                </div>
                            </td>

                        </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                        <tr>
                            <td colspan="3" class="px-6 py-12 text-center">

                                <div class="flex flex-col items-center">

                                    <div class="mb-3 rounded-full bg-gray-100 p-4">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-8 w-8 text-gray-400"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor">

                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.5"
                                                d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z" />
                                        </svg>
                                    </div>

                                    <h3 class="text-lg font-semibold text-gray-800">
                                        No Activity Logs
                                    </h3>

                                    <p class="mt-1 text-sm text-gray-500">
                                        No borrowing or returning activities found.
                                    </p>

                                </div>

                            </td>
                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>
        </div>

        <!-- PAGINATION -->
        <?php if($logs->hasPages()): ?>
            <div class="border-t border-gray-200 bg-gray-50 px-6 py-4">
                <?php echo e($logs->links()); ?>

            </div>
        <?php endif; ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp1\htdocs\library-management-system - (maayos copy)\resources\views/admin/reports/activity.blade.php ENDPATH**/ ?>