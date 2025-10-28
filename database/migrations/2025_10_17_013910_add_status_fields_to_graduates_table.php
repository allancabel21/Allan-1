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
            $table->string('current_status')->default('graduate')->after('is_employed'); // undergraduate, graduate, employed, unemployed, pursuing_higher_education, self_employed
            $table->string('employment_type')->nullable()->after('current_status'); // full_time, part_time, contract, freelance, internship, self_employed
            $table->string('employment_sector')->nullable()->after('employment_type'); // private, government, non_profit, education, healthcare, technology, etc.
            $table->string('job_level')->nullable()->after('employment_sector'); // entry, mid, senior, executive, manager, director
            $table->text('job_description')->nullable()->after('job_level');
            $table->string('work_location')->nullable()->after('job_description');
            $table->boolean('is_remote_work')->default(false)->after('work_location');
            $table->string('education_level')->nullable()->after('is_remote_work'); // bachelor, master, doctorate, certificate, diploma
            $table->string('pursuing_degree')->nullable()->after('education_level');
            $table->string('institution_name')->nullable()->after('pursuing_degree');
            $table->date('expected_graduation')->nullable()->after('institution_name');
            $table->text('career_goals')->nullable()->after('expected_graduation');
            $table->text('skills')->nullable()->after('career_goals');
            $table->text('interests')->nullable()->after('skills');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('graduates', function (Blueprint $table) {
            $table->dropColumn([
                'current_status',
                'employment_type',
                'employment_sector',
                'job_level',
                'job_description',
                'work_location',
                'is_remote_work',
                'education_level',
                'pursuing_degree',
                'institution_name',
                'expected_graduation',
                'career_goals',
                'skills',
                'interests'
            ]);
        });
    }
};