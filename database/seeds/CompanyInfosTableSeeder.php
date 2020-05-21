<?php

use App\CompanyInfo;
use Illuminate\Database\Seeder;

class CompanyInfosTableSeeder extends Seeder
{
    public function run()
    {
        $company_info = [[
            'id'         => 1,
            'code'       => 'AD001',
            'name'       => 'Admin Company',
            'address'    => 'Biratnagar-10, Morang, P-1, Nepal',
            'phoneno'    => '9869379087',
            'created_at' => '2019-04-15 19:13:32',
            'updated_at' => '2019-04-15 19:13:32',
        ]];

        CompanyInfo::insert($company_info);
    }
}
