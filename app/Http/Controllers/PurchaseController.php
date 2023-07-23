<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\PurchaseDetails;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\String_;

class PurchaseController extends Controller
{
    /**
     * Display an all purchases.
    */

    public function allPurchases()
    {
        $row = (int) request('row', 10);

        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        $purchases = Purchase::with(['supplier', 'warehouse'])
        ->sortable()
        ->paginate($row)
        ->appends(request()->query());

        return view('admin.purchase.index', [
            'purchases'  => $purchases,
            'page_title' => 'Purchases List'
        ]);
    }

    /**
     * Display an all approved purchases.
    */

    public function approvedPurchases()
    {
        $row = (int) request('row', 10);

        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        $purchases = Purchase::with(['supplier', 'warehouse'])
            ->where('purchase_status', 1) // 1 = approved
            ->sortable()
            ->paginate($row)
            ->appends(request()->query());

        return view('admin.purchase.approved-purchase', [
            'purchases' => $purchases
        ]);
    }


    /**
     * Display a purchase details.
    */
    public function purchaseDetails(String $purchase_id)
    {
        $purchase = Purchase::with(['supplier','user_created','user_updated', 'warehouse'])
            ->where('id', $purchase_id)
            ->first();

        $purchaseDetails = PurchaseDetails::with('product')
            ->where('purchase_id', $purchase_id)
            ->orderBy('id')
            ->get();

        return view('admin.purchase.purchase-details', [
            'purchase' => $purchase,
            'purchaseDetails' => $purchaseDetails,
        ]);
    }

    /**
     * Show the form for creating a new resource.
    */
    public function create()
    {
        return view('admin.purchase.create', [
            'warehouses' => Warehouse::all(),
            'categories' => Category::all(),
            'suppliers'  => Supplier::all(),
            'products'   => Product::all(),
            'page_title' => 'Create Purchases'
        ]);
    }

    // FUNCTION TO CREATE PURCHASE CODE

    public function generatePurchaseCode() {
        // Get the last product number from the database
        $lastPurchaseCode = DB::table('purchases')->orderBy('id', 'desc')->value('purchase_no');
    
        if (!$lastPurchaseCode) {
            $purchasecode = 100000000000;
        } else {
            // Otherwise, increment the last membership number by 1
            $purchasecode = $lastPurchaseCode + 1;
        }

        return $purchasecode;
    }

    /**
     * Store a newly created resource in storage.
    */
    public function store(Request $request)
    {
        $data = [
            'supplier_id' => 'required|string',
            'purchase_date' => 'required|string',
            'warehouse_id' => 'required|string',
            'total_amount' => 'required|numeric'
        ];

        try {

            $validatedData = $request->validate($data);
    
            $validatedData['purchase_status'] = 0; // 0 = pending, 1 = approved
            $validatedData['purchase_no'] = $this->generatePurchaseCode();
            $validatedData['created_by'] = auth()->user()->id;
            $validatedData['created_at'] = Carbon::now();
    
            // Retrieve and store the warehouse_id
            
            $purchase_id = Purchase::insertGetId($validatedData);
            
            // Create Purchase Details
            $pDetails = array();
            // $warehouse_id = $request->warehouse_id;
    
            $products = count($request->product_id);
    
            for ( $i = 0; $i < $products; $i++ ) {
                // $pDetails['warehouse_id'] = $warehouse_id;
                $pDetails['purchase_id'] = $purchase_id;
                $pDetails['product_id'] = $request->product_id[$i];
                $pDetails['quantity'] = $request->quantity[$i];
                $pDetails['unitcost'] = $request->unitcost[$i];
                $pDetails['total'] = $request->total[$i];
                $pDetails['created_at'] = Carbon::now();
    
                PurchaseDetails::insert($pDetails);
            }
    
            return redirect()->route('admin.purchase.allpurchases')->with('success', 'Purchase has been created!');

        } catch (\Exception) {

            return redirect()->back()->with('error', 'Failed to creare the purchase. Please try again.');
        }


    }


    /**
     * Update the specified resource in storage.
    */
    public function updatePurchase(Request $request, Purchase $purchase)
    {
        try {

            $purchase_id = $request->id;

            // after purchase approved, add stock product
            $products = PurchaseDetails::where('purchase_id', $purchase_id)->get();
    
            foreach ($products as $product) {
                Product::where('id', $product->product_id)
                        ->update(['stock' => DB::raw('stock+'.$product->quantity)]);
            }
    
            Purchase::findOrFail($purchase_id)
                ->update([
                    'purchase_status' => 1,
                    'updated_by' => auth()->user()->id
                ]); // 1 = approved, 0 = pending
    
            return redirect()->route('admin.purchase.allpurchases')->with('success', 'Purchase has been approved!');

        } catch (\Exception) {

            return redirect()->back()->with('error', 'Failed to update the purchase. Please try again.');
        }


    }

    /**
     * Remove the specified resource from storage.
    */
    public function deletePurchase(String $purchase_id)
    {

        try {
            Purchase::where([
                'id' => $purchase_id,
                'purchase_status' => '0'
            ])->delete();
    
            PurchaseDetails::where('purchase_id', $purchase_id)->delete();
    
            return redirect()->route('admin.purchase.allpurchases')->with('success', 'Purchase has been deleted!');

        } catch (\Exception) {
            return redirect()->back()->with('error', 'Failed to update the purchase. Please try again.');
        }

    }

        /**
     * Display an all purchases.
     */
    public function dailyPurchaseReport()
    {
        $row = (int) request('row', 10);

        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        $purchases = Purchase::with(['supplier'])
            ->where('purchase_date', Carbon::now()->format('Y-m-d')) // 1 = approved
            ->sortable()
            ->paginate($row)
            ->appends(request()->query());

        return view('admin.purchase.purchases', [
            'purchases' => $purchases
        ]);
    }
}
