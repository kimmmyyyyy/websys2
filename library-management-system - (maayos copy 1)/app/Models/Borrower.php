<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrower extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'membership_id',
        'membership_date',
        'status',
    ];

    protected $casts = [
        'membership_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(BookTransaction::class);
    }

    public function borrowedBooks()
    {
        return $this->hasManyThrough(Book::class, BookTransaction::class);
    }

    public function activeBorrows()
    {
        return $this->transactions()
            ->where(function ($query) {
                $query->where('status', 'borrowed')
                      ->orWhere('status', 'overdue');
            });
    }
}