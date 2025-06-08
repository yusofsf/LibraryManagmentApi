<?php

namespace App\Models;

use Database\Factories\PenaltyFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class penalty extends Model
{
    /** @use HasFactory<PenaltyFactory> */
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'amount',
        'days'
    ];

    /**
     * @return BelongsTo
     */
    public function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class);
    }
}
