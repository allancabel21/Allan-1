<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update the payment_method enum to include 'cash_on_delivery'
        DB::statement("ALTER TABLE alumni_memberships MODIFY COLUMN payment_method ENUM('gcash', 'bank_transfer', 'cash_on_delivery', 'cash', 'other') NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back to original enum values
        DB::statement("ALTER TABLE alumni_memberships MODIFY COLUMN payment_method ENUM('gcash', 'bank_transfer', 'cash', 'other') NULL");
    }
};
