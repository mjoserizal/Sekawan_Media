<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public const DIPAKAI = 0;
    public const READY = 1;
    public const SERVICE = 2;

    public const STATUSES = [
        self::DIPAKAI => 'dipakai',
        self::READY => 'ready',
        self::SERVICE => 'service',
    ];

    public static function statuses()
    {
        return self::STATUSES;
    }

    public function statusLabel()
    {
        $statuses = $this->statuses();

        return isset($this->status) ? $statuses[$this->status] : null;
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
    public function fuelConsumptions()
    {
        return $this->hasMany(FuelConsumption::class, 'car_id');
    }
}
