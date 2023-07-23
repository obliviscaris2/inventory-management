<x-admin-layout>

    @section('content')
        <!-- BEGIN: Main Page Content -->
        <div class="">
            <div class="row">
                <div class="col-xl-4">
                    <!-- Product image card-->
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header">Product Image</div>
                        <div class="card-body text-center">
                            <!-- Product image -->
                            {{-- <img class="img-account-profile mb-2" src="{{ asset('assets/img/products/default.webp') }}"
                                alt="" id="image-preview" />
                            @if ($product->product_image)
                                @foreach (json_decode($product->product_image) as $image)
                                    <img src="{{ asset('uploads/products/image/' . $image) }}" id="preview"
                                        style="width: 100%; height: 100%">
                                @endforeach
                            @endif --}}
                            
                            @if ($product->product_image)
                                @foreach (json_decode($product->product_image) as $image)
                                    <img src="{{ asset('uploads/products/image/' . $image) }}" id="preview" style="width: 100%; height: 100%">
                                @endforeach
                            @else
                                <img class="img-account-profile mb-2" src="{{ asset('assets/img/products/default.webp') }}" alt="" id="image-preview" style="width: 100%; height: 100%"/>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-xl-8">
                    <!-- BEGIN: Product Code -->
                    <div class="card mb-4">
                        <div class="card-header">
                            Product Code
                        </div>
                        <div class="card-body">
                            <!-- Form Row -->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (type of product category) -->
                                <div class="col-md-6">
                                    <label class="small mb-1">Product code</label>
                                    <div class="form-control form-control-solid">{{ $product->product_code }}</div>
                                </div>
                                <!-- Form Group (type of product unit) -->
                                <div class="col-md-6 align-middle">
                                    <label class="small mb-1">Barcode</label>
                                    <a href="{{ asset('product/barcodes/' . $product->barcode) }}" download>
                                        <span class="">
                                            <i class="fa-solid fa-download fa-lg"></i>
                                        </span>
                                    </a>
                                    <div class="mt-1">
                                        <img src="{{ asset('product/barcodes/' . $product->barcode) }}" alt="Barcode">
                                        <p class="text-center" style="width: 53%;">{{ $product->product_code }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END: Product Code -->

                    <!-- BEGIN: Product Information -->
                    <div class="card mb-4">
                        <div class="card-header">
                            Product Information
                        </div>
                        <div class="card-body">
                            <!-- Form Group (product name) -->
                            <div class="mb-3">
                                <label class="small mb-1">Product name</label>
                                <div class="form-control form-control-solid">{{ $product->product_name }}</div>
                            </div>
                            <!-- Form Row -->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (type of product category) -->
                                <div class="col-md-6">
                                    <label class="small mb-1">Product category</label>
                                    <div class="form-control form-control-solid">{{ $product->category->name}}</div>
                                </div>
                                <!-- Form Group (type of product unit) -->
                                <div class="col-md-6">
                                    <label class="small mb-1">Product unit</label>
                                    <div class="form-control form-control-solid">{{ $product->unit->name }}</div>
                                </div>
                            </div>
                            <!-- Form Row -->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (buying price) -->
                                <div class="col-md-6">
                                    <label class="small mb-1">Buying price</label>
                                    <div class="form-control form-control-solid">{{ $product->buying_price }}</div>
                                </div>
                                <!-- Form Group (selling price) -->
                                <div class="col-md-6">
                                    <label class="small mb-1">Selling price</label>
                                    <div class="form-control form-control-solid">{{ $product->selling_price }}</div>
                                </div>
                            </div>
                            <!-- Form Group (stock) -->
                            <div class="mb-3">
                                <label class="small mb-1">Stock</label>
                                <div class="form-control form-control-solid">{{ $product->stock }}</div>
                            </div>

                            <!-- Submit button -->
                            <a class="btn btn-primary" href="{{ route('admin.product.index') }}">Back</a>
                        </div>
                    </div>
                    <!-- END: Product Information -->
                </div>
            </div>
            </form>
        </div>
        <!-- END: Main Page Content -->
    @endsection


</x-admin-layout>
