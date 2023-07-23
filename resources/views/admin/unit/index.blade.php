<x-admin-layout>

    @section('content')
        <!-- BEGIN: Header -->
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl">
                <div class="page-header-content">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h2 class="page-header-title mb-5">
                                {{ $page_title }}
                            </h2>
                        </div>
                        <div class="col-auto my-4">
                            <a href="{{ route('admin.unit.create') }}" class="btn btn-primary add-list">
                                <i class="fa-solid fa-plus me-3"></i>
                                Add
                            </a>
                            <a href="{{ route('admin.unit.index') }}" class="btn btn-danger add-list">
                                <i class="fa-solid fa-trash me-3"></i>
                                Clear Search
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- BEGIN: Alert -->
            <div class="container-xl px-4 mt-n4">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-icon d-flex gap-4" role="alert" style="width: 700px;">
                        <div class="d-flex gap-4">
                            <div class="alert-icon-aside">
                                <i class="far fa-flag"></i>
                            </div>
                            <div class="alert-icon-content">
                                {{ session('success') }}
                            </div>
                            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>

                        </div>
                    </div>
                @endif
            </div>
            <!-- END: Alert -->
        </header>
        <!-- END: Header -->


        <!-- BEGIN: Main Page Content -->
        <div class="container px-2 mt-n10">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row mx-n4">
                        <div class="col-lg-12 card-header mt-n4">
                            <form action="{{ route('admin.unit.index') }}" method="GET">
                                <div class="d-flex flex-wrap align-items-center justify-content-between">
                                    <div class="d-flex flex-wrap gap-2">
                                        <div class="form-group row align-items-center">
                                            <label for="row" class="col-auto">Row:</label>
                                            <div class="col-auto">
                                                <select class="form-control" name="row">
                                                    <option value="10"
                                                        @if (request('row') == '10') selected="selected" @endif>10</option>
                                                    <option value="25"
                                                        @if (request('row') == '25') selected="selected" @endif>25</option>
                                                    <option value="50"
                                                        @if (request('row') == '50') selected="selected" @endif>50</option>
                                                    <option value="100"
                                                        @if (request('row') == '100') selected="selected" @endif>100
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <button class="btn btn-sm btn-outline-primary" style="height: 35px;" type="submit">View</button>
                                    </div>

                                    <div class="form-group row align-items-center justify-content-between">
                                        <label class="control-label col-sm-3" for="search">Search:</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input type="text" id="search" class="form-control me-1"
                                                    name="search" placeholder="Search warehouse"
                                                    value="{{ request('search') }}">
                                                <div class="input-group-append">
                                                    <button type="submit" class="input-group-text bg-primary"><i
                                                            class="fa-solid fa-magnifying-glass font-size-20 text-white"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <hr>

                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">No.</th>
                                            <th scope="col">@sortablelink('name', 'Unit Name')</th>
                                            <th scope="col">@sortablelink('slug', 'Unit Slug')</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($units as $unit)
                                            <tr>
                                                <th scope="row">
                                                    {{ $units->currentPage() * (request('row') ? request('row') : 10) - (request('row') ? request('row') : 10) + $loop->iteration }}
                                                </th>
                                                <td>{{ $unit->name }}</td>
                                                <td>{{ $unit->slug }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        {{-- <a href="{{ route('admin.category.show', $product->id) }}"
                                                                    class="btn btn-outline-success btn-sm mx-1">
                                                                    <i class="fa-solid fa-eye"></i>
                                                                </a> --}}
                                                        <button type="button" class="btn btn-outline-primary btn-sm mx-1"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#edit{{ $unit->id }}">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-outline-danger btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#delete{{ $unit->id }}">
                                                            <i class="far fa-trash-alt"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    {{-- =====================================
                                                MODAL - EDIT
                                    ====================================     --}}
                                    @foreach ($units as $unit)
                                        <div class="modal fade" id="edit{{ $unit->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">This can't be undone.
                                                            Are you sure?</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger"
                                                            data-bs-dismiss="modal">No</button>
                                                        <a href="{{ url('admin/unit/edit/' . $unit->id) }}">
                                                            <button type="button" class="btn btn-danger">Yes
                                                            </button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    {{-- =====================================
                                                MODAL - DELETE
                                    ====================================     --}}

                                    @foreach ($units as $unit)
                                        <div class="modal fade" id="delete{{ $unit->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">This can't be
                                                            undone. Are you sure?</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger"
                                                            data-bs-dismiss="modal">No</button>
                                                        <a href="{{ url('admin/unit/destroy/' . $unit->id) }}">
                                                            <button type="button" class="btn btn-danger">
                                                                Yes
                                                            </button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        {{-- {{ $units->links() }} --}}
                        {!! $units->appends(Request::all())->links() !!}
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Main Page Content -->
    @endsection

</x-admin-layout>
