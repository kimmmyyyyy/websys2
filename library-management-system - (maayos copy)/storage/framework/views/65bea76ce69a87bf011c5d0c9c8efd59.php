<?php $__env->startSection('title', 'Borrowers Management'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Borrowers</h1>
            <p class="mt-2 text-gray-600">Manage library borrowers</p>
        </div>
        <a href="<?php echo e(route('admin.borrowers.create')); ?>" class="rounded-md bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
            Register Borrower
        </a>
    </div>

    <div class="rounded-lg bg-white shadow">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200 bg-gray-50">
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Name</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Email</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Membership ID</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Member Since</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Status</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $borrowers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $borrower): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-b border-gray-100">
                            <td class="px-6 py-4"><?php echo e($borrower->user->name); ?></td>
                            <td class="px-6 py-4"><?php echo e($borrower->user->email); ?></td>
                            <td class="px-6 py-4 font-mono text-sm"><?php echo e($borrower->membership_id); ?></td>
                            <td class="px-6 py-4"><?php echo e($borrower->membership_date->format('M d, Y')); ?></td>
                            <td class="px-6 py-4">
                                <?php if($borrower->status === 'active'): ?>
                                    <span class="inline-block rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-800">Active</span>
                                <?php elseif($borrower->status === 'suspended'): ?>
                                    <span class="inline-block rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-800">Suspended</span>
                                <?php else: ?>
                                    <span class="inline-block rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-800">Inactive</span>
                                <?php endif; ?>
                            </td>
                            <td class="space-x-2 px-6 py-4">
                                <a href="<?php echo e(route('admin.borrowers.edit', $borrower)); ?>" class="text-blue-600 hover:text-blue-800">Edit</a>
                                <form method="POST" action="<?php echo e(route('admin.borrowers.destroy', $borrower)); ?>" class="inline" onsubmit="return confirm('Are you sure?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">No borrowers found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="border-t border-gray-200 px-6 py-4">
            <?php echo e($borrowers->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp1\htdocs\library-management-system\resources\views/admin/borrowers/index.blade.php ENDPATH**/ ?>