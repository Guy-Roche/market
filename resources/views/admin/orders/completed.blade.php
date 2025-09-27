@extends('layouts_admin.master')
@section('title')
    Completed Orders
@endsection
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">   
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{ route('order.pending') }}"
                            class="btn btn-blue rounded-pill waves-effect waves-light "><i class="fas fa-hourglass-half"></i>
                             Order Pending</a>
                    </div>
                    <h4 class="page-title">Completed Orders</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Order Date</th>
                                    <th>Payment Method</th>
                                    <th>Invoice</th>
                                    <th>Pay</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $compteur++ }}</td>
                                        <td>{{ $order->customers->name }}</td>
                                        <td class="table-user"><img
                                                src="{{ $order->customers->image ? asset('backend/images/customers/' . $order->customers->image) : asset('backend/images/no_image.jpg') }}"
                                                alt="" class="me-2 rounded-circle"></td>
                                        <td>{{ $order->order_date }}</td>
                                        <td>{{ $order->payment_status }}</td>
                                        <td>{{ $order->invoice_no}}</td>
                                        <td>{{ $order->pay }}</td>

                                        <td><span class="badge bg-success">{{ $order->order_status }}</span></td>
                                        <td>
                                            <a href="{{ url('/admin/order/invoice/download', [$order->id]) }}"
                                                class="action-icon text-danger" title="PDF Invoice">
                                                <i class="fas fa-file-pdf" style="font-size: 24px;"></i></a>

                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->


    </div> <!-- container -->
    {{-- <form id="deleteForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form> --}}
@endsection
