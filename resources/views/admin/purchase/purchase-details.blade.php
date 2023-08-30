<x-admin-layout>
    @section('content')
        <!-- BEGIN: Header -->
        <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
            <div class="container-xl px-4">
                <div class="page-header-content">
                    <div class="row align-items-center justify-content-between pt-3">
                        <div class="col-auto mb-3">
                            <h2 class="page-header-title">
                                Purchase Details
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- END: Header -->

        <!-- BEGIN: Main Page Content -->
        <div class="container-xl px-4">
            <div class="row">

                <!-- BEGIN: Information Supplier -->
                <div class="col-xl-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            Supplier Information
                        </div>
                        <div class="card-body">
                            <!-- Form Row -->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (supplier name) -->
                                <div class="col-md-6">
                                    <label class="small mb-1">Name</label>
                                    <div class="form-control form-control-solid">{{ $purchase->supplier->name }}</div>
                                </div>
                                <!-- Form Group (supplier email) -->
                                <div class="col-md-6">
                                    <label class="small mb-1">Email</label>
                                    <div class="form-control form-control-solid">{{ $purchase->supplier->email }}</div>
                                </div>
                            </div>
                            <!-- Form Row -->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (supplier phone number) -->
                                <div class="col-md-6">
                                    <label class="small mb-1">Phone</label>
                                    <div class="form-control form-control-solid">{{ $purchase->supplier->phone }}</div>
                                </div>
                                <!-- Form Group (order date) -->
                                <div class="col-md-6">
                                    <label class="small mb-1">Order Date</label>
                                    <div class="form-control form-control-solid">{{ $purchase->purchase_date }}</div>
                                </div>
                            </div>
                            <!-- Form Row -->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (no invoice) -->
                                <div class="col-md-6">
                                    <label class="small mb-1">Purchase No.</label>
                                    <div class="form-control form-control-solid">{{ $purchase->purchase_no }}</div>
                                </div>
                                <!-- Form Group (paid amount) -->
                                <div class="col-md-6">
                                    <label class="small mb-1">Total</label>
                                    <div class="form-control form-control-solid">{{ $purchase->total_amount }}</div>
                                </div>
                            </div>
                            <!-- Form Row -->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (due amount) -->
                                <div class="col-md-6">
                                    <label class="small mb-1">Created By</label>
                                    <div class="form-control form-control-solid">{{ $purchase->user_created->name }}</div>
                                </div>
                                <!-- Form Group (paid amount) -->
                                <div class="col-md-6">
                                    <label class="small mb-1">Updated By</label>
                                    <div class="form-control form-control-solid">
                                        {{ $purchase->user_updated ? $purchase->user_updated->name : '-' }}</div>
                                </div>
                            </div>
                            <!-- Form Group (address) -->
                            <div class="mb-3">
                                <label class="small mb-1">Address</label>
                                <div class="form-control form-control-solid">{{ $purchase->supplier->address }}</div>
                            </div>

                            @if ($purchase->purchase_status == 0)

                                    <!-- Submit button -->
                                    {{-- <button type="submit" class="btn btn-success" onclick="return confirm('Are you sure you want to approve this purchase?')">
                                        Approve Purchase
                                    </button> --}}
                                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#sure">
                                        Approve Purchase
                                    </button>
                                    <a class="btn btn-primary" href="{{ URL::previous() }}">Back</a>

                            @else
                                <a class="btn btn-primary" href="{{ URL::previous() }}">Back</a>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- END: Information Supplier -->

                {{-- =====================================
                        MODAL - SUBMIT/APPROVE
                ====================================     --}}
                <div class="modal fade" id="sure" tabindex="-1"
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
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                                <form action="{{ route('admin.purchase.updatePurchase') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $purchase->id }}">
                                    <button type="submit" class="btn btn-danger">
                                        Yes
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- BEGIN: Table Product -->
                <div class="col-xl-12">
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header">List Product</div>

                        <div class="card-body">
                            <!-- BEGIN: Products List -->
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-striped align-middle">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">No.</th>
                                                <th scope="col">Photo</th>
                                                <th scope="col">Product Name</th>
                                                <th scope="col">Product Code</th>
                                                <th scope="col">Current Stock</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($purchaseDetails as $item)
                                                <tr>
                                                    <td scope="row">{{ $loop->iteration }}</td>
                                                    <td scope="row">
                                                        <div style="max-height: 80px; max-width: 80px;">
                                                            {{-- <img class="img-fluid"
                                                                src="{{ $item->product->product_image ? asset('uploads/products/image/' . $item->product->product_image) : asset('assets/img/products/default.webp') }}"> --}}
                                                        </div>
                                                    </td>
                                                    <td scope="row">{{ $item->product->product_name }}</td>
                                                    <td scope="row">{{ $item->product->product_code }}</td>
                                                    <td scope="row"><span
                                                            class="btn btn-warning">{{ $item->product->stock }}</span></td>
                                                    <td scope="row"><span
                                                            class="btn btn-success">{{ $item->quantity }}</span></td>
                                                    <td scope="row">{{ $item->unitcost }}</td>
                                                    <td scope="row">
                                                        <span class="btn btn-primary">{{ $item->total }}</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END: Products List -->
                        </div>
                    </div>
                </div>
                <!-- END: Table Product -->
            </div>
        </div>
        <!-- END: Main Page Content -->
    @endsection
</x-admin-layout>
