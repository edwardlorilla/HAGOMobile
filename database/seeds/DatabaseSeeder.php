<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
       // factory(\App\User::class, 5)->create();
      /*  DB::statement('SET FOREIGN_KEY_CHECKS = 0');
         \App\Repository::truncate();
        factory(\App\Repository::class, 1)->create();*/
    }
}
