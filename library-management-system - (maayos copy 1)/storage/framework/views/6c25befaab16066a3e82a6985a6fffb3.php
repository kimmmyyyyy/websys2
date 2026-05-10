<?php $__env->startSection('title', 'Edit Borrower'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Edit Borrower</h1>
    </div>

    <div class="rounded-lg bg-white p-6 shadow">
        <form method="POST" action="<?php echo e(route('admin.borrowers.update', $borrower)); ?>" class="space-y-6">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div>
                <label class="block text-sm font-medium text-gray-700">User</label>
                <input type="text" disabled class="mt-1 block w-full rounded-md border border-gray-300 bg-gray-100 px-3 py-2" value="<?php echo e($borrower->user->name); ?>">
            </div>

            <div>
                <label for="membership_date" class="block text-sm font-medium text-gray-700">Membership Date</label>
                <input type="date" name="membership_date" id="membership_date" required class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2" value="<?php echo e(old('membership_date', $borrower->membership_date->format('Y-m-d'))); ?>">
                <?php $__errorArgs = ['membership_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status" required class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2">
                    <option value="active" <?php echo e(old('status', $borrower->status) === 'active' ? 'selected' : ''); ?>>Active</option>
                    <option value="inactive" <?php echo e(old('status', $borrower->status) === 'inactive' ? 'selected' : ''); ?>>Inactive</option>
                    <option value="suspended" <?php echo e(old('status', $borrower->status) === 'suspended' ? 'selected' : ''); ?>>Suspended</option>
                </select>
                <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="rounded-md bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
                    Update Borrower
                </button>
                <a href="<?php echo e(route('admin.borrowers.index')); ?>" class="rounded-md border border-gray-300 px-4 py-2 text-gray-700 hover:bg-gray-50">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\library-management-system\resources\views/admin/borrowers/edit.blade.php ENDPATH**/ ?>