<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CustomerController extends Controller
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

        $customers = Customer::filter(request(['search']))
            ->sortable()
            ->paginate($row)
            ->appends(request()->query());

        return view('admin.customer.index', [
            'customers' => $customers,
            'page_title' => 'Customers List'
        ]);
    }

    // FUNCTION TO CONVERT IMAGE

    private function convertCustomerImages($images)
    {
        $ext = 'webp';
        $customers = [];

        foreach ($images as $image) {
            $customer_name = hexdec(uniqid()) . '-' . time() . '.' . $ext;
            $customer_destination_path = public_path('uploads/customer/image/') . $customer_name;
            $image_convert = Image::make($image->getRealPath());
            $image_convert->save($customer_destination_path, 10);
            $customers[] = $customer_name;
        }

        return $customers;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.customer.create', [
            'page_title' => 'Create Customer'
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
            'email'          => 'nullable|string',
            'phone'          => 'required|string',
            'address'        => 'nullable|string',
            'account_holder' => 'nullable|string',
            'account_number' => 'nullable|string',
            'bank_name'      => 'nullable|string',
        ]);

        try {

            $customer = new Customer();

            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->address = $request->address;
            $customer->account_holder = $request->account_holder;
            $customer->account_number = $request->account_number;
            $customer->bank_name = $request->bank_name;
            
            $customer->photo = $request->hasFile('photo') ? json_encode($this->convertCustomerImages($request-file('photo'))) : [];

            if ($customer->save()) {
                return redirect()->route('admin.customer.index')->with('success', 'Customer has been created!');
            }

        } catch (\Exception) {
            return redirect()->back()->with('error', 'Failed to create customer. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer, $id)
    {
        $customer = Customer::find($id);

        return view('admin.customer.update', [
            'customer'   => $customer,
            'page_title' => 'Edit Customer'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $this->validate($request, [
            'photo.*'        => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'name'           => 'required|string',
            'email'          => 'required|string',
            'phone'          => 'required|string',
            'address'        => 'required|string',
            'account_holder' => 'required|string',
            'account_number' => 'required|string',
            'bank_name'      => 'required|string',
        ]);

        try {

            $customer = Customer::find($request->id);
    
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->address = $request->address;
            $customer->account_holder = $request->account_holder;
            $customer->account_number = $request->account_number;
            $customer->bank_name = $request->bank_name;

            if ($request->hasFile('photo')) {
                $customer->photo = $request->hasFile('photo') ? json_encode($this->convertCustomerImages($request->file('photo'))) : [];
    
            }

            if ($request->save()) {
                return redirect()->route('admin.customer.index')->with('success', 'Customer has been updated!');
            };
            
        } catch (\Exception) {
            return redirect()->back()->with('error', 'Failed to update customer. Please try again.');
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer, $id)
    {
        try {

            $customer = Customer::find($id);

            if($customer->delete()){
                return redirect()->route('admin.customer.index')->with('success', 'Customer has been deleted!');
            };

        } catch (\Exception) {
            return redirect()->back()->with('error', 'Failed to delete the customer. Please try again.');
        }
    }
}
