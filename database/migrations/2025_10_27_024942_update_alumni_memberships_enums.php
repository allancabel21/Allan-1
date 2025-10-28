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
        // Modify membership_type enum using raw SQL
        DB::statement("ALTER TABLE `alumni_memberships` MODIFY COLUMN `membership_type` ENUM('basic', 'premium', 'lifetime', 'yearbook') DEFAULT 'basic'");
        
        // Modify payment_method enum using raw SQL  
        DB::statement("ALTER TABLE `alumni_memberships` MODIFY COLUMN `payment_method` ENUM('gcash', 'paymaya', 'bank_transfer', 'cash', 'other') NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert membership_type enum
        DB::statement("ALTER TABLE `alumni_memberships` MODIFY COLUMN `membership_type` ENUM('basic', 'premium', 'lifetime') DEFAULT 'basic'");
        
        // Revert payment_method enum
        DB::statement("ALTER TABLE `alumni_memberships` MODIFY COLUMN `payment_method` ENUM('gcash', 'bank_transfer', 'cash', 'other') NULL");
    }
};
