<?php

use App\UserType;
use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = UserType::create(['name'=>'administrator']);
        $admin->users()->create(['name'=>'admin','username'=>'admin','password'=>bcrypt(150888)]);
        UserType::create(['name'=>'accountant']);
        UserType::create(['name'=>'employee']);
    }
}