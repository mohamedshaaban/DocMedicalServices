<?php
use App\vendor;
use App\vendorbranches;
use App\vendorcntacts;
use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run()
    {   
         $timestamps = false;
        $vendor = vendor::create(['name'=>'Dar el asha','vat'=>'vat dar el asha','reg'=>'reg dar' , 'website'=> 'doc.com' , 'is_active'=>true]);
        $branch = $vendor->vendorbranches()->create(['name'=>'Branch 1 ','address'=>'Branch add 1' , 'lon'=>'29.22','lat'=>'30.58']);
        $branch_contact = $branch->vendorcntacts()->create(['name'=>'Mr Metwally','title'=>'Dr' , 'level'=>'1','mobile'=>'01285819291','phone'=>'5448855','description'=>'Testing Description','ex'=>'03']);
    
    }
}
