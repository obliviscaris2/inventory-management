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
                            <li class="breadcrumb-item"><a href="{{ route('admin.category.index') }}">Categories</a></li>
                            <li class="breadcrumb-item active">Create</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </header>
        <!-- END: Header -->

        <!-- BEGIN: Main Page Content -->
        <div class="container-xl px-2 mt-n10">
            <form action="{{ route('admin.category.store') }}" method="POST">
                @csrf
                <div class="row">

                    <div class="col-xl-12">
                        <!-- BEGIN: Category Details -->
                        <div class="card mb-4">
                            <div class="card-header">
                                Category Details
                            </div>
                            <div class="card-body">
                                <!-- Form Group (name) -->
                                <div class="mb-3">
                                    <label class="small mb-1" for="name">Category Name <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control form-control-solid"
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
                                    <label class="small mb-1" for="slug">Category Slug (non editable).</label>
                                    <input class="form-control form-control-solid"
                                        id="slug" name="slug" type="text" placeholder=""
                                        value="{{ old('slug') }}" readonly />
                                    @error('slug')
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

        <script>
            // Slug Generator
            const title = document.querySelector("#name");
            const slug = document.querySelector("#slug");
            title.addEventListener("keyup", function() {
                let preslug = title.value;
                preslug = preslug.replace(/ /g, "-");
                slug.value = preslug.toLowerCase();
            });
        </script>
    @endsection

</x-admin-layout>
