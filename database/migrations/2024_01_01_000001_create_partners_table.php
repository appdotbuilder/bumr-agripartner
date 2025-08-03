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
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('partner_code')->unique();
            $table->string('organization_name');
            $table->string('contact_person');
            $table->string('phone');
            $table->text('address');
            $table->string('region');
            $table->enum('status', ['active', 'inactive', 'pending'])->default('pending');
            $table->json('certification_documents')->nullable();
            $table->decimal('total_investment', 15, 2)->default(0);
            $table->decimal('total_returns', 15, 2)->default(0);
            $table->timestamps();
            
            $table->index('partner_code');
            $table->index('status');
            $table->index('region');
            $table->index(['status', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partners');
    }
};