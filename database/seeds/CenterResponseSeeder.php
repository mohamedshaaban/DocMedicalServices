<?php

use App\CenterResponse;
use Illuminate\Database\Seeder;

class CenterResponseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $response =  CenterResponse::create([
           'request_id'=>1,
           'delivery_est_datetime'=>'2017-6-20 10:00:00',
           'radiology_datetime'=>'2017-6-21 10:00:00',
           'is_at_home'=>false]);
       $response->radiology_types()->attach(1,['price'=>10,'definition'=>'sdsdsd','preparation'=>'','notes'=>'notesss']);
       $response->radiology_types()->attach(2,['price'=>20,'definition'=>'fgdfsef','preparation'=>'wecsc','notes'=>'notesss']);

       $response->centers()->attach(1,['arrive_datetime'=>'2017-6-21 9:00:00']);

        $response =  CenterResponse::create([
            'request_id'=>2,
            'delivery_est_datetime'=>'2017-6-22 11:00:00',
            'radiology_datetime'=>'2017-6-22 11:00:00',
            'is_at_home'=>true]);
        $response->radiology_types()->attach(3,['price'=>150,'definition'=>'sdsdsd','preparation'=>'','notes'=>'notesss']);
        $response->radiology_types()->attach(4,['price'=>2500,'definition'=>'fgdfsef','preparation'=>'wecsc','notes'=>'notesss']);
    }
}
