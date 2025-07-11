<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock_quantity',
        'image_url',
    ];

    // Optional: Relationship to invoice items
    public function invoiceItems(){

        return $this->hasMany(InvoiceItem::class);
    }

}
