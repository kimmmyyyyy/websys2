<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Library Management System'); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <?php if(auth()->check() && !request()->is('login', 'register')): ?>
        <nav class="bg-white shadow-sm">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 justify-between">
                    <div class="flex items-center">
                        <a href="/" class="text-xl font-bold text-blue-600">LMS</a>
                    </div>
                    <div class="flex items-center space-x-4">
                        <?php if(auth()->user()->isAdmin()): ?>
                            <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-gray-700 hover:text-gray-900">Dashboard</a>
                            <a href="<?php echo e(route('admin.books.index')); ?>" class="text-gray-700 hover:text-gray-900">Books</a>
                            <a href="<?php echo e(route('admin.categories.index')); ?>" class="text-gray-700 hover:text-gray-900">Categories</a>
                            <a href="<?php echo e(route('admin.borrowers.index')); ?>" class="text-gray-700 hover:text-gray-900">Borrowers</a>
                            <a href="<?php echo e(route('admin.reports.borrowing')); ?>" class="text-gray-700 hover:text-gray-900">Reports</a>
                        <?php else: ?>
                            <a href="<?php echo e(route('user.dashboard')); ?>" class="text-gray-700 hover:text-gray-900">My Books</a>
                            <a href="<?php echo e(route('books.search')); ?>" class="text-gray-700 hover:text-gray-900">Search</a>
                            <a href="<?php echo e(route('user.profile')); ?>" class="text-gray-700 hover:text-gray-900">Profile</a>
                        <?php endif; ?>
                        <span class="text-gray-700"><?php echo e(auth()->user()->name); ?></span>
                        <form method="POST" action="<?php echo e(route('logout')); ?>" class="inline">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="text-gray-700 hover:text-gray-900">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
    <?php endif; ?>

    <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <?php if(session('success')): ?>
            <div class="mb-4 rounded-md bg-green-50 p-4">
                <p class="text-sm text-green-700"><?php echo e(session('success')); ?></p>
            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="mb-4 rounded-md bg-red-50 p-4">
                <p class="text-sm text-red-700"><?php echo e(session('error')); ?></p>
            </div>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>
    </main>
</body>
</html>
<?php /**PATH C:\xampp1\htdocs\library-management-system\resources\views/layouts/app.blade.php ENDPATH**/ ?>