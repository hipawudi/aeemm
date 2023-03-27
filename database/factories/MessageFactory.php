<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;

class MessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
   
        return [
            'category' => $this->faker->randomElement(['public','members','perersonal']),
            'title' => $this->faker->text(),
            'content' => $this->faker->paragraph(3),
            'scope' => $this->faker->randomElement(['public','members','perersonal']),
            'sender'=> $this->faker->randomElement(['system','admin','member']),
            //'receiver'=>$this->faker->numberBetween(1,100)
        ];
    }


}
