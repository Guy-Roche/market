@extends('layouts_admin.master')
@section('title')
    Add Category
@endsection

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{ route('categories') }}" class="btn btn-blue rounded-pill waves-effect waves-light"><i
                                class="fe-users me-1"></i>
                            Categories List</a>
                    </div>
                                    <h4 class="page-title">Add Category</h4>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-6 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="tab-pane" id="settings">
                        <form method="post" action="{{ route('category.save') }}" >
                            @csrf
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label for="category_name" class="form-label">Category Name</label>
                                        <input type="text" class="form-control @error('category_name') is-invalid @enderror" id="category_name"
                                            placeholder="Enter category name" name="category_name" value=""
                                            >
                                        @error('category_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

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
@endsection
