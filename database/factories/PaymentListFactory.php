<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaymentList>
 */
class PaymentListFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
   
    public function definition()
    {
        return [
            'subscriber' => $this->faker->name,
            'amount' => $this->faker->numberBetween(1000, 100000),
            'status' => $this->faker->randomElement(['paid', 'pending']),
            'mid' => "MID", // Initial value, will be updated in the afterCreating callback
            'payment_id' => rand(1, 3),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (\App\Models\PaymentList $payment) {
            // Use the created model's ID to update the 'mid' field
            $payment->update(['mid' => "MID" . $payment->id]);
        });
    }
}
