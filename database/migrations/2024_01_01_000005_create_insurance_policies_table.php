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
        Schema::create('insurance_policies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('partner_id')->constrained()->onDelete('cascade');
            $table->string('policy_number')->unique();
            $table->string('insurance_provider');
            $table->enum('policy_type', ['crop', 'weather', 'multi_peril', 'revenue']);
            $table->decimal('coverage_amount', 15, 2);
            $table->decimal('premium_amount', 10, 2);
            $table->date('policy_start_date');
            $table->date('policy_end_date');
            $table->enum('status', ['active', 'expired', 'claimed', 'cancelled'])->default('active');
            $table->json('coverage_details')->nullable();
            $table->json('risk_factors')->nullable();
            $table->text('terms_conditions')->nullable();
            $table->timestamps();
            
            $table->index('partner_id');
            $table->index('policy_number');
            $table->index('status');
            $table->index(['partner_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insurance_policies');
    }
};