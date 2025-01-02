<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    // Display a listing of the purchase orders
    public function index()
    {
        $purchaseOrders = PurchaseOrder::all();
        return view('purchase_orders.index', compact('purchaseOrders'));
    }

    // Show the form for creating a new purchase order
    public function create()
    {
        return view('purchase_orders.create');
    }

    // Store a newly created purchase order in storage
    public function store(Request $request)
    {
        $request->validate([
            'order_number' => 'required|unique:purchase_orders',
            'order_date' => 'required|date',
            'expected_delivery_date' => 'required|date',
            'items' => 'required', // You may want to validate this further
        ]);

        PurchaseOrder::create($request->all());
        return redirect()->route('purchase_orders.index')->with('success', 'Purchase order created successfully.');
    }

    // Show the form for editing the specified purchase order
    public function edit(PurchaseOrder $purchaseOrder)
    {
        return view('purchase_orders.edit', compact('purchaseOrder'));
    }

    // Update the specified purchase order in storage
    public function update(Request $request, PurchaseOrder $purchaseOrder)
    {
        $request->validate([
            'order_number' => 'required|unique:purchase_orders,order_number,' . $purchaseOrder->id,
            'order_date' => 'required|date',
            'expected_delivery_date' => 'required|date',
            'items' => 'required',
        ]);

        $purchaseOrder->update($request->all());
        return redirect()->route('purchase_orders.index')->with('success', 'Purchase order updated successfully.');
    }

    // Remove the specified purchase order from storage
    public function destroy(PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->delete();
        return redirect()->route('purchase_orders.index')->with('success', 'Purchase order deleted successfully.');
    }
};