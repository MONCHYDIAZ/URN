<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rol>
 */
class RolFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'uuid' => '97ddada0-fb11-11ec-b939-0242ac120002',
            'nombre' => 'admin',
            'created_at' => date('Y-m-d H:i:s')
        ];
    }
}
