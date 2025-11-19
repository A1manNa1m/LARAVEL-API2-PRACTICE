<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;
use App\Models\Invoice;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $Paidmethod = $this->faker->randomElement(['CC','DC','FPX']); //creditcard, debitcard, OnlineBanking

        return [
            'customer_id' => Customer::factory(),
            'invoice_id' => Invoice::factory(),
            'amount' => $this->faker->numberBetween(500, 50000),
            'payment_method' => $Paidmethod,
            'payment_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
