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
        Schema::create('rice_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('partner_id')->constrained()->onDelete('cascade');
            $table->string('field_name');
            $table->text('location');
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->decimal('area_hectares', 8, 2);
            $table->string('rice_variety');
            $table->date('planting_date');
            $table->date('expected_harvest_date');
            $table->enum('status', ['planted', 'growing', 'mature', 'harvested'])->default('planted');
            $table->decimal('expected_yield_tons', 8, 2)->nullable();
            $table->decimal('actual_yield_tons', 8, 2)->nullable();
            $table->json('weather_conditions')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->index('partner_id');
            $table->index('status');
            $table->index('planting_date');
            $table->index(['partner_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rice_fields');
    }
};