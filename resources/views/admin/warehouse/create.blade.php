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

                    <nav class="rounded" aria-label="breadcrumb">
                        <ol class="breadcrumb rounded mb-4">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.warehouse.index') }}">Warehouses</a></li>
                            <li class="breadcrumb-item active">Create</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </header>
        <!-- END: Header -->

        <!-- BEGIN: Main Page Content -->
        <div class="container-xl px-2 mt-n10">
            <form action="{{ route('admin.warehouse.store') }}" method="POST">
                @csrf
                <div class="row">

                    <div class="col-xl-12">
                        <!-- BEGIN: Category Details -->
                        <div class="card mb-4">
                            <div class="card-header">
                                Warehouse Details
                            </div>
                            <div class="card-body">
                                <!-- Form Group (name) -->
                                <div class="mb-3">
                                    <label class="small mb-1" for="name">Warehouse Name <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control form-control-solid @error('name') is-invalid @enderror"
                                        id="name" name="name" type="text" placeholder=""
                                        value="{{ old('name') }}" autocomplete="off" />
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <!-- Form Group (slug) -->
                                <div class="mb-3">
                                    <label class="small mb-1" for="address">Address</label>
                                    <input class="form-control form-control-solid @error('address') is-invalid @enderror"
                                        id="address" name="address" type="text" placeholder=""
                                        value="{{ old('address') }}" autocomplete="off" />
                                    @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Submit button -->
                                <button class="btn btn-primary" type="submit">Add</button>
                                <a class="btn btn-danger" href="{{ route('admin.category.index') }}">Cancel</a>
                            </div>
                        </div>
                        <!-- END: Category Details -->
                    </div>
                </div>
            </form>
        </div>
        <!-- END: Main Page Content -->
    @endsection

</x-admin-layout>
