@extends('layouts_admin.master')
@section('title')
    Database Backup
@endsection
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">

                        <a href="{{ url('/admin/database/backup/now') }}"
                            class="btn btn-blue rounded-pill waves-effect waves-light"><i class="mdi mdi-database-plus"></i>
                            Backup Now</a>

                    </div>
                    <h4 class="page-title">Database Backup</h4>
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
                                    <th>File</th>
                                    <th>Size</th>
                                    <th>Path</th>

                                    <th>Action</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($files as $file)
                                    <tr>
                                        <td>{{ $compteur++ }}</td>
                                        <td>{{ $file->getFilename() }}</td>
                                        <td>{{ $file->getSize() }}</td>
                                        <td>{{ $file->getPath() }}</td>                                
                                        <td>                                            
                                            <a href="{{url('/admin/backup/download/'. $file->getFilename())}}"
                                                class="action-icon text-blue" title="Download Backup">
                                                <i class="fas fa-download"></i></a>                                           

                                            <a href="{{url('/admin/backup/delete/'. $file->getFilename())}}" class="action-icon text-danger delete-btn"
                                                 id="delete" title="Delete Backup">
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
    {{-- <form id="deleteForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form> --}}
@endsection
