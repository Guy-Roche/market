@extends('layouts_admin.master')
@section('title')
    Add Employee
@endsection

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{ route('admin.employees') }}" class="btn btn-blue rounded-pill waves-effect waves-light"><i
                                class="fe-users me-1"></i>
                            Employees List</a>
                    </div>
                                    <h4 class="page-title">Add Employee</h4>
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
                        <form method="post" action="{{ route('admin.saveemployee') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                            placeholder="Enter your name" name="name" value=""
                                            >
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="lastname" class="form-label">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                            placeholder="Enter employee email" name="email" value="">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div> <!-- end col -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                                            placeholder="Enter employee phone number" name="phone" value="">
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div> <!-- end col -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Adresse</label>
                                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                                            placeholder="Enter employee address" name="address" value="">
                                    </div>
                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div> <!-- end col -->

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="experience" class="form-label">Experience</label>
                                        <select class="form-select @error('experience') is-invalid @enderror" name="experience" id="example-select">
                                            <option value="">Select Experience</option>
                                            <option value="1 year">1 Year</option>
                                            <option value="2 years">2 Years</option>
                                            <option value="3 years">3 Years</option>
                                            <option value="4 years">4 Years</option>
                                            <option value="5 years">5 Years</option>
                                        </select>
                                        @error('experience')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div> <!-- end col -->
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="salary" class="form-label">Salary</label>
                                        <input type="text" class="form-control @error('salary') is-invalid @enderror" id="salary"
                                            placeholder="Enter employee salary" name="salary" value="">
                                        @error('salary')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div> <!-- end col -->

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="vacation" class="form-label">Vacation</label>
                                        <input type="text" class="form-control @error('vacation') is-invalid @enderror" id="vacation"
                                            placeholder="Enter employee vacation" name="vacation" value="">
                                        @error('vacation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div> <!-- end col -->

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="city" class="form-label">City</label>
                                        <input type="text" class="form-control @error('city') is-invalid @enderror" id="city"
                                            placeholder="Enter employee city" name="city" value="">
                                    </div>
                                    @error('city')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div> <!-- end col -->


                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Employee Image</label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                                    </div>
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div> <!-- end col -->

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="photo" class="form-label"></label>
                                        <img id="showImage" src="{{ asset('backend/images/no_image.jpg') }}"
                                            class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->



                            <div class="text-end">
                                <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i
                                        class="mdi mdi-content-save"></i> Save Employee</button>
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
