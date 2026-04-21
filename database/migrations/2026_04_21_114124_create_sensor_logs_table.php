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
    Schema::create('sensor_logs', function (Blueprint $table) {
        $table->id();
        $table->float('water_level'); // Data ketinggian air [cite: 576]
        $table->float('water_flow')->nullable(); // Kecepatan arus [cite: 266]
        $table->boolean('is_raining')->default(false); // Status hujan [cite: 266]
        $table->string('status'); // Aman, Siaga, atau Bahaya [cite: 576]
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sensor_logs');
    }
};
