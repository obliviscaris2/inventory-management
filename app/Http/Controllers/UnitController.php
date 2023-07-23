<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
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

        $units = Unit::filter(request(['search']))
                ->sortable()
                ->paginate($row)
                ->appends(request()->query());
        // $units->appends(['row' => $row]);

        return view('admin.unit.index', [
            'units'      => $units,
            'page_title' => "Units List"
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('admin.unit.create', [
            'page_title' => 'Create Unit'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'    => 'required|string',
            'slug'    => 'required|unique:units,slug|alpha_dash',
        ]);

        try {

            $unit = new Unit();
    
            $unit->name = $request->name ?? "";
            $unit->slug = $request->slug ?? "";

            $unit->save();

            return redirect()->route('admin.unit.index')->with('success', 'Unit created successfully!');

        } catch (\Exception) {
            return redirect()->back()->with('error', 'Failed to create unit. Please try again.');
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit $unit, $id)
    {
        $unit = Unit::find($id);

        $page_title = "Edit Unit";

        return view('admin.unit.update', compact('unit', 'page_title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Unit $unit)
    {
        $this->validate($request, [
            'name' => 'required|unique:units,name,'.$unit->id,
            'slug' => 'required|alpha_dash|unique:units,slug,'.$unit->id,
        ]);

        try {

            $unit = Unit::find($request->id);
    
            // Update the properties of the $unit object
            $unit->name = $request->name ?? "";
            $unit->slug = $request->slug ?? "";

            // Save the changes to the database
            $unit->save();

            return redirect()->route('admin.unit.index')->with('success', 'Unit updated successfully!');

        } catch (\Exception) {
            return redirect()->back()->with('error', 'Failed to update the unit. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit, $id)
    {
        try {
            $unit = Unit::find($id);

            $unit->delete();
            
            return redirect()->route('admin.unit.index')->with('success', 'Unit deleted successfully!');

            
        } catch (\Exception) {
            return redirect()->back()->with('error', 'Failed to delete the unit. Please try again.');
        }
    }
}
