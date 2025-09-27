@extends('layouts_admin.master')
@section('title')
    Invoice
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
                    <h4 class="page-title">Customer Invoice</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Logo & title -->
                        <div class="clearfix">
                            <div class="float-start">
                                <div class="auth-logo">
                                    <div class="logo logo-dark">
                                        <span class="logo-lg">
                                            <img src="{{ asset('backend/images/logo-dark.png') }}" alt=""
                                                height="22">
                                        </span>
                                    </div>

                                    <div class="logo logo-light">
                                        <span class="logo-lg">
                                            <img src="{{ asset('backend/images/logo-light.png') }}" alt=""
                                                height="22">
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="float-end">
                                <h4 class="m-0 d-print-none">Invoice</h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mt-3">
                                    <p><b>Hello, {{ $customer->name }}</b></p>
                                    <p class="text-muted">Thanks a lot because you keep purchasing our products. Our company
                                        promises to provide high quality products for you as well as outstanding
                                        customer service for every transaction. </p>
                                </div>

                            </div><!-- end col -->
                            <div class="col-md-4 offset-md-2">
                                <div class="mt-3 float-end">
                                    <p><strong>Order Date : </strong> <span class="float-end"> &nbsp;&nbsp;&nbsp;&nbsp; Jan
                                            17, 2016</span></p>
                                    <p><strong>Order Status : </strong> <span class="float-end"><span
                                                class="badge bg-danger">Unpaid</span></span></p>
                                    <p><strong>Invoice No. : </strong> <span class="float-end">000028 </span></p>
                                </div>
                            </div><!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="row mt-3">
                            <div class="col-sm-6">
                                <h6>Billing Address</h6>
                                <address>
                                    {{ $customer->address }} - {{ $customer->city }}<br>
                                    <abbr title="ShopeName">ShopeName:</abbr> {{ $customer->shopname }} <br>
                                    <abbr title="Email">Email:</abbr> {{ $customer->email }} <br>
                                    <abbr title="Phone">Phone:</abbr> {{ $customer->phone }}
                                </address>
                            </div> <!-- end col -->

                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table mt-4 table-centered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Item</th>
                                                <th style="width: 10%">Qty</th>
                                                <th style="width: 10%">Unit Cost</th>
                                                <th style="width: 10%" class="text-end">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($carts as $cart)
                                                <tr>
                                                    <td>{{ $compteur++ }}</td>
                                                    <td>
                                                        <b>{{ $cart->name }}</b> <br />
                                                    </td>
                                                    <td>{{ $cart->qty }}</td>
                                                    <td>${{ $cart->price }}</td>
                                                    <td class="text-end">${{ $cart->qty * $cart->price }}</td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div> <!-- end table-responsive -->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="clearfix pt-5">
                                    <h6 class="text-muted">Notes:</h6>

                                    <small class="text-muted">
                                    </small>
                                </div>
                            </div> <!-- end col -->
                            <div class="col-sm-6">
                                <div class="float-end">
                                    <p><b>Sub-total:</b> <span class="float-end">${{ Cart::subtotal() }}</span></p>
                                    <p><b>Vat (18%):</b> <span class="float-end"> &nbsp;&nbsp;&nbsp;${{ Cart::tax() }}
                                        </span></p>
                                    <h3>${{ Cart::total() }} USD</h3>
                                </div>
                                <div class="clearfix"></div>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="mt-4 mb-1">
                            <div class="text-end d-print-none">
                                <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light"><i
                                        class="mdi mdi-printer me-1"></i> Print</a>
                                <a href="#" class="btn btn-blue waves-effect waves-light" data-bs-toggle="modal"
                                    data-bs-target="#login-modal"><i class="fe-credit-card me-1"></i>Create Invoice</a>
                            </div>
                        </div>
                    </div>
                </div> <!-- end card -->
            </div> <!-- end col -->
        </div>
        <!-- end row -->
        <!-- SignIn modal content -->
        <div id="login-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <h4 class="modal-title text-center">Invoice of {{ $customer->name }}</h4><br>

                    <h3 class="modal-title text-center"><strong> Total Amount:</strong>
                        ${{ Cart::total() }}</h3><br>

                    <div class="modal-body">

                        <form action="{{ route('order.save') }}" method="POST" class="px-3" id="myForm">
                            @csrf
                            <input type="hidden" name="customer_id" value="{{ $customer->id }}">
                            <div class="form-group mb-3">
                                <label for="payment_status" class="form-label">Payment Method</label>
                                <select name="payment_status" class="form-select" id="example-select">
                                    <option selected disabled>Select Payment </option>
                                    <option value="HandCash">HandCash</option>
                                    <option value="Cheque">Cheque</option>
                                    <option value="Due">Due</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="pay" class="form-label">Pay Now</label>
                                <input type="text" class="form-control" id="pay"
                                    placeholder="Enter amount to pay" name="pay" value="">
                            </div>

                            <div class="mb-3">
                                <label for="username" class="form-label">Due Amount</label>
                                <input class="form-control" type="text" name="due" placeholder="Due Amount"
                                    id="due" readonly>
                            </div>

                            <div class="mb-2 text-center">
                                <button class="btn btn-blue waves-effect waves-light" type="submit"><i
                                        class="fas fa-money-bill-alt"></i> Complete Order</button>
                            </div>
                            <input type="hidden" name="order_date" value="{{ date('d-F-Y') }}">
                            <input type="hidden" name="order_status" value="Pending">
                            <input type="hidden" name="total_products" value="{{ Cart::count() }}">
                            <input type="hidden" name="sub_total" value="{{ Cart::subtotal() }}">
                            <input type="hidden" name="vat" value="{{ Cart::tax() }}">
                            <input type="hidden" id="total" name="total" value="{{ Cart::total() }}">


                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div> <!-- container -->

    {{-- Validate form inputs --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    payment_method: {
                        required: true,
                    },
                    pay: {
                        required: true,
                    },
                },
                messages: {
                    payment_method: {
                        required: 'Please select a payment method',
                    },
                    pay: {
                        required: 'Please enter the amount to pay',
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
    {{-- Calculate Due Amount --}}
    <script>
        function parseEnglishNumber(str) {
            // Supprime les virgules et convertit en float
            return parseFloat(str.replace(/,/g, '')) || 0;
        }

        function formatEnglishNumber(num) {
            return num.toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }

        const totalInput = document.getElementById('total');
        const payInput = document.getElementById('pay');
        const dueInput = document.getElementById('due');

        function updateDue() {
            const total = parseEnglishNumber(totalInput.value);
            const pay = parseEnglishNumber(payInput.value);
            const due = Math.max(0, total - pay);
            dueInput.value = formatEnglishNumber(due);
        }

        payInput.addEventListener('input', updateDue);
        totalInput.addEventListener('input', updateDue);
        updateDue(); // Initial call to set the due amount on page load
    </script>
@endsection
