


<?php $__env->startSection('title', 'Not Registered'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <div class="text-center">
        <h1 class="text-4xl font-bold text-gray-900">Not Registered as Borrower</h1>
        <p class="mt-2 text-lg text-gray-600">You need to register to borrow books</p>
    </div>

    <div class="rounded-lg bg-blue-50 p-8 border-2 border-blue-200 max-w-lg mx-auto text-center">
        <div class="text-5xl mb-4">📚</div>
        <h2 class="text-2xl font-bold text-blue-900 mb-4">Welcome to the Library!</h2>
        <p class="text-blue-800 mb-6">
            You are logged in as <strong><?php echo e(Auth::user()->name); ?></strong>, but you haven't been registered as a borrower yet.
        </p>
        
        <div class="bg-white rounded-lg p-6 mb-6 text-left">
            <h3 class="font-semibold text-gray-900 mb-3">To start borrowing books:</h3>
            <ul class="text-gray-700 space-y-2">
                <li>✓ Contact the library administrator</li>
                <li>✓ Complete the borrower registration form</li>
                <li>✓ Get your membership ID</li>
                <li>✓ Start borrowing books!</li>
            </ul>
        </div>

        <a href="<?php echo e(route('home')); ?>" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded font-medium">
            Go Home
        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp1\htdocs\websys2\library-management-system - (maayos copy)\resources\views/user/not-registered.blade.php ENDPATH**/ ?>