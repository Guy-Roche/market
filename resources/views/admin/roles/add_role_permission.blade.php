@extends('layouts_admin.master')
@section('title')
    Add Role Permission
@endsection
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <style>
        .form-check-label {
            text-transform: capitalize;
        }
    </style>
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{ route('rolespermissions') }}"
                            class="btn btn-blue rounded-pill waves-effect waves-light"><i class="fas fa-users-cog"></i>
                            Roles In Permissions </a>
                    </div>
                    <h4 class="page-title">Add Role In Permission</h4>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-8 col-xl-8">
            <div class="card">
                <div class="card-body">

                    <div class="tab-pane" id="settings">
                        <form method="post" action="{{ route('rolepermission.save') }}" id="myForm"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="role_id" class="form-label">Roles</label>
                                        <select name="role_id" class="form-select" id="role_id">
                                            <option selected disabled>Select Role</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> <!-- end row -->

                                <div class="form-check mb-2 form-check-blue">
                                    <input class="form-check-input" type="checkbox" value="" id="customckeck15">
                                    <label class="form-check-label" for="customckeck15">Select All</label>
                                </div>

                                <hr>
                                @foreach ($permission_groups as $group)
                                    <div class="row">
                                        <div class="col-3">

                                            <div class="form-check mb-2 form-check-blue">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="customckeck1">
                                                <label class="form-check-label"
                                                    for="customckeck1">{{ $group->group_name }}</label>
                                            </div>

                                        </div>
                                        <div class="col-9">
                                            @php
                                                $permissions = App\Models\User::getPermissionsByGroupName(
                                                    $group->group_name,
                                                );
                                            @endphp

                                            @foreach ($permissions as $permission)
                                                <div class="form-check mb-2 form-check-blue">
                                                    <input class="form-check-input" type="checkbox" name="permission[]"
                                                        value="{{ $permission->id }}" id="customckeck{{ $permission->id }}">
                                                    <label class="form-check-label"
                                                        for="customckeck{{ $permission->id }}">{{ $permission->name }}</label>
                                                </div>
                                            @endforeach
                                            <br>
                                        </div>

                                    </div> <!-- end row -->
                                @endforeach


                                <div class="text-end">
                                    <button type="submit" class="btn btn-blue waves-effect waves-light mt-2"><i
                                            class="mdi mdi-content-save"></i> Save </button>
                                </div>
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
        //Select All Permission when 
        $('#customckeck15').click(function() {
            if ($(this).is(':checked')) {
                $('input[type="checkbox"]').prop('checked', true);
            } else {
                $('input[type="checkbox"]').prop('checked', false);
            }
        });
    </script>
@endsection
