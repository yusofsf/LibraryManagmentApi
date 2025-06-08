<?php

namespace App\Models;

use Database\Factories\BookFactory;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    /** @use HasFactory<BookFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'author',
        'description',
        'page_count',
        'release'
    ];

    /**
     * @return BelongsTo
     */
    public function pubications()
    {
        return $this->belongsTo(Publication::class);
    }

    /**
     * @return HasMany
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }


    /**
     * Scope a query to only include most lent books.
     */
    #[Scope]
    protected function mostLentBooks(Builder $query): void
    {
        $query->join('reservations', 'books.id', '=', 'reservations.book_id')
            ->whereNotNull('reservations.withdrawal_date')
            ->groupBy('books.id', 'books.title')
            ->havingRaw('COUNT(reservations.id) >= 2')
            ->select('books.title', 'reservations.start_date');
    }
}
