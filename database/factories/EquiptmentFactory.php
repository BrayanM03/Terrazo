<?php

namespace Database\Factories;

use App\Models\Equiptment;
use Illuminate\Database\Eloquent\Factories\Factory;

class EquiptmentFactory extends Factory
{
    protected $model = Equiptment::class;
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
            'unit'=> $this->faker->randomDigit(), 
            'description'=> $this->faker->paragraph(), 
            'unit_price'=> $this->faker->randomFloat(null, 3,2)
        ];
    }
}
