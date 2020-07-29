<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionRoleTableSeeder::class,
            UsersTableSeeder::class,
            CompanyInfosTableSeeder::class,
            RoleUserTableSeeder::class,
            DepartmentsTableSeeder::class,
            ItemsTypesTableSeeder::class,
            FiscalYearsTableSeeder::class,
            CountriesTableSeeder::class,
        ]);
    }
}
