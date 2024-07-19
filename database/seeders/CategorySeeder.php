<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Categories = \App\Models\Category::factory(10000)->create();

        foreach ($Categories as $key => $Category) {
            if (!empty($Categories[$key-1])) {
                $Category->parent_id = $Categories[$key-1]->category_id;
                $Category->save();
            }
        }
    }
}
