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
        Schema::create('forum_discussions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('content');
            $table->enum('category', ['general', 'technical', 'market_prices', 'weather', 'pest_control', 'equipment', 'finance']);
            $table->json('tags')->nullable();
            $table->integer('views_count')->default(0);
            $table->integer('replies_count')->default(0);
            $table->datetime('last_activity')->nullable();
            $table->boolean('is_pinned')->default(false);
            $table->boolean('is_locked')->default(false);
            $table->enum('status', ['active', 'archived', 'deleted'])->default('active');
            $table->timestamps();
            
            $table->index('user_id');
            $table->index('category');
            $table->index('status');
            $table->index('is_pinned');
            $table->index(['category', 'last_activity']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forum_discussions');
    }
};