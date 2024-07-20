<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuelConsumption extends Model
{
    use HasFactory;

    protected $fillable = ['car_id', 'quantity', 'price', 'date'];
    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id');
    }
}
