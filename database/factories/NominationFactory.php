<?php

namespace Database\Factories;

use App\Models\Nomination;
use App\Support\Xies;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Nomination>
 */
class NominationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nominator_name' => fake()->name(),
            'nominator_email' => fake()->safeEmail(),
            'nominator_x_handle' => fake()->userName(),
            'self_nomination' => false,
            'nominee_name' => fake()->name(),
            'nominee_x_handle' => fake()->userName(),
            'show_name' => fake()->sentence(3),
            'categories' => [fake()->randomElement(Xies::categories())],
            'reason' => fake()->paragraph(),
            'links' => null,
            'attachments' => [],
            'amount_due' => Xies::fee(),
            'payment_method' => 'paypal',
            'payment_reference' => strtoupper(Str::random(12)),
            'status' => Nomination::STATUS_PENDING,
        ];
    }

    /**
     * Indicate that the nomination's payment has been verified.
     */
    public function verified(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Nomination::STATUS_VERIFIED,
        ]);
    }
}
