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
        Schema::create('alumni_memberships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('graduate_id')->constrained()->onDelete('cascade');
            $table->enum('membership_type', ['basic', 'premium', 'lifetime'])->default('basic');
            $table->decimal('amount', 10, 2);
            $table->enum('payment_method', ['gcash', 'bank_transfer', 'cash', 'other'])->nullable();
            $table->string('payment_reference')->nullable(); // GCash reference number or bank transaction ID
            $table->string('payment_proof')->nullable(); // Path to uploaded payment proof image
            $table->enum('status', ['pending', 'paid', 'verified', 'expired', 'cancelled'])->default('pending');
            $table->date('membership_start_date');
            $table->date('membership_end_date');
            $table->text('notes')->nullable();
            $table->timestamp('payment_date')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumni_memberships');
    }
};