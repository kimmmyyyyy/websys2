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
    {{ $date ? \Carbon\Carbon::parse($date)->format('F d, Y') : 'All Records' }}
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

        @foreach ($transactions as $transaction)

            <tr>

                <td>{{ $transaction->borrower->user->name }}</td>

                <td>{{ $transaction->book->title }}</td>

                <td>
                    {{ \Carbon\Carbon::parse($transaction->borrow_date)->format('M d, Y') }}
                </td>

                <td>
                    {{ \Carbon\Carbon::parse($transaction->due_date)->format('M d, Y') }}
                </td>

                <td>

                    @if($transaction->status === 'borrowed')

                        <span class="status-borrowed">
                            Borrowed
                        </span>

                    @elseif($transaction->status === 'returned')

                        <span class="status-returned">
                            Returned
                        </span>

                    @else

                        <span class="status-overdue">
                            Overdue
                        </span>

                    @endif

                </td>

            </tr>

        @endforeach

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

        @foreach ($books as $book)

            <tr>
                <td>{{ $book->book->title }}</td>
                <td>{{ $book->total }}</td>
            </tr>

        @endforeach

    </tbody>

</table>

</body>
</html>