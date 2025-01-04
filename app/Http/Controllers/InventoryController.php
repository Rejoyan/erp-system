<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    public function __construct()
    {
        // Applying authorization middleware to all methods that modify data
        $this->middleware('auth');
        $this->middleware('can:manage-inventory')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    public function index(Request $request)
    {
        // Fetch paginated inventory items with optional search and sorting
        $inventories = Inventory::when($request->search, function ($query) use ($request) {
            $query->where('part_number', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        })
        ->when($request->sort_by, function ($query) use ($request) {
            $query->orderBy($request->sort_by, $request->sort_direction ?? 'asc');
        })
        ->paginate(10); // Adjust pagination size as needed

        return view('inventory.index', compact('inventories'));
    }

    public function create()
    {
        // Authorize the user to create an inventory item
        $this->authorize('manage-inventory'); // Check if user can manage inventory
    
        // Return the create inventory form view
        return view('inventory.create');
    }

    public function store(Request $request)
    {
        // Authorize the user to store an inventory item
        $this->authorize('manage-inventory'); // Check if user can manage inventory
    
        // Apply validation rules
        $request->validate([
            'part_number' => 'required|unique:inventories,part_number',
            'quantity' => 'required|integer|min:1',
            'location' => 'required|string|max:255',
        ]);
    
        // Create the inventory item
        Inventory::create($request->all());
    
        // Redirect back to inventory index with success message
        return redirect()->route('inventory.index')->with('success', 'Item created successfully.');
    }

    public function edit(Inventory $inventory)
    {
        // Authorize the user to edit an inventory item
        $this->authorize('update', $inventory); // Check if user can update

        // Return the edit inventory form view
        return view('inventory.edit', compact('inventory'));
    }

    public function update(Request $request, Inventory $inventory)
    {
        // Authorize the user to update an inventory item
        $this->authorize('update', $inventory); // Check if user can update

        // Apply validation rules
        $request->validate([
            'part_number' => 'required|unique:inventories,part_number,' . $inventory->id,
            'quantity' => 'required|integer|min:1',
            'location' => 'required|string|max:255',
        ]);

        // Update the inventory item
        $inventory->update($request->all());

        // Redirect back to inventory index with success message
        return redirect()->route('inventory.index')->with('success', 'Item updated successfully.');
    }

    public function destroy(Inventory $inventory)
    {
        // Authorize the user to delete an inventory item
        $this->authorize('delete', $inventory); // Check if user can delete

        // Delete the inventory item
        $inventory->delete();

        // Redirect back to inventory index with success message
        return redirect()->route('inventory.index')->with('success', 'Item deleted successfully.');
    }
}
