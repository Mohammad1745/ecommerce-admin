@extends('admin.product.details_sidebar')

@section('product-information')
    <div class="nimmu-default-card">
        {{ Form::open(['route' => 'admin.updateProduct', 'action' => 'post' ,'files' => 'true']) }}
        <div class="input-area nimmu-input-default">
            <input id="id" type="hidden" name="id" value="{{isset($product->id) ? $product->id : null}}">
            <div class="row">
                {{-- name --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('Name')}}</label>
                        <input id="nameField" type="text" name="name" @if(isset($product)) value="{{$product->name}}" @else value="{{old('name')}}" @endif class="form-control" placeholder="Name">
                        @if (isset($errors) && $errors->has('name'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                {{-- brand_id --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('Parent Product')}}</label>
                        <select id="parentIdField" name="brand_id" class="form-control">
                            <option value="{{null}}" >{{__('Parent Product')}}</option>
                            @if (isset($brands))
                                @foreach($brands as $value)
                                    <option @if(isset($product) && ($product->brand_id == $value->id)) selected
                                            @elseif((old('brand_id') != null) && (old('brand_id') == $value->id)) selected @endif value="{{ $value->id }}">{{$value->name}}</option>

                                @endforeach
                            @endif
                        </select>
                    </div>
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
