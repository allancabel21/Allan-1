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
        Schema::table('announcements', function (Blueprint $table) {
            // Increase the length of type column to accommodate longer values like 'important'
            $table->string('type', 50)->change();
            
            // Also ensure other columns have adequate length
            $table->string('priority', 20)->change();
            $table->string('target_audience', 20)->change();
            $table->string('status', 20)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('announcements', function (Blueprint $table) {
            // Revert to original lengths (if needed)
            $table->string('type', 20)->change();
            $table->string('priority', 10)->change();
            $table->string('target_audience', 10)->change();
            $table->string('status', 10)->change();
        });
    }
};
