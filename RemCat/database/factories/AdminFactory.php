<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Admin;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'email'=>$this->faker->safeEmail(),
            'password'=> '$2y$12$bQ27WXfnSaonteJcnqUkBepL4Gp6qxAKdkR6xc6m2Ar/iWRsts5hK',
        ];
    }
}
