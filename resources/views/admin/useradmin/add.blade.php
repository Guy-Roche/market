@extends('layouts_admin.master')
@section('title')
    Add Admin User
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
                        <a href="{{ route('adminusers') }}" class="btn btn-blue rounded-pill waves-effect waves-light"><i
                                class="fe-users me-1"></i>
                            Admin User List</a>
                    </div>
                    <h4 class="page-title">Add Admin User</h4>
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
                        <form method="post" id="myForm" action="{{ route('adminuser.save') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="name" class="form-label"> Name</label>
                                        <input type="text" class="form-control " id="name" placeholder="Enter name"
                                            name="name" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="email" class="form-label"> Email</label>
                                        <input type="email" class="form-control " placeholder="Enter email" name="email"
                                            value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="phone" class="form-label"> Phone</label>
                                        <input type="text" class="form-control " id="phone" placeholder="Enter phone"
                                            name="phone" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="password" class="form-label"> Password</label>
                                        <input type="password" class="form-control " placeholder="Enter password"
                                            name="password" value="">
                                    </div>
                                </div>


                                </div> <!-- end col -->
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="roles" class="form-label">Assign Roles</label>
                                        <select class="form-control" id="roles" name="roles">
                                            <option value="" selected disabled>Select Roles</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->



                            <div class="text-end">
                                <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i
                                        class="mdi mdi-content-save"></i> Save </button>
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
            $('#photo').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>

    {{-- Validate form inputs --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    email: {
                        required: true,
                    },
                    phone: {
                        required: true,
                    },
                    password: {
                        required: true,
                    },
     
                    roles: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: 'Veuillez entrer le nom de l\'utilisateur',
                    },
                    phone: {
                        required: 'Veuillez entrer le numéro de téléphone',
                    },
                    email: {
                        required: 'Veuillez entrer l\'adresse e-mail',
                    },
                    password: {
                        required: 'Veuillez entrer le mot de passe',
                    },

                    roles: {
                        required: 'Veuillez sélectionner un rôle',
                    },


                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>
@endsection
