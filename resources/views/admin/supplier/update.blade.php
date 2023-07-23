<x-admin-layout>

    @section('content')
        <!-- BEGIN: Header -->
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h2 class="page-header-title">
                                {{ $page_title }}
                            </h2>
                        </div>
                    </div>

                    <nav class="mt-4 rounded" aria-label="breadcrumb">
                        <ol class="breadcrumb rounded mb-4">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.supplier.index') }}">Products</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </header>
        <!-- END: Header -->
        <!-- BEGIN: Main Page Content -->
        <div class="container-xl px-2 mt-n10">
            <form action="{{ route('admin.supplier.update', $supplier->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $supplier->id }}">
                <div class="row">
                    <div class="col-xl-4">
                        <!-- Profile picture card-->
                        <div class="card mb-4 mb-xl-0">
                            <div class="card-header">Profile Picture</div>
                            <div class="card-body text-center">
                                <!-- Profile picture image -->
                                @if ($supplier->photo)
                                    @foreach (json_decode($supplier->photo) as $image)
                                        <img src="{{ asset('uploads/supplier/image/' . $image) }}" id="preview"
                                            style="width: 100%; height: 100%">
                                    @endforeach
                                @else
                                <img class="img-account-profile mb-2" src="{{ asset('assets/img/demo/user-sample.png') }}" alt="" id="image-preview" style="width: 100%; height: 100%"/>
                            @endif
                            <!-- Product image help block -->
                            <div class="small font-italic text-muted mb-2">JPG or PNG no larger than 2 MB</div>
                            <!-- Product image input -->
                            <input class="form-control form-control-solid mb-2" type="file" id="image" name="photo[]" multiple onchange="previewImage(event);">
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-8">
                        <!-- BEGIN: Supplier Details -->
                        <div class="card mb-4">
                            <div class="card-header">
                                Supplier Details
                            </div>
                            <div class="card-body">
                                <!-- Form Group (name) -->
                                <div class="mb-3">
                                    <label class="small mb-1" for="name">Name <span class="text-danger">*</span></label>
                                    <input class="form-control form-control-solid @error('name') is-invalid @enderror"
                                        id="name" name="name" type="text" placeholder=""
                                        value="{{ old('name', $supplier->name) }}" />
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <!-- Form Group (email address) -->
                                <div class="mb-3">
                                    <label class="small mb-1" for="email">Email address <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control form-control-solid @error('email') is-invalid @enderror"
                                        id="email" name="email" type="text" placeholder=""
                                        value="{{ old('email', $supplier->email) }}" />
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <!-- Form Group (shopname) -->
                                <div class="mb-3">
                                    <label class="small mb-1" for="shopname">Shopname <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control form-control-solid @error('shopname') is-invalid @enderror"
                                        id="shopname" name="shopname" type="text" placeholder=""
                                        value="{{ old('shopname', $supplier->shopname) }}" />
                                    @error('shopname')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <!-- Form Group (phone number) -->
                                <div class="mb-3">
                                    <label class="small mb-1" for="phone">Phone number <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control form-control-solid @error('phone') is-invalid @enderror"
                                        id="phone" name="phone" type="text" placeholder=""
                                        value="{{ old('phone', $supplier->phone) }}" />
                                    @error('phone')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <!-- Form Row -->
                                <div class="row gx-3 mb-3">
                                    <!-- Form Group (type of supplier) -->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="type">Type of supplier <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select form-control-solid @error('type') is-invalid @enderror"
                                            id="type" name="type">
                                            <option selected="" disabled="">Select a type:</option>
                                            <option value="Distributor"
                                                @if (old('type', $supplier->type) == 'Distributor') selected="selected" @endif>Distributor
                                            </option>
                                            <option value="Whole Seller"
                                                @if (old('type', $supplier->type) == 'Whole Seller') selected="selected" @endif>Whole Seller
                                            </option>
                                        </select>
                                        @error('type')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <!-- Form Group (bank name) -->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="bank_name">Bank Name</label>
                                        <select
                                            class="form-select form-control-solid @error('bank_name') is-invalid @enderror"
                                            id="bank_name" name="bank_name">
                                            <option value="{{ $supplier->bank_name }}">{{ $supplier->bank_name }}</option>
                                            <option selected="" disabled="">Select a bank:</option>
                                            <option value="Nabil"
                                                @if (old('bank_name') == 'NABIL') selected="selected" @endif>Nabil</option>
                                            <option value="NIB"
                                                @if (old('bank_name') == 'NIB') selected="selected" @endif>NIB</option>
                                            <option value="LAXMI"
                                                @if (old('bank_name') == 'LAXMI') selected="selected" @endif>Laxmi</option>
                                            <option value="KUMARI"
                                                @if (old('bank_name') == 'KUMARI') selected="selected" @endif>Kumari</option>
                                        </select>
                                        @error('bank_name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Form Row -->
                                <div class="row gx-3 mb-3">
                                    <!-- Form Group (account holder) -->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="account_holder">Account holder</label>
                                        <input
                                            class="form-control form-control-solid @error('account_holder') is-invalid @enderror"
                                            id="account_holder" name="account_holder" type="text" placeholder=""
                                            value="{{ old('account_holder', $supplier->account_holder) }}" />
                                        @error('account_holder')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <!-- Form Group (account_name) -->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="account_number">Account number</label>
                                        <input
                                            class="form-control form-control-solid @error('account_number') is-invalid @enderror"
                                            id="account_number" name="account_number" type="text" placeholder=""
                                            value="{{ old('account_number', $supplier->account_number) }}" />
                                        @error('account_number')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Form Group (address) -->
                                <div class="mb-3">
                                    <label for="address">Address <span class="text-danger">*</span></label>
                                    <textarea class="form-control form-control-solid @error('address') is-invalid @enderror" id="address"
                                        name="address" rows="3">{{ old('address', $supplier->address) }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Submit button -->
                                <button class="btn btn-primary" type="submit">Save</button>
                                <a class="btn btn-danger" href="{{ route('admin.supplier.index') }}">Cancel</a>
                            </div>
                        </div>
                        <!-- END: Supplier Details -->
                    </div>
                </div>
            </form>
        </div>
        <!-- END: Main Page Content -->
    @endsection


</x-admin-layout>
