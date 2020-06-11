@extends('admin.product.details_sidebar')

@section('product-information')
    <div class="nimmu-default-card">
        {{ Form::open(['route' => 'admin.updateProduct', 'action' => 'post' ,'files' => 'true']) }}
        <div class="input-area nimmu-input-default">
            <input id="id" type="hidden" name="id" value="{{isset($product->id) ? $product->id : null}}">
            <div class="row">
                {{-- regular_price --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('Regular Price')}}</label>
                        <input id="regularPriceField" type="number" step="0.01" name="regular_price" min="0" @if(isset($product)) value="{{$product->regular_price}}" @else value="{{old('regular_price')}}" @endif class="form-control" placeholder="Regular Price" min="0">
                    </div>
                    @if (isset($errors) && $errors->has('regular_price'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('regular_price') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="row">
                {{-- sell_price --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('Sell Price')}}</label>
                        <input id="sellPriceField" type="number" step="0.01" name="sell_price" min="0" @if(isset($product)) value="{{$product->sell_price}}" @else value="{{old('sell_price')}}" @endif class="form-control" placeholder="Sell Price" min="0">
                    </div>
                    @if (isset($errors) && $errors->has('sell_price'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('sell_price') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="row">
                {{-- tax --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('Tax(%)')}}</label>
                        <input id="sellPriceField" type="number" readonly name="tax" class="form-control" value="{{ (isset($settings) && isset($settings['tax' . '_' . Auth::id()])) ? $settings['tax' . '_' . Auth::id()] : '' }}" placeholder="Tax" min="0">
                    </div>
                    @if (isset($errors) && $errors->has('tax'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('tax') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="row">
                {{-- discount --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('Discount(%)')}}</label>
                        <input id="sellPriceField" type="number" readonly name="discount" class="form-control" value="{{ (isset($settings) && isset($settings['discount' . '_' . Auth::id()])) ? $settings['discount' . '_' . Auth::id()] : '' }}" placeholder="Discount" min="0">
                    </div>
                    @if (isset($errors) && $errors->has('discount'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('discount') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="row">
                {{-- quantity --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('Quantity')}}</label>
                        <input id="regularPriceField" type="number" name="quantity" min="0" @if(isset($product)) value="{{$product->quantity}}" @else value="{{old('quantity')}}" @endif class="form-control" placeholder="Quantity" min="0">
                    </div>
                    @if (isset($errors) && $errors->has('quantity'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('quantity') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
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
