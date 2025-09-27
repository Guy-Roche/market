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
                    <h4 class="page-title">Pay Salary List</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{ date('F Y') }}</h4>
                        <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Image</th>
                                    <th>Employee Name</th>
                                    <th>Month</th>
                                    <th>Salary</th>
                                    <th>Advance </th>
                                    <th>Due Salary</th>
                                    <th>Action</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td>{{ $compteur++ }}</td>
                                        <td class="table-user"><img
                                                src="{{ $employee->image ? asset('backend/images/employees/' . $employee->image) : asset('backend/images/no_image.jpg') }}"
                                                alt="" class="me-2 rounded-circle"></td>
                                        <td>{{ $employee->name }}</td>
                                        <td>
                                            <h4><span class="badge bg-blue"> {{ date('F', strtotime('-1 month')) }}</span>
                                            </h4>
                                        </td>
                                        <td>{{  $employee->salary  }}</td>
                                        <td>@if ($employee->advance->advance_salary ?? false)
                                            {{$employee->advance->advance_salary}}
                                        @else
                                            <strong style="color: #fff">No Advanced</strong>
                                        @endif</td>
                                        {{-- <td>{{ $employee['advance']['advance_salary'] ?? '<span class="badge bg-blue">No Advance</span>' }}</td> --}}
                                        <td><strong style="color: #fff">{{ $employee->salary - ($employee->advance->advance_salary ?? 0) }}</strong></td>
                                        <td>
                                            <a href="{{ route('admin.pay_now_salary', [$employee->id]) }}"
                                                class="btn btn-blue rounded-pill waves-effect waves-light" title="Pay now">
                                                <i class="fas fa-money-bill-alt"></i></a>
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
