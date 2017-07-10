<?php
use App\servicefiles;
use Illuminate\Database\Seeder;

class ServiceFilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $servicefiles = servicefiles::create(['name'=>'Tax','service_id'=>'1','description'=>'Tax desc' , 'is_active'=>true]);
    }
}
