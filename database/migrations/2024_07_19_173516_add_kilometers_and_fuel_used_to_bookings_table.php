<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKilometersAndFuelUsedToBookingsTable extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->decimal('kilometers', 8, 2)->nullable(); // Jarak yang ditempuh
            $table->decimal('fuel_used', 8, 2)->nullable(); // BBM yang digunakan
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['kilometers', 'fuel_used']);
        });
    }
}
