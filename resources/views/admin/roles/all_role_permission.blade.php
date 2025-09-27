@extends('layouts_admin.master')
@section('title')
    Roles List
@endsection
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{ route('rolepermission.add') }}"
                            class="btn btn-blue rounded-pill waves-effect waves-light "><i class="fas fa-user-shield"></i>
                            Add Role in Permission</a>
                    </div>
                    <h4 class="page-title">Roles List</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                            <table  class="table dt-responsive nowrap w-100">
                                <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Role Name</th>
                                    <th>Permission</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>{{ $compteur++ }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            @foreach ($role->permissions as $perm)
                                                <span class="badge rounded-pill bg-blue m-1" style="font-size: 12px;">{{ $perm->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{ route('rolepermission.edit', [$role->id]) }}"
                                                class="action-icon text-blue" title="Edit Role">
                                                <i class="mdi mdi-square-edit-outline"></i></a>
                                            <a href="{{ route('rolepermission.delete', [$role->id]) }}" class="action-icon text-danger delete-btn"
                                                 id="delete" title="Delete Role">
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
