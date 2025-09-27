@extends('layouts_admin.master')
@section('title')
    Stock
@endsection
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right button-list">
                        <a href="{{ route('product.import') }}"
                            class="btn btn-success rounded-pill waves-effect waves-light"><i class=" fas fa-file-import"></i>
                            Import</a>
                        <a href="{{ route('product.export') }}"
                            class="btn btn-danger rounded-pill waves-effect waves-light"><i class="fas fa-file-export"></i>
                            Export</a>
                        <a href="{{ route('product.add') }}" class="btn btn-blue rounded-pill waves-effect waves-light"><i
                                class="fe-plus-circle me-1"></i>
                            Add Product</a>
                    </div>
                    <h4 class="page-title">Products List</h4>
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
                                    <th>Product Name</th>
                                    <th>Image</th>
                                    <th>Category</th>
                                    <th>Supplier</th>
                                    <th>Code</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Status</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $compteur++ }}</td>
                                        <td>{{ $product->product_name }}</td>
                                        <td class="table-user"><img
                                                src="{{ $product->product_image ? asset('backend/images/products/' . $product->product_image) : asset('backend/images/no_image.jpg') }}"
                                                alt="" class="me-2 rounded-circle"></td>
                                        <td>{{ $product->categories->category_name }}</td>
                                        <td>{{ $product->suppliers->name }}</td>
                                        <td>{{ $product->product_code }}</td>
                                        <td>{{ $product->selling_price }}</td>
                                        <td><button class="btn btn-{{ $product->product_store > 30 ? 'success' : ($product->product_store > 10 ? 'warning' : 'danger') }}">{{ $product->product_store }}</button> </td>
                                        <td>
                                            @if ($product->expire_date >  now())
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif

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
