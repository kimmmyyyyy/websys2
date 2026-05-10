

<?php $__env->startSection('title', 'Categories Management'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-8">

    <!-- HEADER -->
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

        <div>
            <h1 class="text-4xl font-bold tracking-tight text-slate-900">
                Book Categories
            </h1>
            <p class="mt-1 text-sm text-slate-500">
                Organize and manage your library classifications
            </p>
        </div>

        <a href="<?php echo e(route('admin.categories.create')); ?>"
           class="inline-flex items-center gap-2 rounded-2xl bg-slate-900 px-5 py-3 text-sm font-medium text-white shadow-sm hover:bg-slate-800">
            + Add Category
        </a>

    </div>

    <!-- TABLE CARD -->
    <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <!-- HEADER -->
                <thead class="bg-slate-50">
                    <tr class="text-left text-xs font-semibold uppercase tracking-wider text-slate-500">

                        <th class="px-6 py-4">Name</th>
                        <th class="px-6 py-4">Description</th>
                        <th class="px-6 py-4">Books</th>
                        <th class="px-6 py-4">Actions</th>

                    </tr>
                </thead>

                <!-- BODY -->
                <tbody class="divide-y divide-slate-100">

                    <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                        <tr class="transition hover:bg-slate-50">

                            <!-- NAME -->
                            <td class="px-6 py-4 font-medium text-slate-900">
                                <?php echo e($category->name); ?>

                            </td>

                            <!-- DESCRIPTION -->
                            <td class="px-6 py-4 text-slate-600">
                                <?php echo e(Str::limit($category->description, 60)); ?>

                            </td>

                            <!-- BOOK COUNT -->
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full bg-cyan-50 px-3 py-1 text-xs font-semibold text-cyan-700">
                                    <?php echo e($category->books_count); ?>

                                </span>
                            </td>

                            <!-- ACTIONS -->
                            <td class="px-6 py-4 flex items-center gap-4">

                                <a href="<?php echo e(route('admin.categories.edit', $category)); ?>"
                                   class="font-medium text-cyan-600 hover:underline">
                                    Edit
                                </a>

                                <form method="POST"
                                      action="<?php echo e(route('admin.categories.destroy', $category)); ?>"
                                      onsubmit="return confirm('Are you sure you want to delete this category?')">

                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>

                                    <button class="font-medium text-red-500 hover:underline">
                                        Delete
                                    </button>

                                </form>

                            </td>

                        </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-slate-500">
                                No categories found
                            </td>
                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>

        <!-- PAGINATION -->
        <div class="border-t border-slate-100 px-6 py-4">
            <?php echo e($categories->links()); ?>

        </div>

    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp1\htdocs\websys2\library-management-system - (maayos copy)\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>