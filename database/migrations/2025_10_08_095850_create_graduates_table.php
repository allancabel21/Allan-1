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
        Schema::create('graduates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('student_id')->unique();
            $table->string('program');
            $table->string('batch_year');
            $table->date('graduation_date');
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('linkedin_profile')->nullable();
            $table->text('bio')->nullable();
            $table->string('profile_picture')->nullable();
            $table->boolean('is_employed')->default(false);
            $table->string('current_position')->nullable();
            $table->string('current_company')->nullable();
            $table->date('employment_start_date')->nullable();
            $table->decimal('salary', 10, 2)->nullable();
            $table->enum('verification_status', ['pending', 'verified', 'rejected'])->default('pending');
            $table->text('verification_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('graduates');
    }
};
