<?php

use App\Department;
use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = [[
            'id'         => 1,
            'name'       => 'Store',
            'created_at' => '2019-04-15 19:13:32',
            'updated_at' => '2019-04-15 19:13:32',
        ],[
            'id'         => 2,
            'name'       => 'Counter',
            'created_at' => '2019-04-15 19:13:32',
            'updated_at' => '2019-04-15 19:13:32',
        ]];

        Department::insert($departments);
    }
}
