<?php
use App\vendoruploads;
use Illuminate\Database\Seeder;

class VendorUploadsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendoruploads = vendoruploads::create(['service_files_id'=>'1','file'=>'test file','vendorservices_id'=>'1' , 'is_approved'=>true]);
    }
}
