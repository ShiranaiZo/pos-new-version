@extends('layout')

@section('title', "Create | Products")

@section('content')
    @if ($errors->any())
        <div class="card-body pt-0">
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible show fade">
                    <i class="bi bi-file-excel"></i> {{ $error }}

                    <button type="button" class="btn-close btn-close-session" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endforeach
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Product</h4>
        </div>

        <div class="card-content">
            <div class="card-body">
                <form method="POST" action="{{ url('products') }}" id="form_create_product" enctype="multipart/form-data">
                    @method('POST')
                    @csrf

                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label>SKU <span class="text-danger">*</span></label>
                            </div>

                            <div class="col-md-8 form-group">
                                <input type="text" id="sku" class="form-control  @error('sku') is-invalid @enderror" name="sku" placeholder="SKU" value="{{ old('sku') }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <label>Name <span class="text-danger">*</span></label>
                            </div>

                            <div class="col-md-8 form-group">
                                <input type="text" id="name" class="form-control  @error('name') is-invalid @enderror" name="name" placeholder="Name" value="{{ old('name') }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <label>Description <span class="text-danger">*</span></label>
                            </div>

                            <div class="col-md-8 form-group">
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Description" rows="3">{{ old('description') }}</textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <label>Stock <span class="text-danger">*</span></label>
                            </div>

                            <div class="col-md-8 form-group">
                                <input type="text" id="stock" class="form-control  @error('stock') is-invalid @enderror" name="stock" placeholder="Stock" value="{{ old('stock') }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <label>Price <span class="text-danger">*</span></label>
                            </div>

                            <div class="col-md-8 form-group">
                                <input type="text" id="price" class="form-control  @error('price') is-invalid @enderror" name="price" placeholder="Price" value="{{ old('price') }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <label>Image <span class="text-danger">*</span></label>
                            </div>

                            <div class="col-md-4 form-group">
                                <input type="file" id="image" class="form-control @error('image') is-invalid @enderror" name="image">
                            </div>

                            <div class="col-md-4 form-group">
                                <img id="preview_image" src="{{ asset('assets/images/samples/building.jpg') }}" alt="Can't load image." style="max-width: 100%; width: auto">
                            </div>
                        </div>


                        <div class="col-sm-12 d-flex justify-content-end mt-4">
                            <button type="button" class="btn btn-primary me-1 mb-1 submit_create_product" id="submit_create_product" onclick='preventDoubleClick("form_create_product", "submit_create_product")'>Submit</button>

                            <a href="{{ url('products') }}" class="btn btn-light-secondary mx-1 mb-1">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            // show and hide password
            $('#show').click(function(){
                if($(this).is(':checked')){
                    $('#password').prop('type', 'text')
                }else{
                    $('#password').prop('type', 'password')
                }
            })
		});

        $(document).on('change', '#image', function () {
            preview_image.src = URL.createObjectURL(event.target.files[0]);
        });
    </script>
@endsection
