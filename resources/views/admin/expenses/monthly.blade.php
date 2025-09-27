@extends('layouts_admin.master')
@section('title')
    Monthly Expenses
@endsection
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{ route('expense.add') }}"
                            class="btn btn-blue rounded-pill waves-effect waves-light"><i class="fas fa-folder-plus"></i>
                            Add Expenses</a>
                    </div>
                    <h4 class="page-title">Monthly Expenses <strong class="text-blue">{{ date('F') }}</strong></h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Monthly Total Expenses: $ <strong class="text-danger">{{ $total }}</strong></h4>
                    </div>
                    <div class="card-body">
                        <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Details</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Month</th>
                                    <th>Year</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($expenses as $expense)
                                    <tr>
                                        <td>{{ $compteur++ }}</td>
                                        <td>{{ $expense->details }}</td>
                                        <td>{{ $expense->amount }}</td>
                                        <td>{{ $expense->date }}</td>
                                        <td>{{ $expense->month }}</td>
                                        <td>{{ $expense->year }}</td>

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
