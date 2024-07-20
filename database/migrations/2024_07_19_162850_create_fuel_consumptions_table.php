<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuelConsumptionsTable extends Migration
{
    public function up(): void
    {
        Schema::create('fuel_consumptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id')->constrained()->onDelete('cascade');
            $table->decimal('quantity', 8, 2); // Kuantitas BBM yang dikonsumsi
            $table->decimal('price', 15, 2); // Harga BBM
            $table->date('date'); // Tanggal konsumsi
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fuel_consumptions');
    }
}
