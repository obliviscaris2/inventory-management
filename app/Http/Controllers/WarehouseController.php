<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $row = (int) request('row', 10);

        if ($row < 1 || $row > 100) {
            abort(400, 'The per_page parameter must be an integer between 1 and 100.');
        }

        $warehouses = Warehouse::filter(request(['search']))
            ->sortable()
            ->paginate($row)
            ->appends(request()->query());

            
        $page_title = "Warehouses List";

        return view('admin.warehouse.index', compact('warehouses', 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $page_title = "Create Warehouse";
        return view('admin.warehouse.create', compact('page_title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'    => 'required|string',
            'address' => 'required|string'
        ]);

        try {

            $warehouse = new Warehouse();
    
            $warehouse->name = $request->name ?? "";
            $warehouse->address = $request->address ?? "";

            $warehouse->save();

            return redirect()->route('admin.warehouse.index')->with('success', 'Warehouse created successfully!');

        } catch (\Exception) {

            return redirect()->back()->with('error', 'Failed to create the warehouse. Please try again.');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Warehouse $warehouse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Warehouse $warehouse, $id)
    {
        $warehouse = Warehouse::find($id);

        $page_title = "Edit Warehouse";

        return view('admin.warehouse.update', compact('warehouse', 'page_title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Warehouse $warehouse)
    {
        $this->validate($request, [
            'name'    => 'required|string',
            'address' => 'required|string'
        ]);

        try {

            $warehouse = Warehouse::find($request->id);
    
            $warehouse->name = $request->name ?? "";
            $warehouse->address = $request->address ?? "";

            $warehouse->save();

            return redirect()->route('admin.warehouse.index')->with('success', 'Warehouse updated successfully!');

        } catch (\Exception) {

            return redirect()->back()->with('error', 'Failed to update the warehouse. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Warehouse $warehouse, $id)
    {
        try {
            $warehouse = Warehouse::find($id);

            $warehouse->delete();

            return redirect()->route('admin.warehouse.index')->with('success', 'Warehouse deleted successfully!');

        } catch (\Exception) {
            
            return redirect()->back()->with('error', 'Failed to delete the warehouse. Please try again.');
        }
        
    }
}
