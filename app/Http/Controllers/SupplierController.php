<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $row = (int) request('row', 10);

        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        $suppliers = Supplier::filter(request(['search']))
            ->sortable()
            ->paginate($row)
            ->appends(request()->query());

        return view('admin.supplier.index', [
            'suppliers'  => $suppliers,
            'page_title' => 'Suppliers List'
        ]);
    }

    // FUNCTION TO CONVERT IMAGE

    private function convertSupplierImages($images)
    {
        $ext = 'webp';
        $suppliers = [];

        foreach ($images as $image) {
            $supplier_name = hexdec(uniqid()) . '-' . time() . '.' . $ext;
            $supplier_destination_path = public_path('uploads/supplier/image/') . $supplier_name;
            $image_convert = Image::make($image->getRealPath());
            $image_convert->save($supplier_destination_path, 10);
            $suppliers[] = $supplier_name;
        }

        return $suppliers;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.supplier.create', [
            'page_title' => 'Create Supplier'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'photo.*'        => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'name'           => 'required|string',
            'email'          => 'required|string',
            'phone'          => 'required|string',
            'address'        => 'required|string',
            'shopname'       => 'required|string',
            'type'           => 'required|string',
            'account_holder' => 'required|string',
            'account_number' => 'required|string',
            'bank_name'      => 'required|string'   
        ]);

        try {

            $supplier = new Supplier();

            $supplier->name = $request->name;
            $supplier->email = $request->email;
            $supplier->phone = $request->phone;
            $supplier->address = $request->address;
            $supplier->shopname = $request->shopname;
            $supplier->type = $request->type;
            $supplier->account_holder = $request->account_holder;
            $supplier->account_number = $request->account_number;
            $supplier->bank_name = $request->bank_name;
    
            $supplier->photo = $request->hasFile('photo') ? json_encode($this->convertSupplierImages($request->file('photo'))) : [];
    
            if($supplier->save()){
                return redirect()->route('admin.supplier.index')->with('success', 'Supplier has been created!');
            };

        } catch (\Exception) {
            return redirect()->back()->with('error', 'Failed to create supplier. Please try again.');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier, $id)
    {
        $supplier = Supplier::find($id);

        return view ('admin.supplier.update', [
            'supplier'   => $supplier,
            'page_title' => 'Edit Supplier'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $this->validate($request, [
            'photo.*'        => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'name'           => 'required|string',
            'email'          => 'required|string',
            'phone'          => 'required|string',
            'address'        => 'required|string',
            'shopname'       => 'required|string',
            'type'           => 'required|string',
            'account_holder' => 'required|string',
            'account_number' => 'required|string',
            'bank_name'      => 'required|string'   
        ]);

        try {
            
            $supplier = Supplier::find($request->id);

            $supplier->name = $request->name;
            $supplier->email = $request->email;
            $supplier->phone = $request->phone;
            $supplier->address = $request->address;
            $supplier->shopname = $request->shopname;
            $supplier->type = $request->type;
            $supplier->account_holder = $request->account_holder;
            $supplier->account_number = $request->account_number;
            $supplier->bank_name = $request->bank_name;
    
            if ($request->hasFile('photo')) {
                $supplier->photo = $request->hasFile('photo') ? json_encode($this->convertSupplierImages($request->file('photo'))) : [];
    
            }
    
            if($supplier->save()){
                return redirect()->route('admin.supplier.index')->with('success', 'Supplier has been updated!');
            };
        } catch (\Exception) {
            return redirect()->back()->with('error', 'Failed to update supplier. Please try again.');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier, $id)
    {
        try {

            $supplier = Supplier::find($id);

            if($supplier->delete()){
                return redirect()->route('admin.supplier.index')->with('success', 'Supplier has been deleted!');
            };

        } catch (\Exception) {
            return redirect()->back()->with('error', 'Failed to delete the supplier. Please try again.');
        }
          
    }
}
