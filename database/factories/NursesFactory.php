<?php
 
namespace Database\Factories;

use App\Models\Nurse;
use Illuminate\Database\Eloquent\Factories\Factory;


class NursesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Nurse::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'department' => $this->faker->words(1, true),
            
        ];
    }

    
}

