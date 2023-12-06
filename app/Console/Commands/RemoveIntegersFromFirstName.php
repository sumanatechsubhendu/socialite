<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class RemoveIntegersFromFirstName extends Command
{
    protected $signature = 'scheduler:remove-integers';
    protected $description = 'Remove integers from the first_name field in the users table';

    public function handle()
    {
        // Retrieve users with integers in the first_name field
        $usersWithIntegers = User::whereRaw('name REGEXP "[0-9]"')->get();

        foreach ($usersWithIntegers as $user) {
            // Remove integers from the first_name field
            $user->update(['name' => preg_replace("/[0-9]/", "", $user->name)]);
        }

        $this->info('Integers removed from the first_name field.');
    }
}
