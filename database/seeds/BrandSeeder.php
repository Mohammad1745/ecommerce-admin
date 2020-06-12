<?php

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::create([
            'name' => 'Tesla'
        ]);

        Brand::create([
            'name' => 'Toyota'
        ]);

        Brand::create([
            'name' => 'BMW'
        ]);
    }
}
