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
        Schema::table('graduates', function (Blueprint $table) {
            // Personal Information
            $table->string('last_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('middle_initial')->nullable();
            $table->string('extension')->nullable();
            
            // Demographic Details
            $table->string('gender')->nullable();
            $table->date('birth_date')->nullable();
            $table->decimal('age', 5, 2)->nullable();
            $table->string('place_of_birth')->nullable();
            $table->string('civil_status')->nullable();
            
            // Contact and Background
            $table->string('nationality')->nullable();
            $table->string('religion')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('blood_type')->nullable();
            $table->string('ethnic_affiliation')->nullable();
            
            // Health and Special Needs
            $table->string('vaccination_status')->nullable();
            $table->string('pwd_special_needs')->nullable();
            
            // Present Address
            $table->text('present_address')->nullable();
            $table->string('province_region')->nullable();
            $table->string('municipality_city')->nullable();
            $table->string('barangay')->nullable();
            $table->string('zip_code')->nullable();
            
            // Permanent Address
            $table->text('permanent_address')->nullable();
            $table->string('permanent_province')->nullable();
            $table->string('permanent_city')->nullable();
            $table->string('permanent_barangay')->nullable();
            $table->string('permanent_zip_code')->nullable();
            
            // Emergency Information
            $table->string('emergency_contact_person')->nullable();
            $table->text('emergency_address')->nullable();
            $table->string('emergency_mobile')->nullable();
            $table->string('emergency_telephone')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('graduates', function (Blueprint $table) {
            $table->dropColumn([
                'last_name', 'first_name', 'middle_name', 'middle_initial', 'extension',
                'gender', 'birth_date', 'age', 'place_of_birth', 'civil_status',
                'nationality', 'religion', 'contact_number', 'height', 'weight', 'blood_type', 'ethnic_affiliation',
                'vaccination_status', 'pwd_special_needs',
                'present_address', 'province_region', 'municipality_city', 'barangay', 'zip_code',
                'permanent_address', 'permanent_province', 'permanent_city', 'permanent_barangay', 'permanent_zip_code',
                'emergency_contact_person', 'emergency_address', 'emergency_mobile', 'emergency_telephone'
            ]);
        });
    }
};