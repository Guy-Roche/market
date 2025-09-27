@extends('layouts_admin.master')
@section('title')
    Order Details
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
                        <a href="{{ route('order.pending') }}"
                            class="btn btn-blue rounded-pill waves-effect waves-light "><i class=" fas fa-fast-backward"></i>
                             Back</a>
                    </div>
                    <h4 class="page-title">Order Details</h4>
                </div>

            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-8 col-xl-12">
                <div class="card">
                    <div class="card-body">

                        <div class="tab-pane" id="settings">
                            <form method="post" action="{{ route('order.status.update', $order->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label"></label>
                                            <img id="showImage"
                                                src="{{ asset('backend/images/customers/' . $order->customers->image) }}"
                                                class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Customer Name</label>
                                            <p class="text-danger"> {{ $order->customers->name }} </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Customer Email</label>
                                            <p class="text-danger"> {{ $order->customers->email }} </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Customer Phone</label>
                                            <p class="text-danger"> {{ $order->customers->phone }} </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Order Date </label>
                                            <p class="text-danger"> {{ $order->order_date }} </p>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Order Invoice </label>
                                            <p class="text-danger"> {{ $order->invoice_no }} </p>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Payment Status </label>
                                            <p class="text-danger"> {{ $order->payment_status }} </p>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Paid Amount </label>
                                            <p class="text-danger"> {{ $order->pay }} </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Due Amount </label>
                                            <p class="text-danger"> {{ $order->due }} </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i
                                            class="mdi mdi-content-save"></i> Complete Order</button>
                                </div>
                            </form>
                        </div>
                        <!-- end settings content-->

           <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table  class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Product Code</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total(+vat)</th> 
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($orderDetails as $orderdetail)
                                    <tr>
                                        <td>{{ $compteur++ }}</td>
                                        <td class="table-user"><img
                                                src="{{ $orderdetail->products->product_image ? asset('backend/images/products/' . $orderdetail->products->product_image) : asset('backend/images/no_image.jpg') }}"
                                                alt="" class="me-2 rounded-circle"></td>
                                        <td>{{ $orderdetail->products->product_name }}</td>
                                        <td>{{ $orderdetail->products->product_code }}</td>
                                        <td>{{ $orderdetail->quantity }}</td>
                                        <td>{{ $orderdetail->products->selling_price }}</td>
                                        <td>{{ $orderdetail->total }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->                        
                    </div>
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row-->

    </div> <!-- container -->
@endsection
