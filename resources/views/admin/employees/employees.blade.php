@extends('layouts_admin.master')
@section('title')
    Employees List
@endsection
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        @if (Auth::user()->can('employee.add'))
                        <a href="{{ route('admin.addemployee') }}"
                            class="btn btn-blue rounded-pill waves-effect waves-light"><i class="fe-user-plus me-1"></i>
                            Add Employee</a>
                        @endif
                    </div>
                    <h4 class="page-title">Employees List</h4>
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
                                    <th>Salary</th>
                                    <th>Action</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td>{{ $compteur++ }}</td>
                                        <td>{{ $employee->name }}</td>
                                        <td class="table-user"><img
                                                src="{{ $employee->image ? asset('backend/images/employees/' . $employee->image) : asset('backend/images/no_image.jpg') }}"
                                                alt="" class="me-2 rounded-circle"></td>
                                        <td>{{ $employee->email }}</td>
                                        <td>{{ $employee->phone }}</td>
                                        <td>${{ $employee->salary }}</td>
                                        <td>
                                            @if (Auth::user()->can('employee.edit')) 
                                            <a href="{{ route('admin.editemployee', [$employee->id]) }}"
                                                class="action-icon text-blue">
                                                <i class="mdi mdi-square-edit-outline"></i></a>
                                            @endif
                                            @if (Auth::user()->can('employee.delete')) 
                                            <a href="{{ route('admin.deleteemployee', [$employee->id]) }}" class="action-icon text-danger delete-btn"
                                                 id="delete">
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
    {{-- <form id="deleteForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form> --}}
@endsection
