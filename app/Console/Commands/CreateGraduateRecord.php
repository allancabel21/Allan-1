<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Graduate;
use Illuminate\Support\Facades\Validator;

class CreateGraduateRecord extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create-graduate 
                            {user_id : The user ID to create graduate record for}
                            {--student-id= : Student ID}
                            {--program= : Program of study}
                            {--batch-year= : Batch year}
                            {--graduation-date= : Graduation date (YYYY-MM-DD)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a graduate record for an existing user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $userId = $this->argument('user_id');
        $studentId = $this->option('student-id');
        $program = $this->option('program');
        $batchYear = $this->option('batch-year');
        $graduationDate = $this->option('graduation-date') ?? now()->format('Y-m-d');

        // Find the user
        $user = User::find($userId);
        if (!$user) {
            $this->error('User with ID ' . $userId . ' not found!');
            return 1;
        }

        if ($user->role !== 'graduate') {
            $this->error('User is not a graduate! Current role: ' . $user->role);
            return 1;
        }

        if ($user->graduate) {
            $this->error('User already has a graduate record!');
            return 1;
        }

        // Validate inputs
        $validator = Validator::make([
            'student_id' => $studentId,
            'program' => $program,
            'batch_year' => $batchYear,
            'graduation_date' => $graduationDate,
        ], [
            'student_id' => 'required|string|max:255|unique:graduates,student_id',
            'program' => 'required|string|max:255',
            'batch_year' => 'required|integer|min:2000|max:' . (date('Y') + 10),
            'graduation_date' => 'required|date',
        ]);

        if ($validator->fails()) {
            $this->error('Validation failed:');
            foreach ($validator->errors()->all() as $error) {
                $this->error('- ' . $error);
            }
            return 1;
        }

        try {
            // Create graduate record
            $graduate = Graduate::create([
                'user_id' => $user->id,
                'student_id' => $studentId,
                'program' => $program,
                'batch_year' => $batchYear,
                'graduation_date' => $graduationDate,
                'first_name' => explode(' ', $user->name)[0],
                'last_name' => explode(' ', $user->name)[1] ?? '',
                'verification_status' => 'verified',
            ]);

            $this->info('Graduate record created successfully!');
            $this->line('User: ' . $user->name . ' (' . $user->email . ')');
            $this->line('Student ID: ' . $graduate->student_id);
            $this->line('Program: ' . $graduate->program);
            $this->line('Batch Year: ' . $graduate->batch_year);
            $this->line('Graduation Date: ' . $graduate->graduation_date);
            
        } catch (\Exception $e) {
            $this->error('Failed to create graduate record: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
}