<x-admin-layout>

    @section('content')
        <!-- BEGIN: Header -->
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto">
                            <h2 class="page-header-title">
                                {{ $page_title }}
                            </h2>
                        </div>
                    </div>

                    <nav class="rounded" aria-label="breadcrumb">
                        <ol class="breadcrumb rounded mb-4">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">Products</a></li>
                            <li class="breadcrumb-item active">Create</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </header>
        <!-- END: Header -->
        <div class="container-xl px-2 mt-n10">
            <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-xl-4">
                        <!-- Product image card-->
                        <div class="card mb-4 mb-xl-0">
                            <div class="card-header">Product Image</div>
                            <div class="card-body text-center">
                                <!-- Product image -->
                                <img class="img-account-profile mb-2" src="{{ asset('assets/img/products/default.webp') }}"
                                alt="" id="image-preview" style= "max-width: 200px; max-height: 200px;"/>
                                <img id="preview" class="mb-2 img-account-profile" style="max-width: 200px; max-height: 200px;">
                                <!-- Product image help block -->
                                <div class="small font-italic text-muted mb-2">JPG or PNG no larger than 2 MB</div>
                                <!-- Product image input -->
                                <input class="form-control form-control-solid mb-2 @error('product_image') is-invalid @enderror" type="file" id="image" name="product_image[]" multiple onchange="previewImage(event);">
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-8">
                        <!-- BEGIN: Product Details -->
                        <div class="card mb-4">
                            <div class="card-header">
                                Product Details
                            </div>
                            <div class="card-body">
                                <!-- Form Group (product name) -->
                                <div class="mb-3">
                                    <label class="small mb-1" for="product_name">
                                        Product name 
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input class="form-control form-control-solid @error('product_name') is-invalid @enderror" id="product_name" name="product_name" type="text" placeholder="" value="{{ old('product_name') }}" autocomplete="off" />
                                    <!-- Form Row -->
                                    <div class="row gx-3 mb-3">
                                        <!-- Form Group (type of product category) -->
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="category_id">Product category <span
                                                    class="text-danger">*</span></label>
                                            <select
                                                class="form-select form-control-solid @error('category_id') is-invalid @enderror"
                                                id="category_id" name="category_id">
                                                <option selected="" disabled="">Select a category:</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        @if (old('category_id') == $category->id) selected="selected" @endif>
                                                        {{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!-- Form Group (type of product unit) -->
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="unit_id">Unit <span
                                                    class="text-danger">*</span></label>
                                            <select
                                                class="form-select form-control-solid @error('unit_id') is-invalid @enderror"
                                                id="unit_id" name="unit_id">
                                                <option selected="" disabled="">Select a unit:</option>
                                                @foreach ($units as $unit)
                                                    <option value="{{ $unit->id }}"
                                                        @if (old('unit_id') == $unit->id) selected="selected" @endif>
                                                        {{ $unit->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Form Row -->
                                    <div class="row gx-3 mb-3">
                                        <!-- Form Group (buying price) -->
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="buying_price">Buying price <span
                                                    class="text-danger">*</span></label>
                                            <input
                                                class="form-control form-control-solid @error('buying_price') is-invalid @enderror"
                                                id="buying_price" name="buying_price" type="text" placeholder=""
                                                value="{{ old('buying_price') }}" autocomplete="off" />
                                        </div>
                                        <!-- Form Group (selling price) -->
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="selling_price">Selling price <span
                                                    class="text-danger">*</span></label>
                                            <input
                                                class="form-control form-control-solid @error('selling_price') is-invalid @enderror"
                                                id="selling_price" name="selling_price" type="text" placeholder=""
                                                value="{{ old('selling_price') }}" autocomplete="off" />
                                        </div>
                                    </div>
                                    <!-- Form Group (stock) -->
                                    <div class="mb-3">
                                        <label class="small mb-1" for="stock">Stock <span
                                                class="text-danger">*</span></label>
                                        <input class="form-control form-control-solid @error('stock') is-invalid @enderror"
                                            id="stock" name="stock" type="text" placeholder=""
                                            value="{{ old('stock') }}" autocomplete="off" />
                                    </div>
                                    <!-- Submit button -->
                                    <button class="btn btn-primary" type="submit">Save</button>
                                    <a class="btn btn-danger" href="{{ route('admin.product.index') }}">Cancel</a>
                                </div>
                            </div>
                            <!-- END: Product Details -->
                        </div>
                    </div>
                </div>
            </form>
        </div>





        <script>
            const previewImage = e => {
                const reader = new FileReader();
                reader.readAsDataURL(e.target.files[0]);
                reader.onload = () => {
                    const preview = document.getElementById('preview');
                    const imagePreview = document.getElementById('image-preview');
            
                    // Hide the default image if a file is selected
                    imagePreview.style.display = 'none';
                    
                    // Show the uploaded image preview
                    preview.style.display = 'block';
                    preview.src = reader.result;

                };
            };
        </script>
    @endsection



</x-admin-layout>
