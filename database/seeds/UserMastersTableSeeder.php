<?php

use Illuminate\Database\Seeder;

class UserMastersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\UserMaster::class, 10)->create();
    }
}
