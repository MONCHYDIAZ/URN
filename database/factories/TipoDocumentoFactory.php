<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TipoDocumentoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'uuid' => '97ddaf4e-fb11-11ec-b939-0242ac120002',
            'nombre' => 'Cedula',
            'abreviatura' => 'c.c',
            'created_at' => date('Y-m-d H:i:s')
        ];
    }
}
