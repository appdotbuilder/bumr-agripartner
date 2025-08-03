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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('message');
            $table->enum('type', ['info', 'warning', 'success', 'error', 'reminder']);
            $table->enum('category', ['field_update', 'financial', 'insurance', 'event', 'forum', 'system', 'weather_alert']);
            $table->json('data')->nullable();
            $table->string('action_url')->nullable();
            $table->datetime('read_at')->nullable();
            $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('medium');
            $table->boolean('is_broadcast')->default(false);
            $table->timestamps();
            
            $table->index('user_id');
            $table->index('type');
            $table->index('category');
            $table->index('priority');
            $table->index('read_at');
            $table->index(['user_id', 'read_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};