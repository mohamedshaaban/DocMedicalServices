<?php
use App\servicetypes;
use Illuminate\Database\Seeder;

class ServiceTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $servicetypes = servicetypes::create(['name'=>'Radilogy']);
        $servicetypes = servicetypes::create(['name'=>'Lab Test']);
        $servicetypes = servicetypes::create(['name'=>'Pharamcy']);
    }
}
