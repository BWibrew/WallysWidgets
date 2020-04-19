<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $packSizes = [250, 500, 1000, 2000, 5000];

        foreach ($packSizes as $packSize) {
            DB::table('packs')->insert([
                'size' => $packSize,
            ]);
        }
    }
}
