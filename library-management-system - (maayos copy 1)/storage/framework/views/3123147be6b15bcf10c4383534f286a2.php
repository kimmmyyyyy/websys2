<?php $__env->startSection('title', 'Search Books'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Search Books</h1>
        <p class="mt-2 text-gray-600">Find books by title, author, or ISBN</p>
    </div>

    <form method="GET" action="<?php echo e(route('books.search')); ?>" class="flex gap-2">
        <input type="text" name="q" placeholder="Search..." value="<?php echo e(request('q')); ?>" class="flex-1 rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm text-gray-900 focus:border-blue-500 focus:outline-none" />
        <button type="submit" class="rounded-lg bg-blue-600 px-6 py-2 text-sm font-semibold text-white hover:bg-blue-700">
            Search
        </button>
    </form>

    <?php if($books->count() > 0): ?>
        <div>
            <p class="mb-4 text-sm text-gray-600">Found <?php echo e($books->total()); ?> book<?php echo e($books->total() !== 1 ? 's' : ''); ?></p>
            <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex flex-col rounded-lg border border-gray-200 bg-white p-4">
                        <h3 class="font-semibold text-gray-900 line-clamp-2"><?php echo e($book->title); ?></h3>
                        <p class="mt-1 text-sm text-gray-600">by <?php echo e($book->author); ?></p>
                        <div class="mt-3 text-xs text-gray-500 space-y-1">
                            <p>ISBN: <?php echo e($book->isbn); ?></p>
                            <p>Category: <?php echo e($book->category->name ?? 'N/A'); ?></p>
                            <p>Year: <?php echo e($book->publication_year ?? 'N/A'); ?></p>
                        </div>
                        <p class="mt-3 grow text-sm text-gray-600 line-clamp-2"><?php echo e($book->description ?? 'No description'); ?></p>
                        <div class="mt-4 border-t border-gray-200 pt-4">
                            <?php if($book->available_copies > 0): ?>
                                <p class="mb-3 text-sm font-medium text-green-600">✓ Available (<?php echo e($book->available_copies); ?> copies)</p>
                                <form method="POST" action="<?php echo e(route('book.request-borrow')); ?>" class="w-full">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="book_id" value="<?php echo e($book->id); ?>">
                                    <button type="submit" class="w-full rounded-lg bg-blue-600 px-3 py-2 text-sm font-semibold text-white hover:bg-blue-700">
                                        Borrow
                                    </button>
                                </form>
                            <?php else: ?>
                                <p class="mb-3 text-sm font-medium text-red-600">✗ Not available</p>
                                <button disabled class="w-full rounded-lg bg-gray-200 px-3 py-2 text-sm text-gray-500 cursor-not-allowed">
                                    Unavailable
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="mt-6"><?php echo e($books->links()); ?></div>
        </div>
    <?php elseif(request('q')): ?>
        <div class="rounded-lg border border-yellow-200 bg-yellow-50 p-4 text-center text-sm text-yellow-800">
            No books found for "<?php echo e(request('q')); ?>". Try a different search.
        </div>
    <?php else: ?>
        <div class="rounded-lg border border-gray-200 bg-gray-50 p-4 text-center text-sm text-gray-600">
            Enter a search term to find books.
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp1\htdocs\library-management-system - Copy\resources\views/user/search.blade.php ENDPATH**/ ?>