@extends('layouts_admin.master')
@section('title')
    Attendances List
@endsection
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{ route('attendance.add') }}"
                            class="btn btn-blue rounded-pill waves-effect waves-light"><i class="fe-user-plus me-1"></i>
                            Add Employee Attendance</a>
                    </div>
                    <h4 class="page-title">Attendances List</h4>
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
                                    <th>Date</th>

                                    <th>Action</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($attendances as $attendance)
                                    <tr>
                                        <td>{{ $compteur++ }}</td>
                                        <td>{{ date('d-m-Y', strtotime($attendance->date)) }}</td>
                                        <td>
                                            <a href="{{ route('attendance.edit', [$attendance->date]) }}"
                                                class="action-icon text-blue" title="edit">
                                                <i class="mdi mdi-square-edit-outline"></i></a>
                                            <a href="{{ route('attendance.view', [$attendance->date]) }}" class="action-icon text-danger" title="view "
                                                 >
                                                <i class="mdi mdi-eye"></i></a>

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
