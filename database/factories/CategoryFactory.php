<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Helper;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    public $count_row = 1;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => str_pad($this->count_row++, 5, '0', STR_PAD_LEFT),
            'category_name' => fake()->word(),
            'parent_id' => null,
            'created_at' => now(),
            'updated_at' => now()
        ];
    }

}
