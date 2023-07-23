<x-admin-layout>

    @section('content')
        <!-- BEGIN: Header -->
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl">
                <div class="page-header-content">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h2 class="page-header-title mb-5">
                                <div class="page-header-icon"></div>
                                Due Orders
                            </h2>
                        </div>
                        <div class="col-auto my-4">
                            <a href="{{ route('admin.pos.index') }}" class="btn btn-primary add-list">
                                <i class="fa-solid fa-plus me-3"></i>
                                Add
                            </a>
                            <a href="{{ route('admin.product.index') }}" class="btn btn-danger add-list">
                                <i class="fa-solid fa-trash me-3"></i>
                                Clear Search
                            </a>
                        </div>
                    </div>
                    <nav class="rounded" aria-label="breadcrumb">
                        <ol class="breadcrumb px-3 py-2 rounded mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Pending Orders</li>
                        </ol>
                    </nav>
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
                            <form action="{{ route('admin.order.dueOrders') }}" method="GET">
                                <div class="d-flex flex-wrap align-items-center justify-content-between">
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

                                    <div class="form-group row align-items-center justify-content-between">
                                        <label class="control-label col-sm-3" for="search">Search:</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input type="text" id="search" class="form-control me-1"
                                                    name="search" placeholder="Search order"
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
                                <table class="table table-striped align-middle">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">No.</th>
                                            <th scope="col">Invoice No</th>
                                            <th scope="col">@sortablelink('customer.name', 'name')</th>
                                            <th scope="col">@sortablelink('order_date', 'date')</th>
                                            <th scope="col">Payment</th>
                                            <th scope="col">@sortablelink('pay')</th>
                                            <th scope="col">@sortablelink('due')</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <th scope="row">
                                                    {{ $orders->currentPage() * (request('row') ? request('row') : 10) - (request('row') ? request('row') : 10) + $loop->iteration }}
                                                </th>
                                                <td>{{ $order->invoice_no }}</td>
                                                <td>{{ $order->customer->name }}</td>
                                                <td>{{ $order->order_date }}</td>
                                                <td>{{ $order->payment_type }}</td>
                                                <td>
                                                    <span class="btn btn-warning btn-sm">{{ $order->pay }}</span>
                                                </td>
                                                <td>
                                                    <span class="btn btn-danger btn-sm">{{ $order->due }}</span>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('order.dueOrderDetails', $order->id) }}"
                                                            class="btn btn-outline-success btn-sm mx-1"><i
                                                                class="fa-solid fa-money-bill"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Main Page Content -->
    @endsection

</x-admin-layout>
