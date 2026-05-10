<?php $__env->startSection('title', 'Categories Management'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Categories</h1>
            <p class="mt-2 text-gray-600">Manage book categories</p>
        </div>
        <a href="<?php echo e(route('admin.categories.create')); ?>" class="rounded-md bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
            Add Category
        </a>
    </div>

    <div class="rounded-lg bg-white shadow">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200 bg-gray-50">
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Name</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Description</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Books</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-b border-gray-100">
                            <td class="px-6 py-4 font-medium"><?php echo e($category->name); ?></td>
                            <td class="px-6 py-4"><?php echo e(Str::limit($category->description, 50)); ?></td>
                            <td class="px-6 py-4">
                                <span class="rounded-full bg-blue-100 px-3 py-1 text-sm font-semibold text-blue-800">
                                    <?php echo e($category->books_count); ?>

                                </span>
                            </td>
                            <td class="space-x-2 px-6 py-4">
                                <a href="<?php echo e(route('admin.categories.edit', $category)); ?>" class="text-blue-600 hover:text-blue-800">Edit</a>
                                <form method="POST" action="<?php echo e(route('admin.categories.destroy', $category)); ?>" class="inline" onsubmit="return confirm('Are you sure?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">No categories found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="border-t border-gray-200 px-6 py-4">
            <?php echo e($categories->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp1\htdocs\library-management-system\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>