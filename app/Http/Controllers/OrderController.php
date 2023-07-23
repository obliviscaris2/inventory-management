<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart;

class OrderController extends Controller
{
    /**
     * Display a pending orders.
     */
    public function pendingOrders()
    {
        $row = (int) request('row', 10);

        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        $orders = Order::where('order_status', 'pending')
            ->sortable()
            ->paginate($row)
            ->appends(request()->query());

        return view('admin.order.pending-orders', [
            'orders' => $orders
        ]);
    }

    /**
     * Display a pending orders.
     */
    public function completeOrders()
    {
        $row = (int) request('row', 10);

        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        $orders = Order::where('order_status', 'complete')
            ->sortable()
            ->paginate($row)
            ->appends(request()->query());

        return view('admin.order.complete-orders', [
            'orders' => $orders
        ]);
    }


    public function dueOrders()
    {
        $row = (int) request('row', 10);

        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        $orders = Order::where('due', '>', '0')
            ->sortable()
            ->paginate($row)
            ->appends(request()->query());

        return view('admin.order.due-orders', [
            'orders' => $orders
        ]);
    }

    /**
     * Display an order details.
    */
    public function dueOrderDetails(String $order_id)
    {
        $order = Order::where('id', $order_id)->first();
        $orderDetails = OrderDetail::with('product')
            ->where('order_id', $order_id)
            ->orderBy('id')
            ->get();

        return view('admin.order.details-due-order', [
            'order' => $order,
            'orderDetails' => $orderDetails,
        ]);
    }

    /**
     * Display an order details.
    */
    public function orderDetails(String $order_id)
    {
        $order = Order::where('id', $order_id)->first();
        $orderDetails = OrderDetail::with('product')
            ->where('order_id', $order_id)
            ->orderBy('id')
            ->get();

        return view('admin.order.details-order', [
            'order' => $order,
            'orderDetails' => $orderDetails,
        ]);
    }

    // FUNCTION TO CREATE PURCHASE CODE

    public function generateOrderCode() {
        // Get the last product number from the database
        $lastOrderCode = DB::table('orders')->orderBy('id', 'desc')->value('invoice_no');
    
        if (!$lastOrderCode) {
            $ordercode = 100000000000;
        } else {
            // Otherwise, increment the last membership number by 1
            $ordercode = $lastOrderCode + 1;
        }

        return $ordercode;
    }


    /**
     * Handle create new order
     */
    public function createOrder(Request $request)
    {
        $rules = [
            'customer_id' => 'required|numeric',
            'payment_type' => 'required|string',
            'pay' => 'required|numeric',
        ];

        $invoice_no = $this->generateOrderCode();

        $validatedData = $request->validate($rules);

        $taxRate = $request->vat;


        $validatedData['order_date'] = Carbon::now()->format('Y-m-d');
        $validatedData['order_status'] = 'pending';
        $validatedData['total_products'] = Cart::count();
        $validatedData['sub_total'] = Cart::subtotal();
        // Set the tax rate on the cart
        // $validatedData['vat'] = Cart::setTax($taxRate);
        $validatedData['vat'] = Cart::tax();
        $validatedData['invoice_no'] = $invoice_no;
        $validatedData['total'] = Cart::total();
        $validatedData['due'] = ((int)Cart::total() - (int)$validatedData['pay']);
        $validatedData['created_at'] = Carbon::now();

        $order_id = Order::insertGetId($validatedData);

        // Create Order Details
        $contents = Cart::content();
        $oDetails = array();

        foreach ($contents as $content) {
            $oDetails['order_id'] = $order_id;
            $oDetails['product_id'] = $content->id;
            $oDetails['quantity'] = $content->qty;
            $oDetails['unitcost'] = $content->price;
            $oDetails['total'] = $content->subtotal;
            // $oDetails['invoice_no'] = $content->invoice_no;
            $oDetails['invoice_no'] = $this->generateOrderCode();
            $oDetails['created_at'] = Carbon::now();

            OrderDetail::insert($oDetails);
        }

        // Delete Cart Sopping History
        Cart::destroy();

        return redirect()->route('admin.order.pendingOrders')->with('success', 'Order has been created!');
    }

    /**
     * Handle update a status order
     */
    public function updateOrder(Request $request)
    {
        $order_id = $request->id;

        // Reduce the stock
        $products = OrderDetail::where('order_id', $order_id)->get();

        foreach ($products as $product) {
            Product::where('id', $product->product_id)
                    ->update(['stock' => DB::raw('stock-'.$product->quantity)]);
        }

        Order::findOrFail($order_id)->update(['order_status' => 'complete']);

        return redirect()->route('admin.order.completeOrders')->with('success', 'Order has been completed!');
    }

    /**
     * Handle update a due pay order
     */
    public function updateDueOrder(Request $request)
    {
        $rules = [
            'id' => 'required|numeric',
            'pay' => 'required|numeric'
        ];

        $validatedData = $request->validate($rules);
        $order = Order::findOrFail($validatedData['id']);

        $mainPay = $order->pay;
        $mainDue = $order->due;

        $paidDue = $mainDue - $validatedData['pay'];
        $paidPay = $mainPay + $validatedData['pay'];

        Order::findOrFail($validatedData['id'])->update([
            'due' => $paidDue,
            'pay' => $paidPay
        ]);

        return redirect()->route('admin.order.dueOrders')->with('success', 'Due amount has been updated!');
    }

        /**
     * Handle to print an invoice.
     */
    public function downloadInvoice(Int $order_id)
    {
        $order = Order::with('customer')->where('id', $order_id)->first();
        $orderDetails = OrderDetail::with('product')
                        ->where('order_id', $order_id)
                        ->orderBy('id', 'DESC')
                        ->get();

        return view('admin.orders.print-invoice', [
            'order' => $order,
            'orderDetails' => $orderDetails,
        ]);
    }
}
