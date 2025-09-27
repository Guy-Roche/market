@extends('layouts_admin.master')
@section('title')
    History of Paid Salary
@endsection
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{ route('admin.lastmonthsalary') }}"
                            class="btn btn-blue rounded-pill waves-effect waves-light"><i class="fas fa-money-check-alt "></i>
                            Last Month Salary</a>
                    </div>
                    <h4 class="page-title">History of Paid Salary</h4>
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
                        <form method="post" action="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="employee" class="form-label">Employee Name :</label>
                                        <strong style="color: #fff">{{ $paidsalary->employee->name }}</strong>
                                    </div>
                                </div> <!-- end col -->

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="salary_month" class="form-label">Salary Month :</label>
                                        <strong style="color: #fff">{{ $paidsalary->salary_month }}</strong>

                                    </div>
                                </div> <!-- end col -->

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="paid_amount" class="form-label">Employee Salary : </label>
                                        <strong style="color: #fff">{{ $paidsalary->paid_amount }}</strong>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="firstname" class="form-label">Advance Salary :</label>
                                        <strong style="color: #fff">{{ $paidsalary->advance_salary }}</strong>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="firstname" class="form-label">Due Salary :</label>
                                        <strong style="color: #fff">{{ $paidsalary->due_salary }}</strong>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="firstname" class="form-label">Status </label>
                                        <span class="badge bg-success">Full Paid</span>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="photo" class="form-label"></label>
                                        <img id="showImage"
                                            src="{{ $paidsalary->employee->image ? asset('backend/images/employees/' . $paidsalary->employee->image) : asset('backend/images/no_image.jpg') }}"
                                            class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
                                    </div>
                                </div> <!-- end col -->


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
