@extends('layouts.vendor')

@section('_css')
    <link href="{{ asset('assets/admin/lib/summernote/summernote-bs4.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/lib/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet">
    <style>
        .note-toolbar {
            z-index: 1;
        }
        .bootstrap-tagsinput {
            width: 100%;
            min-height: 45px;
        }
    </style>
@endsection

@section('title')
    Product | Create
@endsection

@section('page-info')
    <div class="br-pagetitle">
        <i class="icon ion-ios-home-outline"></i>
        <div>
            <h4>Product | Create</h4>
            <p class="mg-b-0">Here is product entry form</p>
        </div>
    </div>
@endsection

@section('content')
<div class="row row-sm">
    <div class="col-sm-12 col-xl-12 mg-t-20 mg-xl-t-0">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('vendor.products.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-layout form-layout-1">
                        <div class="row mg-b-25">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="switch-field">
                                        <input type="radio" id="General" name="type" value="General" {{ old('type') == 'General' ? 'checked' : '' }} checked/>
                                        <label for="General">General Products</label>
                                        <input type="radio" id="Book" name="type" value="Book" {{ old('type') == 'Book' ? 'checked' : '' }} />
                                        <label for="Book">Book</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Category -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label">Select Category <span class="tx-danger">*</span></label>
                                     <select class="form-control select2" name="category_id">
                                                <option value="" selected hidden disabled></option>
                                                @if(!empty($categories))
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                    @error('category_id') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <!-- Brand -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label">Select Brand</label>
                                    <select class="form-control select2" name="brand_id">
                                        <option value="" selected hidden disabled></option>
                                      @if(!empty($brands))
                                            @foreach($brands as $brand)
                                                <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('brand_id') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <!-- Merchant -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label">Select Merchant</label>
                                    <select class="form-control select2" name="merchant_id">
                                        <option value="" selected hidden disabled></option>
                                      @if (!empty($merchants))
                                            @foreach($merchants as $merchant)
                                                <option value="{{ $merchant->id }}" {{ old('merchant_id') == $merchant->id ? 'selected' : '' }}>{{ $merchant->name }}</option>
                                            @endforeach
                                      
                                      @endif
                                    </select>
                                    @error('merchant_id') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <!-- Code, Name -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Code Number<span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="code" value="{{ old('code') }}">
                                    @error('code') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Name <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <!-- Prices -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label">Buy Price <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="number" min="0" name="buy_price" value="{{ old('buy_price') }}">
                                    @error('buy_price') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label">Sell Price <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="number" min="0" name="price" value="{{ old('price') }}">
                                    @error('price') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-control-label">Discount</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <select name="discount_type">
                                                <option value="" hidden disabled selected>Select One</option>
                                                <option value="Taka" {{ old('discount_type') == "Taka" ? 'selected' : '' }}>Taka</option>
                                                <option value="Percentage" {{ old('discount_type') == "Percentage" ? 'selected' : '' }}>Percentage</option>
                                            </select>
                                        </div>
                                    </div>
                                    <input type="number" class="form-control" name="discount_value" value="{{ old('discount_value') }}">
                                </div>
                                @error('discount_value') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <!-- Stock -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Stock<span class="tx-danger">*</span></label>
                                    <input class="form-control" type="number" min="0" name="stock" value="{{ old('stock') }}">
                                    @error('stock') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <!-- General Product Fields -->
                            <div class="col-md-12 GeneralProducts">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Size</label>
                                            <input class="form-control" type="text" name="size" placeholder="S, M, L" value="{{ old('size') }}" data-role="tagsinput">
                                            @error('size') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Color</label>
                                            <input class="form-control" type="text" name="color" placeholder="Red, Blue" value="{{ old('color') }}" data-role="tagsinput">
                                            @error('color') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Fabrics</label>
                                            <input class="form-control" type="text" name="fabrics" placeholder="Cotton, Silk" value="{{ old('fabrics') }}" data-role="tagsinput">
                                            @error('fabrics') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Weight</label>
                                            <input class="form-control" type="text" name="weight" value="{{ old('weight') }}">
                                            @error('weight') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Warranty</label>
                                            <input class="form-control" type="text" name="warranty" value="{{ old('warranty') }}">
                                            @error('warranty') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label">Description</label>
                                    <textarea class="form-control summernote" name="description">{{ old('description') }}</textarea>
                                    @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <!-- Images -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label">Upload Product Images</label>
                                    <input type="file" name="images[]" class="form-control" multiple>
                                    @error('images') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Create Product</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('_js')
    <script src="{{ asset('assets/admin/lib/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('assets/admin/lib/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.summernote').summernote({
                height: 150
            });
        });
    </script>
@endsection
