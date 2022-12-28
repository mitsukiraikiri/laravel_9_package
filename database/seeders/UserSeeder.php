<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name'=>'Admin',
            'email'=>'admin@gmail.com',
            'password'=>bcrypt('admin_123'),
            'email_verified_at'=>Carbon::now()
        ]);
        $dev = User::create([
            'name'=>'Dev',
            'email'=>'dev@gmail.com',
            'password'=>bcrypt('dev_123'),
            'email_verified_at'=>Carbon::now()
        ]);
        $admin->assignRole('admin');
        $dev->assignRole('developer');
    }
}
