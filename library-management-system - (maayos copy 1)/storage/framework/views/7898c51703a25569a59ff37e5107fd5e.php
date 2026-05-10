<?php $__env->startSection('title', 'Add Category'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Add New Category</h1>
    </div>

    <div class="rounded-lg bg-white p-6 shadow">
        <form method="POST" action="<?php echo e(route('admin.categories.store')); ?>" class="space-y-6">
            <?php echo csrf_field(); ?>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Category Name</label>
                <input type="text" name="name" id="name" required class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2" value="<?php echo e(old('name')); ?>">
                <?php $__errorArgs = ['name'];
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
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="4" class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2"><?php echo e(old('description')); ?></textarea>
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="rounded-md bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
                    Add Category
                </button>
                <a href="<?php echo e(route('admin.categories.index')); ?>" class="rounded-md border border-gray-300 px-4 py-2 text-gray-700 hover:bg-gray-50">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp1\htdocs\library-management-system\resources\views/admin/categories/create.blade.php ENDPATH**/ ?>