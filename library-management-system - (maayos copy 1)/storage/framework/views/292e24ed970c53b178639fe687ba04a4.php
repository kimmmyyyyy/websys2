<div class="overflow-x-auto">
    <table class="w-full">
        <thead>
            <tr class="border-b border-gray-200 bg-gray-50">
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Title</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Author</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Category</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">ISBN</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Copies</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Available</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="border-b border-gray-100">
                    <td class="px-6 py-4"><?php echo e($book->title); ?></td>
                    <td class="px-6 py-4"><?php echo e($book->author); ?></td>
                    <td class="px-6 py-4"><?php echo e($book->category->name); ?></td>
                    <td class="px-6 py-4"><?php echo e($book->isbn); ?></td>
                    <td class="px-6 py-4"><?php echo e($book->total_copies); ?></td>
                    <td class="px-6 py-4">
                        <span class="rounded-full px-3 py-1 text-sm <?php echo e($book->available_copies > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'); ?>">
                            <?php echo e($book->available_copies); ?>

                        </span>
                    </td>
                    <td class="space-x-2 px-6 py-4">
                        <a href="<?php echo e(route('admin.books.edit', $book)); ?>" class="text-blue-600 hover:text-blue-800">Edit</a>
                        <form method="POST" action="<?php echo e(route('admin.books.destroy', $book)); ?>" class="inline" onsubmit="return confirm('Are you sure?')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">No books found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<div class="border-t border-gray-200 px-6 py-4">
    <?php echo e($books->links()); ?>

</div>
<?php /**PATH C:\xampp1\htdocs\library-management-system - (maayos v1)\resources\views/admin/books/partials/books-list.blade.php ENDPATH**/ ?>