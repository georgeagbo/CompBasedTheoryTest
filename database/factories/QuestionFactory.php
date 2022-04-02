<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'course' => $this->faker->randomElement($array = array(
                'Computer Appreciation',
                'Computer Programming',
                'Graphics Design',
                'Computer Maintenance'
            )),
            'lecturer_id' => $this->faker->randomElement($array = array(
                '1',
                '2',
                '3',
                '4'
            )),
            'question' => $this->faker->randomElement($array = array(
                'Define a computer',
                'types of hardware',
                'types of software',
                'what is your name'
            )),
            'marks_obtainable' => $this->faker->randomElement($array = array(
                '2',
                '4',
                '6',
                '8'
            )),
            'answers' => $this->faker->randomElement($array = array(
                'electronic device;digital device;machine;device;accepts',
                'electronic device;digital device;machine;device;accepts',
                'electronic device;digital device;machine;device;accepts',
                'electronic device;digital device;machine;device;accepts'
            )),
        ];
    }
}
