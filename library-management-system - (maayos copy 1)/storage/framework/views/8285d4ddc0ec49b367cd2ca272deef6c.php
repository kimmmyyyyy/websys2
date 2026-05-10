<!DOCTYPE html>
<html>
<head>
    <title>Borrowing Report</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h2 { margin-bottom: 10px; }

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
                <td><?php echo e($transaction->borrow_date); ?></td>
                <td><?php echo e($transaction->due_date); ?></td>
                <td><?php echo e(ucfirst($transaction->status)); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<br>

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
</html><?php /**PATH C:\xampp1\htdocs\library-management-system - (maayos v1)\resources\views/admin/reports/borrowing-pdf.blade.php ENDPATH**/ ?>