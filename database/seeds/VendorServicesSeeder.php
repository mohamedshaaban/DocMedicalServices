<?php
use App\vendorservices;
use Illuminate\Database\Seeder;

class VendorServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = vendorservices::create(['vendor_id'=>'1','service_id'=>'1']);
        
    }
}
