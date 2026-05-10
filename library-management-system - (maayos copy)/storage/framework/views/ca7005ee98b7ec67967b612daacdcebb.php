

<?php $__env->startSection('title', 'Borrowing Report'); ?>

<?php $__env->startSection('content'); ?>

<div class="space-y-8">

    <!-- HEADER -->
    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

        <div>
            <h1 class="text-3xl font-bold text-slate-900">
                Borrowing Report
            </h1>

            <p class="mt-2 text-sm text-slate-500">
                View borrowing transactions and most borrowed books
            </p>
        </div>

        <!-- DATE FILTER -->
       <!-- DATE FILTER -->
<form method="GET"
      class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-white p-3 shadow-sm">

    <input
        type="date"
        name="date"
        value="<?php echo e(request('date', now()->format('Y-m-d'))); ?>"
        class="rounded-xl border-slate-200 bg-slate-50 text-sm shadow-sm focus:border-cyan-500 focus:ring-cyan-500"
    >

    <button
        type="submit"
        class="rounded-xl bg-slate-900 px-5 py-2 text-sm font-medium text-white transition hover:bg-slate-800"
    >
        Filter
    </button>
    <a href="<?php echo e(route('admin.reports.borrowing', ['all' => 1])); ?>"
   class="rounded-xl bg-cyan-600 px-5 py-2 text-sm font-medium text-white transition hover:bg-cyan-700">
    View All
</a>
<a href="<?php echo e(route('admin.reports.borrowing.export', request()->query())); ?>"
   class="rounded-xl bg-red-600 px-5 py-2 text-sm font-medium text-white transition hover:bg-red-700">
    Export PDF
</a>


</form>

    </div>

    <!-- MOST BORROWED BOOKS GRAPH -->
    <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">

        <div class="mb-6">
            <h2 class="text-xl font-semibold text-slate-900">
                Most Borrowed Books
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Top borrowed books for
              Top borrowed books for
<span class="font-semibold text-cyan-600">
    <?php echo e(request('date')
            ? \Carbon\Carbon::parse(request('date'))->format('F d, Y')
            : now()->format('F d, Y')); ?>

</span>
            </p>
        </div>

        <canvas id="mostBorrowedChart" height="120"></canvas>

    </div>

    <!-- TABLE -->
    <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">

        <!-- TABLE HEADER -->
        <div class="border-b border-slate-100 px-8 py-6">

            <h2 class="text-xl font-semibold text-slate-900">
                Borrowing Transactions
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Recent borrowing activity
            </p>

        </div>

        <!-- TABLE -->
        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-slate-50">

                    <tr>

                        <th class="px-8 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Borrower
                        </th>

                        <th class="px-8 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Book
                        </th>

                        <th class="px-8 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Borrow Date
                        </th>

                        <th class="px-8 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Due Date
                        </th>

                        <th class="px-8 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Status
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-slate-100">

                    <?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                        <tr class="transition hover:bg-slate-50">

                            <!-- BORROWER -->
                            <td class="px-8 py-5 font-medium text-slate-900">
                                <?php echo e($transaction->borrower->user->name); ?>

                            </td>

                            <!-- BOOK -->
                            <td class="px-8 py-5 text-slate-600">
                                <?php echo e($transaction->book->title); ?>

                            </td>

                            <!-- BORROW DATE -->
                            <td class="px-8 py-5 text-slate-600">
                                <?php echo e(\Carbon\Carbon::parse($transaction->borrow_date)->format('M d, Y')); ?>

                                <div class="text-xs text-slate-400">
    <?php echo e(\Carbon\Carbon::parse($transaction->borrow_time)->format('h:i A')); ?>

</div>
</td>
                            </td>

                            <!-- DUE DATE -->
                            <td class="px-8 py-5 text-slate-600">
                                <?php echo e(\Carbon\Carbon::parse($transaction->due_date)->format('M d, Y')); ?>

                                <div class="text-xs text-slate-400">
    <?php echo e(\Carbon\Carbon::parse($transaction->due_date)->format('h:i A')); ?>

            </div>
                            </td>

                            <!-- STATUS -->
                            <td class="px-8 py-5">

                                <?php if($transaction->status === 'borrowed'): ?>

                                    <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
                                        Borrowed
                                    </span>

                                <?php elseif($transaction->status === 'returned'): ?>

                                    <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                        Returned
                                    </span>

                                <?php else: ?>

                                    <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                        Overdue
                                    </span>

                                <?php endif; ?>

                            </td>

                        </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                        <tr>

                            <td colspan="5" class="px-8 py-10 text-center text-slate-500">
                                No transactions found
                            </td>

                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>

        <!-- PAGINATION -->
        <div class="border-t border-slate-200 px-6 py-4">
            <?php echo e($transactions->appends(request()->query())->links()); ?>

        </div>

    </div>

</div>

<!-- CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

    const chartData = <?php echo json_encode($chartData, 15, 512) ?>;

    new Chart(document.getElementById('mostBorrowedChart'), {

        type: 'bar',

        data: {

            labels: chartData.labels,

            datasets: [{
                label: 'Times Borrowed',

                data: chartData.totals,

                backgroundColor: [
                    '#06B6D4',
                    '#3B82F6',
                    '#8B5CF6',
                    '#10B981',
                    '#F59E0B',
                    '#EF4444',
                    '#EC4899',
                    '#6366F1',
                    '#14B8A6',
                    '#84CC16'
                ],

                borderRadius: 10,
                borderSkipped: false
            }]
        },

        options: {

            responsive: true,

            plugins: {

                legend: {
                    display: false
                }

            },

            scales: {

                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }

            }

        }

    });

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\websys2\library-management-system - (maayos copy)\resources\views/admin/reports/borrowing.blade.php ENDPATH**/ ?>