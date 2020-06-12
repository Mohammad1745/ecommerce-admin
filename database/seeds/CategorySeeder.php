<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = Category::create([
            'name' => 'Category',
            'description' => 'Category Description'
        ]);

        Category::create([
            'name' => 'Category 1st Child',
            'description' => 'Category 1st Child Description',
            'parent_id' => $category->id
        ]);

        Category::create([
            'name' => 'Category 1st Child 2',
            'description' => 'Category 1st Child 2 Description',
            'parent_id' => $category->id
        ]);
    }
}
