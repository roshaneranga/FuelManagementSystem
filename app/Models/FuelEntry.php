<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuelEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'odometer_reading',
        'fuel_price_per_liter',
        'fuel_amount_liters',
        'total_cost',
        'entry_date',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}