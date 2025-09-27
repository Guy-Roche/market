@extends('layouts_admin.master')
@section('title')
    Edit Advance Salary
@endsection
@section('content')

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{ route('admin.advance_salaries') }}" class="btn btn-blue rounded-pill waves-effect waves-light"><i
                                class="fe-users me-1"></i>
                            Advance Salaries List</a>
                    </div>
                    <h4 class="page-title">Edit Advance Salary</h4>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-8 col-xl-12">
            <div class="card">
                <div class="card-body">

                    <div class="tab-pane" id="settings">
                        <form method="post" action="{{ route('admin.update_advance_salary', $advance_salary->id) }}" >
                            @csrf
                            @method('PUT')
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="employee" class="form-label">Employee Name</label>
                                        <select class="form-select @error('employee') is-invalid @enderror" name="employee" id="example-select">
                                            <option value="">Select Employee</option>
                                            {{-- <option value="{{ $advance_salary->employee_id }}">{{ $advance_salary->employee->name }}</option> --}}
                                            @foreach ($employees as $employee)
                                                <option value="{{ $employee->id }}" {{ $employee->id == $advance_salary->employee_id ? 'selected' : '' }}>{{ $employee->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('employee')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div> <!-- end col -->

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="month" class="form-label">Salary Month</label>
                                        <select class="form-select @error('month') is-invalid @enderror" name="month" id="example-select">
                                            <option value="">Select  Month</option>
                                            <option value="January" {{ $advance_salary->month == 'January' ? 'selected' : '' }}>January</option>
                                            <option value="February" {{ $advance_salary->month == 'February' ? 'selected' : '' }}>February</option>
                                            <option value="March" {{ $advance_salary->month == 'March' ? 'selected' : '' }}>March</option>
                                            <option value="April" {{ $advance_salary->month == 'April' ? 'selected' : '' }}>April</option>
                                            <option value="May" {{ $advance_salary->month == 'May' ? 'selected' : '' }}>May</option>
                                            <option value="June" {{ $advance_salary->month == 'June' ? 'selected' : '' }}>June</option>
                                            <option value="July" {{ $advance_salary->month == 'July' ? 'selected' : '' }}>July</option>
                                            <option value="August" {{ $advance_salary->month == 'August' ? 'selected' : '' }}>August</option>
                                            <option value="September" {{ $advance_salary->month == 'September' ? 'selected' : '' }}>September</option>
                                            <option value="October" {{ $advance_salary->month == 'October' ? 'selected' : '' }}>October</option>
                                            <option value="November" {{ $advance_salary->month == 'November' ? 'selected' : '' }}>November</option>
                                            <option value="December" {{ $advance_salary->month == 'December' ? 'selected' : '' }}>December</option>
                                        </select>
                                        @error('month')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div> <!-- end col -->

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="firstname" class="form-label">Year </label>
                                        <select class="form-select @error('year') is-invalid @enderror" name="year" id="example-select">
                                            <option value="">Select Year</option>
                                            @for ($i = 2015; $i <= date('Y'); $i++)
                                                <option value="{{ $i }}" {{ $advance_salary->year == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                        @error('year')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="firstname" class="form-label">Advance Salary</label>
                                        <input type="text" name="advance_salary"
                                            class="form-control @error('advance_salary') is-invalid @enderror" value="{{ $advance_salary->advance_salary }}">
                                        @error('advance_salary')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i
                                        class="mdi mdi-content-save"></i> Update </button>
                            </div>
                        </form>
                    </div>
                    <!-- end settings content-->

                </div>
            </div> <!-- end card-->

        </div> <!-- end col -->
    </div>
    <!-- end row-->

    </div> <!-- container -->

    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
