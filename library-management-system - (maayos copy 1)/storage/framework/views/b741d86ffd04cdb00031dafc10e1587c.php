<?php $__env->startSection('title', 'Register'); ?>

<?php $__env->startSection('content'); ?>
<div class="relative flex min-h-screen items-center justify-center overflow-hidden bg-gradient-to-br from-slate-100 via-white to-cyan-50 px-4 py-12">

    <!-- Background Glow -->
    <div class="absolute -top-32 left-1/2 h-[1000px] w-[1000px] -translate-x-1/2 rounded-full bg-cyan-200/40 blur-3xl"></div>

    <div class="relative w-full max-w-lg overflow-hidden rounded-[2rem] border border-white/40 bg-white/70 backdrop-blur-xl shadow-[0_20px_70px_rgba(15,23,42,0.15)]">

        <div class="p-10">

            <!-- Header -->
            <div class="mb-8 text-center">

                <p class="text-xs font-semibold uppercase tracking-[0.4em] text-slate-500">
                    Library Management System
                </p>

                <h1 class="mt-4 text-4xl font-bold tracking-tight text-slate-900">
                    Create Account
                </h1>

                <p class="mt-2 text-sm text-slate-500">
                    Start managing your library smarter.
                </p>
            </div>

            <!-- Errors -->
            <?php if($errors->any()): ?>
                <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50/80 p-4">
                    <ul class="space-y-2 text-sm text-rose-700">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>• <?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- Form -->
            <form method="POST" action="<?php echo e(route('register')); ?>" class="space-y-5">
                <?php echo csrf_field(); ?>

                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Full Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="<?php echo e(old('name')); ?>"
                        placeholder="Enter your full name"
                        class="w-full rounded-2xl border border-slate-200 bg-white/80 px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-cyan-500 focus:ring-4 focus:ring-cyan-100"
                    >
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Email Address
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="<?php echo e(old('email')); ?>"
                        placeholder="Enter your email"
                        class="w-full rounded-2xl border border-slate-200 bg-white/80 px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-cyan-500 focus:ring-4 focus:ring-cyan-100"
                    >
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Phone Number
                    </label>

                    <input
                        type="tel"
                        name="phone"
                        value="<?php echo e(old('phone')); ?>"
                        required
                        placeholder="09XXXXXXXXX"
                        class="w-full rounded-2xl border border-slate-200 bg-white/80 px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-cyan-500 focus:ring-4 focus:ring-cyan-100"
                    >
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Address
                    </label>

                    <input
                        type="text"
                        name="address"
                        value="<?php echo e(old('address')); ?>"
                        required
                        placeholder="Enter your address"
                        class="w-full rounded-2xl border border-slate-200 bg-white/80 px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-cyan-500 focus:ring-4 focus:ring-cyan-100"
                    >
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        placeholder="Create password"
                        class="w-full rounded-2xl border border-slate-200 bg-white/80 px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-cyan-500 focus:ring-4 focus:ring-cyan-100"
                    >
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Confirm Password
                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        placeholder="Confirm password"
                        class="w-full rounded-2xl border border-slate-200 bg-white/80 px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-cyan-500 focus:ring-4 focus:ring-cyan-100"
                    >
                </div>

                <button
                    type="submit"
                    class="w-full rounded-2xl bg-slate-900 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-slate-900/20 transition duration-300 hover:-translate-y-0.5 hover:bg-slate-800"
                >
                    Create Account
                </button>
            </form>

            <p class="mt-8 text-center text-sm text-slate-500">
                Already have an account?
                <a href="<?php echo e(route('login')); ?>"
                   class="font-semibold text-slate-900 hover:text-cyan-600">
                    Sign In
                </a>
            </p>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp1\htdocs\library-management-system - (maayos copy)\resources\views/auth/register.blade.php ENDPATH**/ ?>