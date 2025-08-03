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
        Schema::create('field_updates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rice_field_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('update_type', ['photo', 'video', 'inspection', 'weather', 'pest_disease', 'fertilizer', 'irrigation']);
            $table->text('description');
            $table->json('media_urls')->nullable();
            $table->json('weather_data')->nullable();
            $table->json('growth_metrics')->nullable();
            $table->enum('health_status', ['excellent', 'good', 'fair', 'poor', 'critical'])->nullable();
            $table->text('recommendations')->nullable();
            $table->timestamps();
            
            $table->index('rice_field_id');
            $table->index('update_type');
            $table->index('health_status');
            $table->index(['rice_field_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('field_updates');
    }
};