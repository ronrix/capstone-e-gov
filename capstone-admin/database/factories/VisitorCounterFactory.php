<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VisitorCounter>
 */
class VisitorCounterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'counter' => '1',
            'visitors_id' => json_encode(['unique_id']),
            'total_visitors' => '1'
        ];
    }
}
