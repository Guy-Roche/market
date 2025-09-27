@extends('layouts_admin.master')
@section('title')
    Permissions List
@endsection
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{ route('permission.add') }}"
                            class="btn btn-success rounded-pill waves-effect waves-light "><i class="fas fa-user-shield"></i>
                            Add Permission</a>
                    </div>
                    <h4 class="page-title">Permissions List</h4>
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
                                    <th>Permission Name</th>
                                    <th>Group Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($permissions as $permission)
                                    <tr>
                                        <td>{{ $compteur++ }}</td>
                                        <td>{{ $permission->name }}</td>
                                        <td>{{ $permission->group_name }}</td>
                                        <td>
                                            <a href="{{ route('permission.edit', [$permission->id]) }}"
                                                class="action-icon text-blue" title="Edit Permission">
                                                <i class="mdi mdi-square-edit-outline"></i></a>
                                            <a href="{{ route('permission.delete', [$permission->id]) }}" class="action-icon text-danger delete-btn"
                                                 id="delete" title="Delete Permission">
                                                <i class="mdi mdi-delete"></i></a>
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

@endsection
