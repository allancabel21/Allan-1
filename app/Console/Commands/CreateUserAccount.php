<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Graduate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateUserAccount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create 
                            {name : The user\'s full name}
                            {email : The user\'s email address}
                            {role : The user\'s role (admin, staff, graduate)}
                            {--password= : The user\'s password (default: password)}
                            {--student-id= : Student ID (required for graduates)}
                            {--program= : Program of study (required for graduates)}
                            {--batch-year= : Batch year (required for graduates)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user account manually (for administrators)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $email = $this->argument('email');
        $role = $this->argument('role');
        $password = $this->option('password') ?? 'password';
        
        // Validate inputs
        $validator = Validator::make([
            'name' => $name,
            'email' => $email,
            'role' => $role,
            'password' => $password,
        ], [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:admin,staff,graduate',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            $this->error('Validation failed:');
            foreach ($validator->errors()->all() as $error) {
                $this->error('- ' . $error);
            }
            return 1;
        }

        // Check if user already exists
        if (User::where('email', $email)->exists()) {
            $this->error('User with email ' . $email . ' already exists!');
            return 1;
        }

        try {
            // Create user
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'role' => $role,
                'email_verified_at' => now(),
            ]);

            $this->info('User created successfully!');
            $this->line('Name: ' . $user->name);
            $this->line('Email: ' . $user->email);
            $this->line('Role: ' . $user->role);
            $this->line('Password: ' . $password);

            // If user is a graduate, create graduate record
            if ($role === 'graduate') {
                $studentId = $this->option('student-id');
                $program = $this->option('program');
                $batchYear = $this->option('batch-year');

                if (!$studentId || !$program || !$batchYear) {
                    $this->warn('Graduate user created, but graduate record requires additional information:');
                    $this->warn('Use: php artisan user:create-graduate ' . $user->id . ' --student-id=STUDENT_ID --program=PROGRAM --batch-year=YEAR');
                    return 0;
                }

                Graduate::create([
                    'user_id' => $user->id,
                    'student_id' => $studentId,
                    'program' => $program,
                    'batch_year' => $batchYear,
                    'graduation_date' => now(),
                    'first_name' => explode(' ', $name)[0],
                    'last_name' => explode(' ', $name)[1] ?? '',
                    'verification_status' => 'verified',
                ]);

                $this->info('Graduate record created successfully!');
            }

            $this->info('Account credentials can be shared with the user via email.');
            
        } catch (\Exception $e) {
            $this->error('Failed to create user: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
}