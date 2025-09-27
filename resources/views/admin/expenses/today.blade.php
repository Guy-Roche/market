@extends('layouts_admin.master')
@section('title')
    Today Expenses
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
                    <h4 class="page-title">Today Expenses {{ date('d-m-Y') }}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Today's Total Expenses: $ <strong class="text-danger">{{ $total }}</strong></h4>
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
                                    <th>Action</th>
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
                                        <td>
                                            <a href="{{ route('expense.edit', [$expense->id]) }}"
                                                class="action-icon text-blue">
                                                <i class="mdi mdi-square-edit-outline"></i></a>
                                            <a href="{{ route('expense.delete', [$expense->id]) }}" class="action-icon text-danger delete-btn"
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
