<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = $this->faker->randomElement(['B','FP','HP','OP','V']); //Billed, Full-paid, Half-paid, Over-paid, Void

        return [
            'customer_id' => \App\Models\Customer::factory(),
            'amount' => $this->faker->numberBetween(1000, 100000),
            'status' => $status,
            'billed_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'paid_date' => $status =='FP' ? $this->faker->dateTimeThisDecade() : NULL
        ];
    }
}
