@extends('layouts_admin.master')
@section('title')
    Pending Orders
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
                        <a href="{{ route('pos') }}"
                            class="btn btn-blue rounded-pill waves-effect waves-light "><i class="fe-user-plus me-1"></i>
                             POS</a>
                    </div>
                    <h4 class="page-title">Pending Orders</h4>
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
                                    <th>Total</th>
                                    <th>Pay</th>
                                    <th>Due</th>
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
                                        <td><strong class="btn btn-blue">{{ $order->total }}</strong></td>
                                        <td><strong class="btn btn-warning">{{ $order->pay }}</strong></td>
                                        <td><strong class="btn btn-danger">{{ $order->due }}</strong></td>
                                        <td>
                                            <a href="{{ route('order.details', [$order->id]) }}"
                                                class="action-icon text-blue" title="View Details">
                                                <i class="fas fa-eye" style="font-size: 24px;"></i></a>
                                            <a href=""
                                                class="action-icon text-danger" title="Pay Due" data-bs-toggle="modal" data-bs-target="#login-modal" id="{{ $order->id }}" onclick="orderDue(this.id)">
                                                <i class="fas fa-money-bill-alt" style="font-size: 24px;"></i></a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
                        <!-- SignIn modal content -->
        <div id="login-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <h4 class="modal-title text-center"><strong> Payment Due</strong></h4>

                    <div class="modal-body">

                        <form action="{{ route('order.due.pay') }}" method="POST" class="px-3" id="myForm">
                            @csrf
                            <input type="hidden" name="order_id" id="order_id">
                            <div class="mb-3">
                                <label for="username" class="form-label">Old Due</label>
                                <input class="form-control" type="text" name="old_due" id="old_due" readonly>
                            </div>

                            <div class="form-group mb-3">
                                <label for="username" class="form-label">Pay Now</label>
                                <input class="form-control" type="number" name="pay" placeholder="Pay Now"
                                    id="pay" >
                            </div>

                            <div class="mb-3">
                                <label for="username" class="form-label">Due Amount</label>
                                <input class="form-control" type="text" name="due" id="due" readonly>
                            </div>

                            <div class="mb-2 text-center">
                                <button class="btn btn-danger waves-effect waves-danger" type="submit"><i
                                        class="fas fa-money-bill-alt"></i> Pay Due</button>
                            </div>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
            </div><!-- end col-->
        </div>
        <!-- end row-->
    </div> <!-- container -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    pay: {
                        required: true,
                    },
 
                },
                messages: {

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


<script type="text/javascript">
        function parseEnglishNumber(str) {
            // Supprime les virgules et convertit en float
            return parseFloat(str.replace(/,/g, '')) || 0;
        }
        
        function orderDue(id) {
            $.ajax({
                type: 'GET',
                url: '/admin/order/due/' + id,
                dataType: 'json',
                success:function(data){
                    // console.log(data)
                    $('#due').val(parseEnglishNumber(data.due));
                    $('#old_due').val(parseEnglishNumber(data.due));
                    $('#order_id').val(data.id);
                }
            })
        }
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

        const totalInput = document.getElementById('old_due');
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
