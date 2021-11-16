<?php

namespace Database\Factories;

use App\Models\Labor;
use Illuminate\Database\Eloquent\Factories\Factory;

class LaborFactory extends Factory
{
    protected $model = Labor::class;
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
            'price_per_hour'=> $this->faker->randomFloat(null, 3,2)
        ];
    }
}
