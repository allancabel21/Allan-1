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
        Schema::table('alumni_memberships', function (Blueprint $table) {
            // Personal Information
            $table->string('full_name')->nullable()->after('graduate_id');
            $table->string('student_id', 50)->nullable()->after('full_name');
            $table->string('course_degree')->nullable()->after('student_id');
            $table->integer('batch_year')->nullable()->after('course_degree');
            $table->date('date_of_birth')->nullable()->after('batch_year');
            $table->enum('gender', ['male', 'female', 'other'])->nullable()->after('date_of_birth');
            $table->string('email_address')->nullable()->after('gender');
            $table->text('address')->nullable()->after('email_address');
            
            // Professional Information
            $table->string('current_occupation')->nullable()->after('address');
            $table->string('company_organization')->nullable()->after('current_occupation');
            $table->string('position_job_title')->nullable()->after('company_organization');
            $table->string('industry')->nullable()->after('position_job_title');
            $table->text('work_address')->nullable()->after('industry');
            $table->string('years_experience', 20)->nullable()->after('work_address');
            
            // Additional Details
            $table->text('skills_expertise')->nullable()->after('years_experience');
            $table->text('achievements_awards')->nullable()->after('skills_expertise');
            $table->enum('volunteer_mentor', ['yes', 'maybe', 'no'])->nullable()->after('achievements_awards');
            $table->json('preferred_activities')->nullable()->after('volunteer_mentor');
            $table->text('membership_reason')->nullable()->after('preferred_activities');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alumni_memberships', function (Blueprint $table) {
            $table->dropColumn([
                'full_name',
                'student_id',
                'course_degree',
                'batch_year',
                'date_of_birth',
                'gender',
                'email_address',
                'address',
                'current_occupation',
                'company_organization',
                'position_job_title',
                'industry',
                'work_address',
                'years_experience',
                'skills_expertise',
                'achievements_awards',
                'volunteer_mentor',
                'preferred_activities',
                'membership_reason',
            ]);
        });
    }
};