<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Product;
use App\Models\Category;
use Milon\Barcode\DNS1D;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Picqer\Barcode\BarcodeGeneratorPNG;
use Picqer\Barcode\BarcodeGeneratorHTML;
// use Picqer\Barcode\BarcodeGeneratorHTML;

class ProductController extends Controller
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

        $products = Product::with(['category', 'unit'])
                ->filter(request(['search']))
                ->sortable()
                ->paginate($row)
                ->appends(request()->query());

        return view('admin.product.index', [
            'products' => $products,
            'page_title' => 'Products List'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $units = Unit::all();

        return view ('admin.product.create', [
            'categories' => $categories,
            'units'      => $units,
            'page_title' => 'Create Product'
        ]);
    }

    // FUNCTION TO CREATE PRODUCTCODE

    public function generateProductCode() {
        // Get the last product number from the database
        $lastProductCode = DB::table('products')->orderBy('id', 'desc')->value('product_code');
    
        if (!$lastProductCode) {
            $productcode = 100000000000;
        } else {
            // Otherwise, increment the last membership number by 1
            $productcode = $lastProductCode + 1;
        }

        return $productcode;
    }

    // FUNCTION TO CONVERT IMAGE

    private function convertProductImages($images)
    {
        $ext = 'webp';
        $product_names = [];

        foreach ($images as $image) {
            $product_name = hexdec(uniqid()) . '-' . time() . '.' . $ext;
            $product_destination_path = public_path('uploads/products/image/') . $product_name;
            $image_convert = Image::make($image->getRealPath());
            $image_convert->save($product_destination_path, 10);
            $product_names[] = $product_name;
        }

        return $product_names;
    }

    public function generateBarcode($productName, $unitName, $productCode)
    {
        $generator = new BarcodeGeneratorPNG();
        $barcodeData = $generator->getBarcode($productCode, $generator::TYPE_CODE_128);
    
        $barcodePath = public_path('product/barcodes/');
        if (!file_exists($barcodePath)) {
            mkdir($barcodePath, 0777, true);
        }
    
        $barcodeFilename = uniqid() . '-' .$productName . '-' . $unitName . '.png';
        $barcodeFilePath = $barcodePath . $barcodeFilename;
    
        file_put_contents($barcodeFilePath, $barcodeData);
    
        return $barcodeFilename;

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'product_image.*' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'product_name' => 'required|string',
            'category_id' => 'required|integer',
            'unit_id' => 'required|integer',
            'stock' => 'required|integer',
            'buying_price' => 'nullable|integer',
            'selling_price' => 'nullable|integer',
            'product_code' => 'nullable|string',
            'barcode' => 'nullable|string'
        ]);


        try {

            $product = new Product();

            $product->product_image = $request->hasFile('product_image') ? json_encode($this->convertProductImages($request->file('product_image'))) : [];
    
            $product->product_name = $request->product_name;
            $product->category_id = $request->category_id;
            $product->unit_id = $request->unit_id;
            $product->stock = $request->stock;
            $product->buying_price = $request->buying_price;
            $product->selling_price = $request->selling_price;
            $product->product_code = $this->generateProductCode();
            $product->barcode = $this->generateBarcode($product->product_name, $product->unit->name, $product->product_code);
    
    
            if($product->save()){
                return redirect()->route('admin.product.index')->with('success', 'Product has been created!');
            };
        
        } catch (\Exception) {
            return redirect()->back()->with('error', 'Failed to create product. Please try again.');
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product, $id)
    {
        $product = Product::find($id);

        return view('admin.product.show', [
            'product' => $product,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product, $id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        $units = Unit::all();

        return view('admin.product.update', [
            'units'      => $units,
            'product'    => $product,
            'categories' => $categories,
            'page_title' => 'Edit Product'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'product_image.*' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'product_name' => 'required|string',
            'category_id' => 'required|integer',
            'unit_id' => 'required|integer',
            'stock' => 'required|integer',
            'buying_price' => 'nullable|integer',
            'selling_price' => 'nullable|integer',
            'product_code' => 'nullable|string'
        ]);

        try {
            $product = Product::find($request->id);

            $product->product_name = $request->product_name;
            $product->category_id = $request->category_id;
            $product->unit_id = $request->unit_id;
            $product->stock = $request->stock;
            $product->buying_price = $request->buying_price;
            $product->selling_price = $request->selling_price;
            $product->product_code = $this->generateProductCode();
    
            if ($request->hasFile('product_image')) {
    
                $product->product_image = $request->hasFile('product_image') ? json_encode($this->convertProductImages($request->file('product_image'))) : [];
            }
            
            $product->save();
    
            return redirect()->route('admin.product.index')->with('success', 'Product has been updated!');

        } catch (\Exception) {
            return redirect()->back()->with('error', 'Failed to update product. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, $id)
    {
        try {

            $product = Product::find($id);
            
            if($product->product_image){
                Storage::delete('public/products/image' . $product->product_image);
            }
    
            Product::destroy($product->id);
    
            return redirect()->route('admin.product.index')->with('success', 'Product has been deleted!');

        } catch (\Exception) {
            return redirect()->back()->with('error', 'Failed to delete the product. Please try again.');
        }

    }
}
