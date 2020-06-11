@extends('admin.product.details_sidebar')

@section('product-information')
    <div class="nimmu-default-card">
        {{ Form::open(['route' => 'admin.updateProductVariations', 'action' => 'post' ,'files' => 'true']) }}
        <div class="input-area nimmu-input-default">
            <input id="product_id" type="hidden" name="product_id" value="{{isset($product->id) ? $product->id : null}}">
                <div class="row">
                    {{-- name --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{__('Name')}}</label>
                        </div>
                    </div>
                    {{-- price --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{__('Price')}}</label>
                        </div>
                    </div>
                    {{-- quantity --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{__('Quantity')}}</label>
                        </div>
                    </div>
                </div>
            @foreach($productVariations as $productVariation)
                <div class="row">
                    <input id="product_variation_id" type="hidden" name="product_variation_id[]" value="{{isset($productVariation->id) ? $productVariation->id : null}}">
                    {{-- name --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <input id="nameField" type="text" disabled name="name[]" @if(isset($productVariation)) value="{{$productVariation->name}}" @else value="{{old('name')}}" @endif class="form-control">
                            @if (isset($errors) && $errors->has('name'))
                                <span class="text-danger">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    {{-- price --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <input id="nameField" type="number" step="0.01" name="price[]" min="0" @if(isset($productVariation)) value="{{$productVariation->price}}" @else value="{{old('price')}}" @endif class="form-control">
                            @if (isset($errors) && $errors->has('price'))
                                <span class="text-danger">
                                <strong>{{ $errors->first('price') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    {{-- quantity --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <input id="nameField" type="number" name="quantity[]" min="0" @if(isset($productVariation)) value="{{$productVariation->quantity}}" @else value="{{old('quantity')}}" @endif class="form-control">
                            @if (isset($errors) && $errors->has('quantity'))
                                <span class="text-danger">
                                <strong>{{ $errors->first('quantity') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="row">
                <div class="col-md-3">
                    <button id="saveProductButton" class="btn btn-primary btn-block add-product-btn">{{__('Save')}}</button>
                </div>
            </div>
        </div>
        {{ Form::close() }}
    </div>
    <!-- End content area  -->
@endsection

@section('script')
@endsection
