@extends('layouts_admin.master')
@section('title')
    View Attendance
@endsection
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{ route('attendances') }}"
                            class="btn btn-blue rounded-pill waves-effect waves-light"><i class="fe-user-plus me-1"></i>
                            Attendances List</a>
                    </div>
                    <h4 class="page-title">View Employee Attendance</h4>
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
                                    <th>Photo</th>
                                    <th>Employee Name</th>
                                    <th>Attendance Status</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($attendances as $attendance)
                                    <tr>
                                        <td>{{ $compteur++ }}</td>
                                        <td>{{ date('d-m-Y', strtotime($attendance->date)) }}</td>
                                        <td> <img src="{{ $attendance->employee->image ? url('backend/images/employees/' . $attendance->employee->image) : url('upload/no_image.jpg') }}"
                                                alt="user" class="rounded-circle" width="40px" height="40px"></td>
                                        <td>{{ $attendance->employee->name }}</td>
                                        <td>
                                            @if ($attendance->attend_status == 'Present')
                                                <span class="badge bg-success">{{ $attendance->attend_status }}</span>
                                            @elseif ($attendance->attend_status == 'Leave')
                                                <span class="badge bg-blue">{{ $attendance->attend_status }}</span>
                                            @else
                                                <span class="badge bg-danger">{{ $attendance->attend_status }}</span>
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
