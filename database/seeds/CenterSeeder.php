<?php

use App\Center;
use Illuminate\Database\Seeder;

class CenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $center =  Center::create(['name'=>'A1','address'=>'Address 1','map_location'=>'123,345']);
       $center->phones()->create(['phone'=>'123456']);
       $center= Center::create(['name'=>'A2','address'=>'Address 2','map_location'=>'225,657']);
       $center->phones()->create(['phone'=>'223856']);
       $center= Center::create(['name'=>'A3','address'=>'Address 3','map_location'=>'325,789']);
       $center->phones()->create(['phone'=>'323454']);
       $center->phones()->create(['phone'=>'323459']);
    }
}
