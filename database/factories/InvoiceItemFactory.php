<?php

namespace Database\Factories;

use App\Models\InvoiceItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceItemFactory extends Factory
{
    protected $model = InvoiceItem::class;

    public function definition(): array
{
    return [
        'quantity' => $this->faker->numberBetween(1, 5),
        'unit_price' => $this->faker->randomFloat(2, 10, 100),
    ];
}

}
