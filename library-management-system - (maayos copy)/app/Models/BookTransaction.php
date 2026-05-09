<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class BookTransaction extends Model
{
    use HasFactory;

    protected $table = 'book_transactions';

    protected $fillable = [
        'borrower_id',
        'book_id',
        'borrow_date',
        'due_date',
        'return_date',
        'status',
        'fine_amount',
        'fine_paid',
    ];

    protected $casts = [
        'borrow_date' => 'datetime',
        'due_date' => 'datetime',
        'return_date' => 'datetime',
        'fine_amount' => 'decimal:2',
    ];

    public function borrower()
    {
        return $this->belongsTo(Borrower::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function isOverdue()
    {
        return $this->status === 'borrowed' && Carbon::now()->isAfter($this->due_date);
    }

  public function calculateFine($dailyRate = 10)
{
    $dueDate = Carbon::parse($this->due_date);

    // If returned, use return_date; otherwise use now()
    $endDate = $this->return_date
        ? Carbon::parse($this->return_date)
        : Carbon::now();

    // If not overdue → no fine
    if ($endDate->lte($dueDate)) {
        return 0;
    }

    $daysOverdue = $dueDate->diffInDays($endDate);

    return $daysOverdue * $dailyRate;
}
}
