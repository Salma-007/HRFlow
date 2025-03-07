<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Department>
 */
class DepartmentFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word(), 
            'description' => $this->faker->sentence(), 
        ];
    }
}
