<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehicle extends Model
{
    use HasFactory;

    protected $table = 'vehicles';

    protected $fillable = [
        'id',
        'plat_no',
        'brand',
        'type',
        'category',
        'status',
        'created_at',
        'updated_at'
    ];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
