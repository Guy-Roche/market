@extends('layouts_admin.master')
@section('title')
    Suppliers List
@endsection
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{ route('admin.addsupplier') }}"
                            class="btn btn-blue rounded-pill waves-effect waves-light"><i class="fe-user-plus me-1"></i>
                            Add Supplier</a>
                    </div>
                    <h4 class="page-title">Suppliers List</h4>
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
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>ShopName</th>
                                    <th>Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($suppliers as $supplier)
                                    <tr>
                                        <td>{{ $compteur++ }}</td>
                                        <td>{{ $supplier->name }}</td>
                                        <td class="table-user"><img
                                                src="{{ $supplier->image ? asset('backend/images/suppliers/' . $supplier->image) : asset('backend/images/no_image.jpg') }}"
                                                alt="" class="me-2 rounded-circle"></td>
                                        <td>{{ $supplier->email }}</td>
                                        <td>{{ $supplier->phone }}</td>
                                        <td>{{ $supplier->shopname }}</td>
                                        <td>{{ $supplier->type }}</td>
                                        <td>

                                                <a href="{{ route('admin.detailsupplier', [$supplier->id]) }}"
                                                    class="action-icon text-info">
                                                    <i class="mdi mdi-account-details"></i></a>

                                            @if (Auth::user()->can('supplier.edit'))
                                                <a href="{{ route('admin.editsupplier', [$supplier->id]) }}"
                                                    class="action-icon text-warning">
                                                    <i class="mdi mdi-square-edit-outline"></i></a>
                                            @endif
                                            @if (Auth::user()->can('supplier.delete'))
                                                <a href="{{ route('admin.deletesupplier', [$supplier->id]) }}"
                                                    class="action-icon text-danger delete-btn" id="delete">
                                                <i class="mdi mdi-delete"></i></a>
                                            @endif

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
@endsection
