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
        Schema::create('community_events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->enum('event_type', ['workshop', 'training', 'meeting', 'harvest_festival', 'field_day', 'webinar']);
            $table->datetime('event_date');
            $table->datetime('registration_deadline')->nullable();
            $table->string('location')->nullable();
            $table->string('virtual_link')->nullable();
            $table->integer('max_participants')->nullable();
            $table->integer('registered_count')->default(0);
            $table->json('agenda')->nullable();
            $table->json('speakers')->nullable();
            $table->enum('status', ['upcoming', 'ongoing', 'completed', 'cancelled'])->default('upcoming');
            $table->string('organizer_name');
            $table->string('organizer_contact');
            $table->timestamps();
            
            $table->index('event_type');
            $table->index('status');
            $table->index('event_date');
            $table->index(['status', 'event_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('community_events');
    }
};