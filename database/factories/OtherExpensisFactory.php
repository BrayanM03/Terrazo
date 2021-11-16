<?php

namespace Database\Factories;

use App\Models\OtherExpensis;
use Illuminate\Database\Eloquent\Factories\Factory;

class OtherExpensisFactory extends Factory
{
    protected $model = OtherExpensis::class;
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
