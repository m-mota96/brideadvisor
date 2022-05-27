<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables([
            'users',
            'cities',
            'category_providers',
            'roles',
            'tasks',
            'states'
        ]);
        $this->call(CreateUsersSeeder::class);
        $this->call(CreateCitiesSeeder::class);
        $this->call(CategoryProvidersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(TasksTableSeeder::class);
        $this->call(CreateStatesSeeder::class);
    }

    public function truncateTables(array $tables)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
 
        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }
 
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
