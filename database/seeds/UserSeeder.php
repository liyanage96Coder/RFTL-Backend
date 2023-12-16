<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Kernel User',
            'email' => 'kernel@kernel.com',
            'role_id' => 1,
            'password' => '$2y$10$il4aSAUa/NcqQ7Q1k.eHourENBh.GXt0.NJVzOsr9/nnC1JzXvS.u', // KernelUser@123
        ]);

        User::create([
            'name' => 'Member User',
            'email' => 'member@kernel.com',
            'role_id' => 2,
            'password' => '$2y$10$il4aSAUa/NcqQ7Q1k.eHourENBh.GXt0.NJVzOsr9/nnC1JzXvS.u', // KernelUser@123
        ]);
    }
}
