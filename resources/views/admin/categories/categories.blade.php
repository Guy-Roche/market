@extends('layouts_admin.master')
@section('title')
    Categories List
@endsection
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        {{-- <a href="{{ route('category.add') }}"
                            class="btn btn-blue rounded-pill waves-effect waves-light"><i class="fe-user-plus me-1"></i>
                            Add Category</a> --}}
                        <button type="button" class="btn btn-blue rounded-pill waves-effect waves-light"
                            data-bs-toggle="modal" data-bs-target="#login-modal">Add Category</button>
                    </div>
                    <h4 class="page-title">Categories List</h4>
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
                                    <th>Category</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $compteur++ }}</td>
                                        <td>{{ $category->category_name }}</td>
                                        <td>
                                            <a href="{{ route('category.edit', [$category->id]) }}"
                                                class="action-icon text-blue">
                                                <i class="mdi mdi-square-edit-outline"></i></a>
                                            <a href="{{ route('category.delete', [$category->id]) }}"
                                                class="action-icon text-danger delete-btn" id="delete">
                                                <i class="mdi mdi-delete"></i></a>
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
        <!-- SignIn modal content -->
        <div id="login-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="text-center mt-2 mb-4">
                            <div class="auth-logo">
                                <h3><strong>Add Category</strong></h3>
                            </div>
                        </div>

                        <form action="{{ route('category.save') }}" method="POST" class="px-3">
                            @csrf
                            <div class="mb-3">
                                <label for="category_name" class="form-label">Category Name</label>
                                <input type="text" class="form-control @error('category_name') is-invalid @enderror"
                                    id="category_name" placeholder="Enter category name" name="category_name"
                                    value="">
                                @error('category_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-2 text-center">
                                <button class="btn rounded-pill btn-blue" type="submit">Save</button>
                            </div>

                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    </div> <!-- container -->
    {{-- <form id="deleteForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form> --}}
@endsection
