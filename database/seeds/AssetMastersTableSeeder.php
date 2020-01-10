<?php

use Illuminate\Database\Seeder;

class AssetMastersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\AssetMaster::class, 5)->create();
    }
}
