@extends('layouts_admin.master')
@section('title')
    Edit Permission
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
                        <a href="{{ route('permissions') }}" class="btn btn-blue rounded-pill waves-effect waves-light"><i
                                class="fas fa-users-cog"></i>
                            Permissions List</a>
                    </div>
                    <h4 class="page-title">Edit Permission</h4>
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
                        <form method="post" action="{{ route('permission.update', $permission->id) }}" id="myForm">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name"
                                            placeholder="Enter permission name" name="name" value="{{ $permission->name }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="group_name" class="form-label">Group Name</label>
                                        <select name="group_name" class="form-select" id="group_name">
                                            <option selected disabled>Select Group Name</option>
                                            <option value="pos" {{ $permission->group_name == 'pos' ? 'selected' : '' }}>POS</option>
                                            <option value="employee" {{ $permission->group_name == 'employee' ? 'selected' : '' }}>Employee</option>
                                            <option value="customer" {{ $permission->group_name == 'customer' ? 'selected' : '' }}>Customer</option>
                                            <option value="supplier" {{ $permission->group_name == 'supplier' ? 'selected' : '' }}>Supplier</option>
                                            <option value="salary" {{ $permission->group_name == 'salary' ? 'selected' : '' }}>Salary</option>
                                            <option value="attendence" {{ $permission->group_name == 'attendence' ? 'selected' : '' }}>Attendence</option>
                                            <option value="category" {{ $permission->group_name == 'category' ? 'selected' : '' }}>Category</option>
                                            <option value="product" {{ $permission->group_name == 'product' ? 'selected' : '' }}>Product</option>
                                            <option value="expense" {{ $permission->group_name == 'expense' ? 'selected' : '' }}>Expense</option>
                                            <option value="orders" {{ $permission->group_name == 'orders' ? 'selected' : '' }}>Orders</option>
                                            <option value="stock" {{ $permission->group_name == 'stock' ? 'selected' : '' }}>Stock</option>
                                            <option value="roles" {{ $permission->group_name == 'roles' ? 'selected' : '' }}>Roles</option>
                                            <option value="permissions" {{ $permission->group_name == 'permissions' ? 'selected' : '' }}>Permissions</option>
                                        </select>
                                    </div>
                                </div> <!-- end row -->
                                <div class="text-end">
                                    <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i
                                            class="mdi mdi-content-save"></i> Update Permission</button>
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
    {{-- Validate form inputs --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    group_name: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: 'Veuillez renseigner le nom de la permission',
                    },
                    group_name: {
                        required: 'Veuillez selectionner le group name de la permission',
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
