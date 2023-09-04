<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin {--email= : The email address of the admin} {--password= : The password for the admin}';


    /**
     * The console command description.
     *
     * @var string
     */

    protected $description = 'Create a new admin user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->option('email');
        $password = $this->option('password');
    
        // Your logic to create the admin user
        User::create([
            'name' => 'Admin',
            'email' => $email,
            'password' => Hash::make($password),
            'role' => 'admin',
            'national_id' => '12345678901234',
            'phone' => '01234567890',
            'address' => 'Cairo',
        ]);
    }
}
