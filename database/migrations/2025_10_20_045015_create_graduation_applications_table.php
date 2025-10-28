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
        Schema::create('graduation_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('graduate_id')->constrained('graduates')->onDelete('cascade');
            $table->string('application_type'); // 'degree' or 'diploma'
            $table->string('major_in')->nullable();
            $table->string('campus');
            $table->string('city_province');
            $table->string('college_unit_department');
            $table->string('last_semester'); // 'semester' or 'summer'
            $table->string('school_year');
            $table->json('subject_load'); // Array of subjects with code, title, units, instructor, signature
            $table->string('diploma_name');
            $table->string('diploma_address');
            $table->string('diploma_contact');
            $table->string('status')->default('pending'); // pending, approved, rejected
            $table->text('notes')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('graduation_applications');
    }
};