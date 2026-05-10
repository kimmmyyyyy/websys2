

<?php $__env->startSection('title', 'Search Books'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Search Books</h1>
    </div>

    <!-- Search Form -->
    <div class="rounded-lg bg-white p-6 shadow">
        <form method="GET" action="<?php echo e(route('books.search')); ?>" class="flex gap-4">
            <input 
                type="text" 
                name="q" 
                placeholder="Search by title, author, or ISBN..." 
                class="flex-1 rounded-md border border-gray-300 px-4 py-2"
                value="<?php echo e(request('q')); ?>"
            >
            <button type="submit" class="rounded-md bg-blue-600 px-6 py-2 text-white hover:bg-blue-700">
                Search
            </button>
        </form>
    </div>

    <!-- Search Results -->
    <?php if($books->count() > 0): ?>
        <div>
            <h2 class="text-lg font-semibold text-gray-900 mb-4">
                Found <?php echo e($books->total()); ?> book<?php echo e($books->total() !== 1 ? 's' : ''); ?>

                <?php if($query): ?>
                    for "<?php echo e($query); ?>"
                <?php endif; ?>
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="rounded-lg bg-white p-6 shadow-md border border-gray-200 hover:shadow-lg transition flex flex-col">
                        <h3 class="text-lg font-bold text-gray-900 line-clamp-2"><?php echo e($book->title); ?></h3>
                        <p class="text-sm text-gray-600 mt-1">by <?php echo e($book->author); ?></p>
                        
                        <div class="mt-3 text-xs text-gray-500 space-y-1">
                            <p><strong>ISBN:</strong> <?php echo e($book->isbn); ?></p>
                            <p><strong>Category:</strong> <?php echo e($book->category->name ?? 'N/A'); ?></p>
                            <p><strong>Published:</strong> <?php echo e($book->publication_year ?? 'N/A'); ?></p>
                        </div>

                        <p class="mt-3 text-sm text-gray-700 line-clamp-3"><?php echo e($book->description ?? 'No description available'); ?></p>

                        <div class="mt-auto pt-4 border-t border-gray-200">
                            <?php if($book->available_copies > 0): ?>
                                <p class="text-sm font-medium text-green-600 mb-3">
                                    ✓ Available (<?php echo e($book->available_copies); ?> copies)
                                </p>
                                <form method="POST" action="<?php echo e(route('book.request-borrow')); ?>" class="inline-block w-full">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="book_id" value="<?php echo e($book->id); ?>">
                                    <button type="submit" class="w-full rounded-md bg-blue-600 hover:bg-blue-700 text-white py-2 font-medium transition">
                                        Borrow This Book
                                    </button>
                                </form>
                            <?php else: ?>
                                <p class="text-sm font-medium text-red-600 mb-3">
                                    ✗ Currently Unavailable
                                </p>
                                <button disabled class="w-full rounded-md bg-gray-300 text-gray-600 py-2 font-medium cursor-not-allowed">
                                    Not Available
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                <?php echo e($books->links()); ?>

            </div>
        </div>
    <?php elseif(request('q')): ?>
        <div class="rounded-lg bg-yellow-50 p-6 border border-yellow-200 text-center">
            <p class="text-yellow-800">No books found for "<?php echo e($query); ?>". Try a different search term.</p>
        </div>
    <?php else: ?>
        <div class="rounded-lg bg-blue-50 p-6 border border-blue-200 text-center">
            <p class="text-blue-800">Enter a search term or browse all available books</p>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp1\htdocs\websys2\library-management-system - (maayos copy)\resources\views/user/search.blade.php ENDPATH**/ ?>