<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\InvoiceItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvoiceItemController extends Controller
{
    public function index()
    {
        return InvoiceItem::with(['product', 'invoice'])->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'invoice_id' => 'required|exists:invoices,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
        ]);

        $item = InvoiceItem::create($validated);

        return response()->json($item, 201);
    }

    public function show(InvoiceItem $invoiceItem)
    {
        return $invoiceItem->load(['product', 'invoice']);
    }

    public function update(Request $request, InvoiceItem $invoiceItem)
    {
        $validated = $request->validate([
            'invoice_id' => 'sometimes|exists:invoices,id',
            'product_id' => 'sometimes|exists:products,id',
            'quantity' => 'sometimes|integer|min:1',
            'unit_price' => 'sometimes|numeric|min:0',
        ]);

        $invoiceItem->update($validated);

        return response()->json($invoiceItem);
    }

    public function destroy(InvoiceItem $invoiceItem)
    {
        $invoiceItem->delete();

        return response()->noContent();
    }
}
