@extends('admin.product.details_sidebar')

@section('product-information')
    <div class="nimmu-default-card">
        {{ Form::open(['route' => 'admin.updateProductShippingMethods', 'action' => 'post' ,'files' => 'true']) }}
        <div class="input-area nimmu-input-default">
            <input id="product_id" type="hidden" name="product_id" value="{{isset($product->id) ? $product->id : null}}">
            <div class="row">
                {{-- shipping_method --}}
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{__('Shipping Methods')}}</label>
                        <select id="shippingMethodField" name="shipping_methods[]" class="form-control" multiple>
                            @foreach(shippingMethods() as $key => $value)
                                <option @foreach ($productShippingMethods as $shippingMethod)
                                    @if($shippingMethod->shipping_method == $key) selected @endif
                                @endforeach value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
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
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>
    <script>
        $(function () {
            $('#shippingMethodField').multipleSelect()
        })
    </script>
@endsection
