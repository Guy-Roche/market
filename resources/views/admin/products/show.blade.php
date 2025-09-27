@extends('layouts_admin.master')
@section('title')
    Show Product
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
                        <a href="{{ route('products') }}" class="btn btn-blue rounded-pill waves-effect waves-light"><i
                                class="fe-users me-1"></i>
                            Products List</a>
                    </div>
                    <h4 class="page-title">Show Product</h4>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-8 col-xl-12">
            <div class="card">
                <div class="card-body">

                    <div class="tab-pane" id="settings">
                        <form method="post" id="myForm" action="" enctype="multipart/form-data">

                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="selling_price" class="form-label">Product Code</label>
                                        <p class="text-danger">{{ $product->product_code }}</p>
                                    </div>
                                </div> <!-- end col -->

                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="product_image" class="form-label">Product QRCode</label>
                                        <p class="text-danger">{!! $qrcode !!}</p>
                                    </div>

                                </div> <!-- end col -->
                                @php
                                    $barcode = new Picqer\Barcode\BarcodeGeneratorHTML();
                                @endphp

                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="product_image" class="form-label">Product BarCode</label>
                                        <p class="text-danger">{!! $barcode->getBarcode($product->product_code,$barcode::TYPE_CODE_128) !!}</p>
                                    </div>

                                </div> <!-- end col -->

                            </div> <!-- end row -->

                        </form>
                    </div>
                    <!-- end settings content-->

                </div>
            </div> <!-- end card-->

        </div> <!-- end col -->
    </div>
    <!-- end row-->

    </div> <!-- container -->

@endsection
