<?php
 
namespace Database\Factories;

use App\Models\Patients;
use Illuminate\Database\Eloquent\Factories\Factory;


class PatientsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Patients::class;

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
            
            'illness' => $this->faker->words(3, true),
        ];
    }

    

}

