@extends('layouts_admin.master')
@section('title')
    paid Salary
@endsection
@section('content')

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{ route('admin.pay_salary') }}" class="btn btn-blue rounded-pill waves-effect waves-light"><i
                                class="fas fa-money-check-alt "></i>
                            Pay Salary List</a>
                    </div>
                    <h4 class="page-title">Paid Salary</h4>
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
                        <form method="post" action="{{ route('admin.save_paid_salary') }}" >
                            @csrf
                            <div class="row">
                                <input type="hidden" name="id" value="{{ $paidsalary->id }}">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="employee" class="form-label">Employee Name :</label>
                                             <strong style="color: #fff">{{ $paidsalary->name }}</strong>
                                    </div>
                                </div> <!-- end col -->

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="salary_month" class="form-label">Salary Month :</label>
                                             <strong style="color: #fff">{{ date('F', strtotime('-1 month')) }}</strong>
                                            <input type="hidden" name="salary_month" value="{{ date('F', strtotime('-1 month')) }}">

                                    </div>
                                </div> <!-- end col -->

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="paid_amount" class="form-label">Employee Salary : </label>
                                             <strong style="color: #fff">{{ $paidsalary->salary }}</strong>
                                             <input type="hidden" name="paid_amount" value="{{ $paidsalary->salary }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="firstname" class="form-label">Advance Salary :</label>
                                             <strong style="color: #fff">
                                                @if ( $paidsalary->advance->advance_salary > 0)
                                                    {{ $paidsalary->advance->advance_salary }}
                                                @else
                                                    No Advanced Salary
                                                @endif
                                            
                                            </strong>
                                            <input type="hidden" name="advance_salary" value="{{ $paidsalary->advance->advance_salary ? $paidsalary->advance->advance_salary : 0 }}">
                                    </div>
                                </div>
                                @php
                                    $dueSalary = $paidsalary->salary - $paidsalary->advance->advance_salary;
                                @endphp
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="firstname" class="form-label">Due Salary :</label>
                                             <strong style="color: #fff">
                                                @if ($dueSalary > 0)
                                                    {{ $dueSalary }}
                                                @else
                                                    No Salary
                                                @endif
                                            </strong>
                                            <input type="hidden" name="due_salary" value="{{ $dueSalary }}">
                                    </div>
                                </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i
                                        class="mdi mdi-content-save"></i> Paid Salary </button>
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
