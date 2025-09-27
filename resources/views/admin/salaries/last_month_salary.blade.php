@extends('layouts_admin.master')
@section('title')
    Last Month Salary
@endsection
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{ route('admin.pay_salary') }}"
                            class="btn btn-blue rounded-pill waves-effect waves-light"><i class="fe-user-plus me-1"></i>
                            Pay Salary</a>
                    </div>
                    <h4 class="page-title">Last Month Salary </h4>
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
                                    <th>Name</th>
                                    <th>Month</th>
                                    <th>Salary</th>
                                    <th>Status </th>
                                    <th>Action</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($paidsalaries as $paidsalary)
                                    <tr>
                                        <td>{{ $compteur++ }}</td>
                                        <td class="table-user"><img
                                                src="{{ $paidsalary->employee->image ? asset('backend/images/employees/' . $paidsalary->employee->image) : asset('backend/images/no_image.jpg') }}"
                                                alt="" class="me-2 rounded-circle"></td>
                                        <td>{{ $paidsalary->employee->name }}</td>
                                        <td>{{ $paidsalary->salary_month }}</td>
                                        <td>{{  $paidsalary->employee->salary }}</td>
                                        <td><span class="badge bg-success">Full Paid</span></td>
                                        <td>
                                            <a href="{{ route('admin.historypaid', [$paidsalary->id]) }}"
                                                class="btn btn-blue rounded-pill waves-effect waves-light" title="Pay now">
                                                <i class="fas fa-history"></i></a>
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
