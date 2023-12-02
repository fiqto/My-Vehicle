<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Approvals extends Model
{
    use HasFactory;

    protected $table = 'approvals';

    protected $fillable = [
        'id',
        'booking_id',
        'user_id',
        'status',
        'created_at',
        'updated_at'
    ];

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
