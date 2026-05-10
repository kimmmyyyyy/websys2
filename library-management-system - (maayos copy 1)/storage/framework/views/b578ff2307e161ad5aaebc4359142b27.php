<?php $__env->startSection('content'); ?>
<div class="flex min-h-screen items-center justify-center bg-gray-50 px-4 py-12 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8">
        <div>
            <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">
                Create Account
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Join our library system
            </p>
        </div>

        <?php if($errors->any()): ?>
            <div class="rounded-md bg-red-50 p-4">
                <ul class="list-inside list-disc space-y-1 text-sm text-red-700">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form class="space-y-6" method="POST" action="<?php echo e(route('register')); ?>">
            <?php echo csrf_field(); ?>
            
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Full name</label>
                <input id="name" name="name" type="text" required class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm" value="<?php echo e(old('name')); ?>">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                <input id="email" name="email" type="email" required class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm" value="<?php echo e(old('email')); ?>">
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone (optional)</label>
                <input id="phone" name="phone" type="tel" class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm" value="<?php echo e(old('phone')); ?>">
            </div>

            <div>
                <label for="address" class="block text-sm font-medium text-gray-700">Address (optional)</label>
                <input id="address" name="address" type="text" class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm" value="<?php echo e(old('address')); ?>">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" name="password" type="password" required class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm">
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm">
            </div>

            <button type="submit" class="w-full rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Register
            </button>
        </form>

        <p class="text-center text-sm text-gray-600">
            Already have an account?
            <a href="<?php echo e(route('login')); ?>" class="font-medium text-blue-600 hover:text-blue-500">Sign in here</a>
        </p>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\library-management-system\resources\views/auth/register.blade.php ENDPATH**/ ?>