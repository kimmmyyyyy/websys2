<!DOCTYPE html>
<html>
<head>
    <title>Borrowing Report</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        h2 {
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background: #f3f4f6;
        }

        .status-borrowed {
            color: blue;
            font-weight: bold;
        }

        .status-returned {
            color: green;
            font-weight: bold;
        }

        .status-overdue {
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body>

<h2>Borrowing Report</h2>

<p>
    Date:
    <?php echo e($date ? \Carbon\Carbon::parse($date)->format('F d, Y') : 'All Records'); ?>

</p>

<table>

    <thead>
        <tr>
            <th>Borrower</th>
            <th>Book</th>
            <th>Borrow Date</th>
            <th>Due Date</th>
            <th>Status</th>
        </tr>
    </thead>

    <tbody>

        <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <tr>

                <td><?php echo e($transaction->borrower->user->name); ?></td>

                <td><?php echo e($transaction->book->title); ?></td>

                <td>
                    <?php echo e(\Carbon\Carbon::parse($transaction->borrow_date)->format('M d, Y')); ?>

                </td>

                <td>
                    <?php echo e(\Carbon\Carbon::parse($transaction->due_date)->format('M d, Y')); ?>

                </td>

                <td>

                    <?php if($transaction->status === 'borrowed'): ?>

                        <span class="status-borrowed">
                            Borrowed
                        </span>

                    <?php elseif($transaction->status === 'returned'): ?>

                        <span class="status-returned">
                            Returned
                        </span>

                    <?php else: ?>

                        <span class="status-overdue">
                            Overdue
                        </span>

                    <?php endif; ?>

                </td>

            </tr>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </tbody>

</table>

<br><br>

<h3>Most Borrowed Books</h3>

<table>

    <thead>
        <tr>
            <th>Book</th>
            <th>Total Borrows</th>
        </tr>
    </thead>

    <tbody>

        <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <tr>
                <td><?php echo e($book->book->title); ?></td>
                <td><?php echo e($book->total); ?></td>
            </tr>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </tbody>

</table>

</body>
</html><?php /**PATH C:\xampp1\htdocs\library-management-system - (maayos copy)\resources\views/admin/reports/borrowing-pdf.blade.php ENDPATH**/ ?>