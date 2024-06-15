<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'lastname'=>"Super-Admin",
            'fistname'=>"Super-Admin",
            'email'=>"superadmin@gmail.com",
            'phone'=>'61000000',
            'phone'=>'61000000',
            'password'=>bcrypt("password"),
            'job_id'=> 1,
            'role_id'=> 1,
        ]);
    }
}
