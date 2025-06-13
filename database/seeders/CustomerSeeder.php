<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\InvoiceItem;
use App\Models\Product;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    $products = Product::all();

    Customer::factory()
        ->count(25)
        ->hasInvoices(10)
        ->create()
        ->each(function ($customer) use ($products) {
            $customer->invoices->each(function ($invoice) use ($products) {
                $items = $products->random(rand(1, 5));
                foreach ($items as $product) {
                    InvoiceItem::create([
                        'invoice_id' => $invoice->id,
                        'product_id' => $product->id,
                        'quantity' => rand(1, 3),
                        'unit_price' => $product->price,
                    ]);
                }
            });
        });
}
}
