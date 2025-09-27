@extends('layouts_admin.master')
@section('title')
    POS System
@endsection

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">

                    </div>
                    <h4 class="page-title">POS System</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-6 col-xl-6">
                <div class="card text-center">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>QTY</th>
                                        <th>Price</th>
                                        <th>SubTotal</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                @php
                                    $cartitems = Cart::content();
                                    // dd($cartitems);
                                    $compteur = 1;
                                @endphp
                                <tbody>
                                    @foreach ($cartitems as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                <form action="{{ url('/admin/pos/updatecart', $item->rowId) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="number" name="qty" min="1" style="width: 40px;"
                                                        value="{{ $item->qty }}">
                                                    <button type="submit" class="btn btn-sm btn-success ml-1"
                                                        style="font-size: 10px" title="Validate QTY"><i
                                                            class=" fas fa-check"></i></button>
                                                </form>
                                            </td>
                                            <td>{{ $item->price }}</td>
                                            <td>{{ $item->price * $item->qty }}</td>
                                            <td>
                                                <a href="{{ url('/admin/pos/deletecart', $item->rowId) }}"
                                                    class="action-icon text-danger" title="Remove Product" id="delete">
                                                    <i class="fas fa-trash-alt" style="font-size: 20px;"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div class="bg-blue text-white text-end">
                            <p class="m-0 p-2"><strong class="">Quantity :</strong> {{ Cart::count() }}</p>
                            <p class="m-0 p-2"><strong class="">SubTotal :</strong> {{ Cart::subtotal() }}</p>
                            <p class="m-0 p-2"><strong class="">Vat :</strong> {{ Cart::tax() }}</p>
                            <h3 class="m-0 p-2 text-white"><strong class="text-danger">Total :</strong> {{ Cart::total() }}
                            </h3>
                        </div>

                        <form action="{{ url('/admin/pos/createinvoice') }}" method="post" class="mt-3" id="myForm">
                            @csrf
                            <div class="col-md-12">
                                <div class=" mb-2 d-flex justify-content-between align-items-center">
                                    <label for="customer_id" class="form-label mb-0">Customers</label>
                                    <a href="{{ route('admin.addcustomer') }}"
                                        class="btn btn-blue rounded-pill waves-effect waves-light">
                                        <i class="fe-user-plus me-1"></i> Add Customer
                                    </a>
                                </div>
                                <div class="form-group mb-3">
                                    <select class="form-control" id="customer_id" name="customer_id">
                                        <option value="" selected disabled>Select Customer</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <button type="submit" class="btn btn-danger rounded-pill waves-effect waves-light mt-3">
                                <i class="fe-credit-card me-1"></i> Create Invoice
                            </button>
                        </form>

                    </div>
                </div> <!-- end card -->

            </div> <!-- end col-->

            <div class="col-lg-6 col-xl-6">
                <div class="card">
                    <div class="card-body">

                        <div class="tab-pane" id="settings">
                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Product Name</th>
                                        <th>Image</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <form action="{{ url('/admin/pos/addcart') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <td>{{ $compteur++ }}</td>
                                                <td class="table-user"><img
                                                        src="{{ $product->product_image ? asset('backend/images/products/' . $product->product_image) : asset('backend/images/no_image.jpg') }}"
                                                        alt="" class="me-2 rounded-circle"></td>
                                                <td>{{ $product->product_name }}</td>
                                                <td>
                                                    <button type="submit" class="btn btn-blue" title="Add Product"><i
                                                            class="fas fa-plus-circle"
                                                            style="font-size: 18px;"></i></button>
                                                </td>
                                            </form>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- end settings content-->

                    </div>
                </div> <!-- end card-->

            </div> <!-- end col -->
        </div>
        <!-- end row-->

    </div> <!-- container -->
    {{-- Validate form inputs --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    customer_id: {
                        required: true,
                    },
                },
                messages: {
                    customer_id: {
                        required: 'Please select a customer',
                    },

                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>
@endsection
