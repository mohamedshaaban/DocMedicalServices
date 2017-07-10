<?php
use App\services;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = services::create(['name'=>'Service 1']);
        $services = services::create(['name'=>'Service 2 ']);
        $services = services::create(['name'=>'Service 3']);
    }
}
