<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as CommandAlias;

class MakeUserAdmin extends Command
{
    protected $signature = 'app:make-user-admin {email}';
    protected $description = 'Assign the admin role to a user by their email';

    public function handle(): int
    {
        $email = $this->argument('email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("User with email '$email' not found.");
            return CommandAlias::FAILURE;
        }

        $user->role = 'admin';
        $user->save();

        $this->info("User '$user->name' ($email) is now an administrator.");

        return CommandAlias::SUCCESS;
    }
}
