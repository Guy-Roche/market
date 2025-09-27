@extends('layouts_admin.master')
@section('title')
    Add Product
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
                        <a href="{{ route('products') }}" class="btn btn-blue rounded-pill waves-effect waves-light"><i
                                class="fe-users me-1"></i>
                            Products List</a>
                    </div>
                    <h4 class="page-title">Add Product</h4>
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
                        <form method="post" id="myForm" action="{{ route('product.save') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="product_name" class="form-label">Product Name</label>
                                        <input type="text" class="form-control " id="name"
                                            placeholder="Enter product name" name="product_name" value="">
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="category_id" class="form-label">Category</label>
                                        <select class="form-control" id="category_id" name="category_id">
                                            <option value="" selected disabled>Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> <!-- end col -->

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="supplier_id" class="form-label">Supplier</label>
                                        <select class="form-control" id="supplier_id" name="supplier_id">
                                            <option value="" selected disabled>Select Supplier</option>
                                            @foreach ($suppliers as $supplier)
                                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> <!-- end col -->

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="product_code" class="form-label">Product Code</label>
                                        <input type="text" class="form-control" id="product_code"  readonly
                                            placeholder="Enter product code" name="product_code" value="{{ $code }}">
                                    </div>
                                </div> <!-- end col -->

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="product_garage" class="form-label">Product Garage</label>
                                        <input type="text" name="product_garage" class="form-control">
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="product_store" class="form-label">Product Store</label>
                                        <input type="text" name="product_store" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="buying_date" class="form-label">Buying Date</label>
                                        <input type="date" name="buying_date" class="form-control">
                                    </div>
                                </div> <!-- end col -->

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="expire_date" class="form-label">Expire Date</label>
                                        <input type="date" name="expire_date" class="form-control">
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="buying_price" class="form-label">Buying Price</label>
                                        <input type="text" name="buying_price" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="selling_price" class="form-label">Selling Price</label>
                                        <input type="text" name="selling_price" class="form-control">
                                    </div>
                                </div> <!-- end col -->

                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="product_image" class="form-label">Product Image</label>
                                        <input type="file" class="form-control" id="product_image" name="product_image">
                                    </div>

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
                                        class="mdi mdi-content-save"></i> Save Product</button>
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
            $('#product_image').change(function(e) {
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
                    product_name: {
                        required: true,
                    },
                    category_id: {
                        required: true,
                    },
                    supplier_id: {
                        required: true,
                    },
                    product_code: {
                        required: true,
                    },
                    product_garage: {
                        required: true,
                    },
                    product_store: {
                        required: true,
                    },
                    buying_date: {
                        required: true,
                    },
                    expire_date: {
                        required: true,
                    },
                    buying_price: {
                        required: true,
                    },
                    selling_price: {
                        required: true,
                    },
                    product_image: {
                        required: true,
                    },
                },
                messages: {
                    product_name: {
                        required: 'Veuillez entrer le nom du produit',
                    },
                    category_id: {
                        required: 'Veuillez sélectionner une catégorie',
                    },
                    supplier_id: {
                        required: 'Veuillez sélectionner un fournisseur',
                    },
                    product_code: {
                        required: 'Veuillez entrer le code du produit',
                    },
                    product_garage: {
                        required: 'Veuillez entrer le garage du produit',
                    },
                    product_store: {
                        required: 'Veuillez entrer le magasin du produit',
                    },
                    buying_date: {
                        required: 'Veuillez sélectionner la date d\'achat',
                    },
                    expire_date: {
                        required: 'Veuillez sélectionner la date d\'expiration',
                    },
                    buying_price: {
                        required: 'Veuillez entrer le prix d\'achat',
                    },
                    selling_price: {
                        required: 'Veuillez entrer le prix de vente',
                    },
                    product_image: {
                        required: 'Veuillez sélectionner une image de produit',
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
