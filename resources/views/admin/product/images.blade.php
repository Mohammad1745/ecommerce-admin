@extends('admin.product.details_sidebar')

@section('product-information')
    <div class="nimmu-default-card">
        {{ Form::open(['route' => 'admin.updateProductVariationImages', 'action' => 'post' ,'files' => 'true']) }}
        <div class="input-area nimmu-input-default">
            <input id="product_id" type="hidden" name="product_id" value="{{isset($product->id) ? $product->id : null}}">
                <div class="row">
                    {{-- name --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{__('Name')}}</label>
                        </div>
                    </div>
                    {{-- image --}}
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>{{__('Image')}}</label>
                        </div>
                    </div>
                </div>
            @foreach($productVariations as $key => $productVariation)
                <div class="row">
                    <input id="product_variation_ids" type="hidden" name="product_variation_ids[]" value="{{isset($productVariation->id) ? $productVariation->id : null}}">
                    {{-- name --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <input id="namesField" type="text" disabled name="names[]" @if(isset($productVariation)) value="{{$productVariation->name}}" @else value="{{old('name')}}" @endif class="form-control">
                            @if (isset($errors) && $errors->has('name'))
                                <span class="text-danger">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    {{-- image --}}
                    <div class="col-md-8">
                        <div class="form-group">
                            <div class="row section">
                                <div class="col s12 m12 l12">
                                    <input name="images[]" type="file" id="input-file-now" class="dropify" data-default-file="{{isset($productVariation) && !empty($productVariation->image) ? asset(productImageViewPath().$productVariation->image) : ''}}"/>
                                    @if (isset($errors) && $errors->has('image'))
                                        <div class="text-danger">{{ $errors->first('image') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="row">
                <div class="col-md-3">
                    <button id="saveButton" class="btn btn-primary btn-block add-product-btn">{{__('Save')}}</button>
                </div>
            </div>
        </div>
        {{ Form::close() }}
    </div>
    <!-- End content area  -->
@endsection

@section('script')
    <script type='text/javascript' src='{{ asset('assets/js/dropify.min.js') }}'></script>
    <script>
        $(document).ready(function () {
            $('.dropify').dropify();
        });
    </script>
@endsection
