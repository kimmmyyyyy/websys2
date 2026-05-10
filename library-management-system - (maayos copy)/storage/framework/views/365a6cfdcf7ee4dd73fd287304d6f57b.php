

<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-8">

    <!-- HEADER -->
    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

        <div>
            <h1 class="text-4xl font-bold tracking-tight text-slate-900">
                Dashboard
            </h1>

            <p class="mt-2 text-slate-500">
                Viewing data for:

                <span class="font-semibold text-cyan-600">
                    <?php echo e(request('date') 
                        ? \Carbon\Carbon::parse(request('date'))->format('F d, Y') 
                        : now()->format('F d, Y')); ?>

                </span>

                <?php if(request('date') && \Carbon\Carbon::parse(request('date'))->isFuture()): ?>
                    <span class="ml-2 text-sm text-red-500">
                        (No records available for future dates)
                    </span>
                <?php endif; ?>
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

<a href="<?php echo e(route('admin.dashboard', ['all' => 1])); ?>"
   class="rounded-xl bg-cyan-600 px-5 py-2 text-sm font-medium text-white transition hover:bg-cyan-700">
    View All
</a>
    </button>

    <?php if(request('date')): ?>

        <a href="<?php echo e(route('admin.dashboard')); ?>"
           class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-100">
            Reset
        </a>

    <?php endif; ?>

</form>
    </div>

    <!-- SEARCH -->
    <!-- <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">

        <div class="w-full">
            <label class="mb-3 block text-sm font-medium text-slate-700">
                Search Overdue Borrowers or Books
            </label>

            <input
                id="dashboardOverdueSearch"
                type="text"
                placeholder="Search overdue borrower or book..."
                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-3 text-sm shadow-sm transition focus:border-cyan-500 focus:ring-4 focus:ring-cyan-100"
            />

            <div id="dashboardOverdueResults" class="mt-4"></div>
        </div>
    </div> -->

    <!-- STATS -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">

        <!-- TOTAL BOOKS -->
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Total Books</p>

                    <p class="mt-2 text-4xl font-bold text-slate-900">
                        <?php echo e($stats['total_books']); ?>

                    </p>
                </div>

                <div class="rounded-2xl bg-cyan-50 p-4 text-3xl">
                    📚
                </div>
            </div>
        </div>

        <!-- BORROWERS -->
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Total Borrowers</p>

                    <p class="mt-2 text-4xl font-bold text-slate-900">
                        <?php echo e($stats['total_borrowers']); ?>

                    </p>
                </div>

                <div class="rounded-2xl bg-violet-50 p-4 text-3xl">
                    👥
                </div>
            </div>
        </div>

        <!-- BORROWED -->
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Borrowed Books</p>

                    <p class="mt-2 text-4xl font-bold text-slate-900">
                        <?php echo e($stats['total_borrowed_books']); ?>

                    </p>
                </div>

                <div class="rounded-2xl bg-emerald-50 p-4 text-3xl">
                    📖
                </div>
            </div>
        </div>

        <!-- OVERDUE -->
        <div class="rounded-3xl border border-red-100 bg-gradient-to-br from-red-50 to-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-red-500">Overdue Books</p>

                    <p class="mt-2 text-4xl font-bold text-red-600">
                        <?php echo e($stats['overdue_books']); ?>

                    </p>
                </div>

                <div class="rounded-2xl bg-red-100 p-4 text-3xl">
                    ⚠️
                </div>
            </div>
        </div>

    </div>

    <!-- GRAPH -->
    <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">

        <div class="mb-6">
            <h2 class="text-xl font-semibold text-slate-900">
                Activity Overview
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Borrowed, returned, and overdue books in the last 7 days
            </p>
        </div>

        <canvas id="activityChart" height="100"></canvas>
    </div>

    <!-- RECENT TRANSACTIONS -->
    <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">

        <!-- HEADER -->
        <div class="flex flex-col gap-4 border-b border-slate-100 px-8 py-6 lg:flex-row lg:items-center lg:justify-between">

            <div>
                <h2 class="text-xl font-semibold text-slate-900">
                    Book Transactions
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Recent borrowing activity
                </p>
            </div>

            <!-- SEARCH -->
            <div class="w-full lg:w-80">
                <input
                    id="transactionSearch"
                    type="text"
                    placeholder="Search borrower or book..."
                    class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm shadow-sm transition focus:border-cyan-500 focus:ring-4 focus:ring-cyan-100"
                >
            </div>
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

                <tbody id="transactionTable" class="divide-y divide-slate-100">

                    <?php $__empty_1 = true; $__currentLoopData = $recentTransactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                        <tr class="transaction-row transition hover:bg-slate-50">

                            <!-- BORROWER -->
                            <td class="borrower-name px-8 py-5 font-medium text-slate-900">
                                <?php echo e($transaction->borrower->user->name); ?>

                            </td>

                            <!-- BOOK -->
                            <td class="book-title px-8 py-5 text-slate-600">
                                <?php echo e($transaction->book->title); ?>

                            </td>

                           <!-- BORROW DATE -->
<?php
    $borrowDate = \Carbon\Carbon::parse($transaction->borrow_date, 'Asia/Manila');
?>

<td class="px-8 py-5 text-slate-600">
    <div class="font-medium text-slate-900">
        <?php echo e($borrowDate->format('M d, Y')); ?>

    </div>

<div class="text-xs text-slate-400">
    <?php echo e(\Carbon\Carbon::parse($transaction->borrow_time)->format('h:i A')); ?>

</div>
</td>

<!-- DUE DATE -->
<!--<?php
    $dueDate = \Carbon\Carbon::parse($transaction->due_date);
?>

<td class="px-8 py-5 text-slate-600">
    <div class="font-medium text-slate-900">
        <?php echo e($dueDate->format('M d, Y')); ?>

    </div>
    <div class="text-xs text-slate-400">
        <?php echo e($dueDate->format('h:i A')); ?>

    </div>
</td> -->

<td class="px-8 py-5 text-slate-600">
    <div class="font-medium text-slate-900">
        <?php echo e($transaction->due_date?->format('M d, Y')); ?>

    </div>
    <div class="text-xs text-slate-400">
        <?php echo e($transaction->due_date?->format('h:i A')); ?>

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
    </div>

    <!-- FOOTER -->
    <footer class="rounded-3xl border border-slate-200 bg-white px-6 py-8 shadow-sm">

        <div class="flex flex-wrap justify-center gap-6 text-sm font-medium text-slate-500">

            <a href="<?php echo e(route('admin.dashboard')); ?>"
               class="transition hover:text-cyan-600">
                Dashboard
            </a>

            <a href="<?php echo e(route('admin.books.index')); ?>"
               class="transition hover:text-cyan-600">
                Books
            </a>

            <a href="<?php echo e(route('admin.categories.index')); ?>"
               class="transition hover:text-cyan-600">
                Categories
            </a>

            <a href="<?php echo e(route('admin.borrowers.index')); ?>"
               class="transition hover:text-cyan-600">
                Borrowers
            </a>

            <a href="<?php echo e(route('admin.overdue-books')); ?>"
               class="transition hover:text-cyan-600">
                Overdue
            </a>

            <a href="<?php echo e(route('admin.reports.borrowing')); ?>"
               class="transition hover:text-cyan-600">
                Reports
            </a>

        </div>

        <div class="mt-6 text-center text-sm text-slate-400">
            © <?php echo e(date('Y')); ?> Camela. All rights reserved.
        </div>

    </footer>

</div>

<!-- CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const chartData = <?php echo json_encode($chartData, 15, 512) ?>;

    new Chart(document.getElementById('activityChart'), {
        type: 'line',
        data: {
            labels: chartData.labels,
            datasets: [
                {
                    label: 'Borrowed',
                    data: chartData.borrowed,
                    borderWidth: 2,
                    tension: 0.3
                },
                {
                    label: 'Returned',
                    data: chartData.returned,
                    borderWidth: 2,
                    tension: 0.3
                },
                {
                    label: 'Overdue',
                    data: chartData.overdue,
                    borderWidth: 2,
                    tension: 0.3
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                }
            }
        }
    });
</script>

<!-- LIVE SEARCH SCRIPT -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    const input = document.getElementById('dashboardOverdueSearch');
    const container = document.getElementById('dashboardOverdueResults');
    const baseUrl = "<?php echo e(route('admin.overdue-books')); ?>";

    const debounce = (fn, wait = 300) => {
        let t;

        return function () {
            const args = arguments;

            clearTimeout(t);

            t = setTimeout(() => fn.apply(this, args), wait);
        };
    };

    async function fetchResults(q = '', page = 1) {

        const url = new URL(baseUrl, window.location.origin);

        if (q) url.searchParams.set('q', q);
        if (page) url.searchParams.set('page', page);

        const res = await fetch(url.toString(), {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });

        if (!res.ok) {
            container.innerHTML = '';
            return;
        }

        const data = await res.json();

        container.innerHTML = data.table ?? '';

        attachPaginationLinks();
    }

    const debounced = debounce(() => {
        fetchResults(input.value);
    }, 300);

    input.addEventListener('input', debounced);

    function attachPaginationLinks() {

        container.querySelectorAll('a').forEach(a => {

            if (a.href.includes('page=')) {

                a.addEventListener('click', function (e) {

                    e.preventDefault();

                    const page = new URL(a.href).searchParams.get('page');

                    fetchResults(input.value, page);
                });
            }

        });

    }

});
</script>

<!-- TRANSACTION SEARCH -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('transactionSearch');

    const rows = document.querySelectorAll('.transaction-row');

    searchInput.addEventListener('input', function () {

        const value = this.value.toLowerCase();

        rows.forEach(row => {

            const borrower = row.querySelector('.borrower-name')
                .textContent
                .toLowerCase();

            const book = row.querySelector('.book-title')
                .textContent
                .toLowerCase();

            if (
                borrower.includes(value) ||
                book.includes(value)
            ) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }

        });

    });

});
</script>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp1\htdocs\websys2\library-management-system - (maayos copy)\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>