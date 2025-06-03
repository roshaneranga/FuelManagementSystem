<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fuel_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained()->onDelete('cascade'); // Foreign key
            $table->decimal('odometer_reading', 10, 2); // 10 total digits, 2 after decimal
            $table->decimal('fuel_price_per_liter', 8, 2);
            $table->decimal('fuel_amount_liters', 8, 2);
            $table->decimal('total_cost', 10, 2);
            $table->date('entry_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fuel_entries');
    }
};