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
        Schema::table('job_postings', function (Blueprint $table) {
            // Modify the existing status column to include review statuses
            $table->enum('status', ['pending', 'approved', 'rejected', 'draft', 'published', 'closed'])->default('pending')->change();
            
            // Add review fields
            $table->text('rejection_reason')->nullable()->after('status');
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->onDelete('set null')->after('rejection_reason');
            $table->timestamp('reviewed_at')->nullable()->after('reviewed_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_postings', function (Blueprint $table) {
            $table->dropForeign(['reviewed_by']);
            $table->dropColumn(['rejection_reason', 'reviewed_by', 'reviewed_at']);
            $table->enum('status', ['draft', 'published', 'closed'])->default('draft')->change();
        });
    }
};
