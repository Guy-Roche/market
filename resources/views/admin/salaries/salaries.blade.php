@extends('layouts_admin.master')
@section('title')
    Advance Salaries List
@endsection
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{ route('admin.add_advance_salary') }}"
                            class="btn btn-blue rounded-pill waves-effect waves-light"><i class="fe-user-plus me-1"></i>
                            Add Advance Salary</a>
                    </div>
                    <h4 class="page-title">Advance Salaries List</h4>
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
                                    <th>Image</th>
                                    <th>Employee Name</th>
                                    <th>Month</th>
                                    <th>Year</th>
                                    <th> Salary</th>
                                    <th>Advance Salary</th>
                                    <th>Action</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($salaries as $salary)
                                    <tr>
                                        <td>{{ $compteur++ }}</td>
                                        <td class="table-user"><img
                                                src="{{ $salary->employee->image ? asset('backend/images/employees/' . $salary->employee->image) : asset('backend/images/no_image.jpg') }}"
                                                alt="" class="me-2 rounded-circle"></td>
                                        <td>{{ $salary->employee->name }}</td>
                                        <td>{{ $salary->month }}</td>
                                        <td>{{ $salary->year }}</td>
                                        <td>{{ $salary->employee->salary }}</td>
                                        <td>{{ $salary->advance_salary }}</td>

                                        <td>
                                            <a href="{{ route('admin.edit_advance_salary', [$salary->id]) }}"
                                                class="action-icon text-warning">
                                                <i class="mdi mdi-square-edit-outline"></i></a>
                                            <a href="{{ route('admin.delete_advance_salary', [$salary->id]) }}"
                                                class="action-icon text-danger delete-btn" id="delete">
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
@endsection
