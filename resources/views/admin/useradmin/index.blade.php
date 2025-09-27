@extends('layouts_admin.master')
@section('title')
    Customers List
@endsection
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{ route('adminuser.add') }}"
                            class="btn btn-blue rounded-pill waves-effect waves-light "><i class="fe-user-plus me-1"></i>
                            Add Admin</a>
                    </div>
                    <h4 class="page-title">Admins  <span class="badge bg-danger">{{ count($adminUsers) }}</span></h4>
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
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($adminUsers as $adminUser)
                                    <tr>
                                        <td>{{ $compteur++ }}</td>
                                        <td>{{ $adminUser->name }}</td>
                                        <td class="table-user"><img
                                                src="{{ $adminUser->photo ? asset('backend/images/users/' . $adminUser->photo) : asset('backend/images/no_image.jpg') }}"
                                                alt="" class="me-2 rounded-circle"></td>
                                        <td>{{ $adminUser->email }}</td>
                                        <td>{{ $adminUser->phone }}</td>
                                        <td>
                                            @foreach ($adminUser->roles as $role)
                                                <span class="badge bg-danger">{{ $role->name }}</span>
                                            @endforeach
                                        </td>

                                        <td>
                                            <a href="{{ route('adminuser.edit', [$adminUser->id]) }}"
                                                class="action-icon text-blue">
                                                <i class="mdi mdi-square-edit-outline"></i></a>
                                            <a href="{{ route('adminuser.delete', [$adminUser->id]) }}" class="action-icon text-danger delete-btn"
                                                 id="delete">
                                                <i class="mdi mdi-delete"></i></a>
                                            {{-- <button type="button" class="action-icon text-danger delete-btn"
                                                data-url="{{ url('admin/deleteemployee/' . $employee->id) }}" title="Supprimer"
                                                style="border: none; background: none;">
                                                <i class="mdi mdi-delete"></i>
                                            </button> --}}
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
