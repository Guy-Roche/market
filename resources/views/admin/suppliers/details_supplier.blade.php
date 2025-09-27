@extends('layouts_admin.master')
@section('title')
    Supplier Details
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
                        <a href="{{ route('admin.suppliers') }}" class="btn btn-blue rounded-pill waves-effect waves-light"><i
                                class="fe-users me-1"></i>
                            Suppliers List</a>
                    </div>
                    <h4 class="page-title">Supplier Details</h4>
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
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <p class="text-danger">{{ $supplier->name }}</p>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="lastname" class="form-label">Email</label>
                                        <p class="text-danger">{{ $supplier->email }}</p>
                                    </div>
                                </div>

                                <!-- end col -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <p class="text-danger">{{ $supplier->phone }}</p>
                                    </div>
                                </div> <!-- end col -->

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Adresse</label>
                                        <p class="text-danger">{{ $supplier->address }}</p>
                                    </div> <!-- end col -->
                                </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Customer Shop Name </label>
                                            <p class="text-danger">{{ $supplier->shopname }}</p>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="type" class="form-label">Supplier Type</label>
                                            <p class="text-danger">{{ $supplier->type }}</p>
                                        </div>
                                    </div> <!-- end col -->

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Account Holder </label>
                                            <p class="text-danger">{{ $supplier->account_holder }}</p>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="account_number" class="form-label">Account Number </label>
                                            <p class="text-danger">{{ $supplier->account_number }}</p>
                                        </div>
                                    </div> <!-- end col -->

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="bank_name" class="form-label">Bank Name</label>
                                            <p class="text-danger">{{ $supplier->bank_name }}</p>
                                        </div>
                                    </div> <!-- end col -->

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Bank Branch </label>
                                            <p class="text-danger">{{ $supplier->bank_branch }}</p>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="city" class="form-label">City</label>
                                            <p class="text-danger">{{ $supplier->city }}</p>
                                        </div> <!-- end col -->
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="photo" class="form-label"></label>
                                            <img id="showImage"
                                                src="{{ $supplier->image ? asset('backend/images/suppliers/' . $supplier->image) : asset('backend/images/no_image.jpg') }}"
                                                class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->
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
