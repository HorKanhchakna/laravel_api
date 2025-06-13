<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\InvoiceItem;
use App\Models\Product;
use Illuminate\Support\Arr;

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
        $status = $this->faker->randomElement(['B', 'P', 'V']);
        return [
            'customer_id' => Customer::factory(),
            'amount' => $this->faker->numberBetween(100, 2000),
            'status'=>$status,
            'billed_date' => $this->faker->dateTimeThisDecade(),
            'paid_date' => $status == 'P' ? $this->faker->dateTimeThisDecade() : NULL
        ];
    }

    public function configure(): static
{
    return $this->afterCreating(function (\App\Models\Invoice $invoice) {
        $productIds = Product::pluck('id');

        if ($productIds->isEmpty()) {
            return; // No products available yet
        }

        // Generate 1–4 items per invoice
        for ($i = 0; $i < rand(1, 4); $i++) {
            InvoiceItem::factory()->create([
                'invoice_id' => $invoice->id,
                'product_id' => Arr::random($productIds->toArray()),
            ]);
        }
    });
}
}
