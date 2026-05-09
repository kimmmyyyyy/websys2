<?php $__env->startSection('title', 'Sign In'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex min-h-[calc(100vh-128px)] items-center justify-center px-4 py-10 sm:px-6 lg:px-8">
    <div class="w-full max-w-md rounded-[2rem] border border-slate-200 bg-white/95 p-8 shadow-xl shadow-slate-200/50">
        <div class="mb-8 text-center">
            <p class="text-sm font-semibold uppercase tracking-[0.35em] text-slate-500">Library access</p>
            <h1 class="mt-4 text-3xl font-semibold text-slate-900">Sign in to your account</h1>
            <p class="mt-3 text-sm text-slate-500">Manage your books, loans, and profile from one polished workspace.</p>
        </div>

        <?php if($errors->any()): ?>
            <div class="mb-6 rounded-3xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-900 shadow-sm">
                <div class="font-semibold">Login failed</div>
                <ul class="mt-3 list-disc space-y-2 pl-5 text-sm text-rose-700">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form class="space-y-6" method="POST" action="<?php echo e(route('login')); ?>">
            <?php echo csrf_field(); ?>
            <div>
                <label for="email" class="block text-sm font-medium text-slate-700">Email address</label>
                <input id="email" name="email" type="email" required value="<?php echo e(old('email')); ?>" class="mt-2 block w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm transition focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100" />
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                <input id="password" name="password" type="password" required class="mt-2 block w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm transition focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-100" />
            </div>

            <button type="submit" class="w-full rounded-2xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2">Sign in</button>
        </form>

        <p class="mt-6 text-center text-sm text-slate-500">Don't have an account? <a href="<?php echo e(route('register')); ?>" class="font-semibold text-slate-900 hover:text-slate-700">Register</a></p>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp1\htdocs\library-management-system - Copy\resources\views/auth/login.blade.php ENDPATH**/ ?>