<?php

use App\FiscalYear;
use Illuminate\Database\Seeder;

class FiscalYearsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fiscal_years = [[
            'id'          => 1,
            'fiscal_year' => '76/77',
            'status'      => 1,
            'created_at'  => '2019-04-15 19:13:32',
            'updated_at'  => '2019-04-15 19:13:32',
        ],[
            'id'          => 2,
            'fiscal_year' => '77/78',
            'status'      => 0,
            'created_at'  => '2019-04-15 19:13:32',
            'updated_at'  => '2019-04-15 19:13:32',
        ],[
            'id'          => 3,
            'fiscal_year' => '78/79',
            'status'      => 0,
            'created_at'  => '2019-04-15 19:13:32',
            'updated_at'  => '2019-04-15 19:13:32',
        ],[
            'id'          => 4,
            'fiscal_year' => '79/80',
            'status'      => 0,
            'created_at'  => '2019-04-15 19:13:32',
            'updated_at'  => '2019-04-15 19:13:32',
        ],[
            'id'          => 5,
            'fiscal_year' => '80/81',
            'status'      => 0,
            'created_at'  => '2019-04-15 19:13:32',
            'updated_at'  => '2019-04-15 19:13:32',
        ],[
            'id'          => 6,
            'fiscal_year' => '81/82',
            'status'      => 0,
            'created_at'  => '2019-04-15 19:13:32',
            'updated_at'  => '2019-04-15 19:13:32',
        ]];

        FiscalYear::insert($fiscal_years);
    }
}
