@extends('admin.product.details_sidebar')

@section('product-information')
    <div class="nimmu-default-card">
        {{ Form::open(['route' => 'admin.updateProduct', 'action' => 'post' ,'files' => 'true']) }}
        <div class="input-area nimmu-input-default">
            <input id="id" type="hidden" name="id" value="{{isset($product->id) ? $product->id : null}}">
            <div class="row">
                {{-- description --}}
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{__('Description')}}</label>
                        <textarea name="description" id="descriptionField" rows="6" class="form-control">@if(isset($product)){{$product->description}}@else{{old('description')}}@endif</textarea>
                    </div>
                    @if (isset($errors) && $errors->has('description'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('description') }}</strong>
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
