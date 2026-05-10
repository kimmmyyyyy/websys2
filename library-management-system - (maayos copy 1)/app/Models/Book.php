<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'isbn',
        'category_id',
        'total_copies',
        'available_copies',
        'description',
        'publisher',
        'published_year',
    ];

    protected $casts = [
        'published_year' => 'integer',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function transactions()
    {
        return $this->hasMany(BookTransaction::class);
    }

    public function isAvailable()
    {
        return $this->available_copies > 0;
    }
}
