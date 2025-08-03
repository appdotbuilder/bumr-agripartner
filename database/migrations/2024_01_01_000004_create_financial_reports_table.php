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
        Schema::create('financial_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('partner_id')->constrained()->onDelete('cascade');
            $table->foreignId('rice_field_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('report_period');
            $table->enum('report_type', ['monthly', 'quarterly', 'harvest', 'annual']);
            $table->decimal('investment_amount', 15, 2)->default(0);
            $table->decimal('operational_costs', 15, 2)->default(0);
            $table->decimal('revenue', 15, 2)->default(0);
            $table->decimal('profit_loss', 15, 2)->default(0);
            $table->decimal('yield_kg', 10, 2)->default(0);
            $table->decimal('price_per_kg', 8, 2)->default(0);
            $table->json('cost_breakdown')->nullable();
            $table->json('revenue_breakdown')->nullable();
            $table->text('notes')->nullable();
            $table->enum('status', ['draft', 'finalized', 'audited'])->default('draft');
            $table->timestamps();
            
            $table->index('partner_id');
            $table->index('report_type');
            $table->index('status');
            $table->index(['partner_id', 'report_period']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial_reports');
    }
};