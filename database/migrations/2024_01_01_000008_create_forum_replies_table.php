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
        Schema::create('forum_replies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('forum_discussion_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('parent_reply_id')->nullable()->constrained('forum_replies')->onDelete('cascade');
            $table->text('content');
            $table->json('attachments')->nullable();
            $table->boolean('is_solution')->default(false);
            $table->integer('likes_count')->default(0);
            $table->enum('status', ['active', 'edited', 'deleted'])->default('active');
            $table->timestamps();
            
            $table->index('forum_discussion_id');
            $table->index('user_id');
            $table->index('parent_reply_id');
            $table->index('is_solution');
            $table->index(['forum_discussion_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forum_replies');
    }
};