<?php

namespace Database\Factories;

use App\Models\Material;
use Illuminate\Database\Eloquent\Factories\Factory;

class MaterialFactory extends Factory
{
    protected $model = Material::class;
    /**
     * Define the model's default state.
     *
     
     * 
     * @return array
     */
    public function definition()
    {
       
        return [
            //
            'unit'=> $this->faker->randomElement(['GAL', 'POUND', 'BAG']), 
            'description'=> $this->faker->paragraph(), 
            'unit_price'=> $this->faker->randomFloat(null, 3,2)
        ];
    }
}
