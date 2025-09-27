@extends('layouts_admin.master')
@section('title')
    Add Product
@endsection
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right button-list">
                        <a href="{{ route('product.export') }}"
                            class="btn btn-success rounded-pill waves-effect waves-light"><i class=" fas fa-file-excel"></i>
                            Download Xlsx</a>
                        <a href="{{ route('products') }}" class="btn btn-blue rounded-pill waves-effect waves-light"><i
                                class="fab fa-product-hunt"></i>
                            Products List</a>
                    </div>
                    <h4 class="page-title">Download Excel File Xlsx </h4>
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
                        <form method="post" id="myForm" action="{{ route('product.imported') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="import_file" class="form-label">Xlsx File Import</label>
                                        <input type="file"
                                            class="form-control @error('import_file') is-invalid @enderror" id="import_file"
                                            name="import_file">
                                        @error('import_file')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                </div> <!-- end col -->
                            </div> <!-- end row -->

                            <div class="text-end">
                                <button type="submit" class="btn btn-blue waves-effect waves-light mt-2"><i
                                        class="mdi mdi-content-save"></i> Upload </button>
                            </div>
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
