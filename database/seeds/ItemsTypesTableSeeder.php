<?php

use App\ItemsType;
use Illuminate\Database\Seeder;

class ItemsTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items_type = [[
            'id'         => 1,
            'type'       => 'Book',
            'created_at' => '2019-04-15 19:13:32',
            'updated_at' => '2019-04-15 19:13:32',
        ],[
            'id'         => 2,
            'type'       => 'Copy',
            'created_at' => '2019-04-15 19:13:32',
            'updated_at' => '2019-04-15 19:13:32',
        ],[
            'id'         => 3,
            'type'       => 'Sports',
            'created_at' => '2019-04-15 19:13:32',
            'updated_at' => '2019-04-15 19:13:32',
        ],[
            'id'         => 4,
            'type'       => 'Others',
            'created_at' => '2019-04-15 19:13:32',
            'updated_at' => '2019-04-15 19:13:32',
        ]];

        ItemsType::insert($items_type);
    }
}
