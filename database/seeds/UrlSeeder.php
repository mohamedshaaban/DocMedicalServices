<?php

use App\UrlGroup;
use Illuminate\Database\Seeder;

class UrlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $users =  UrlGroup::create(['name'=>'Users','order'=>0]);
       $users->urls()->createMany([
           ['name'=>'List Users','href'=>'user','order'=>0],
           ['name'=>'Create User','href'=>'user/create','order'=>1]
       ]);
       $requests =  UrlGroup::create(['name'=>'Requests','order'=>1]);
       $requests->urls()->create(['name'=>'List Requests','order'=>'0','href'=>'request']);
    }
}
