<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            'name' => 'User 1', 
            'email' => 'demo@user.com', 
            'role_id' => getConfig('role.student'), 
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            'password' => Hash::make(env('USER_PASSWORD', 'test')),            
        ]);

        User::create([
            'name' => 'Admin 1', 
            'email' => 'demo@admin.com', 
            'role_id' => getConfig('role.superadmin'), 
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            'password' => Hash::make(env('ADMIN_PASSWORD', 'test')),            
        ]);

        User::create([
            'name' => 'Staff 1', 
            'email' => 'demo@staff.com', 
            'role_id' => getConfig('role.staff'), 
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            'password' => Hash::make(env('ADMIN_PASSWORD', 'test')),            
        ]);
    }
}
