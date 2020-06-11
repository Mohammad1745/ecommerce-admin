@extends('layouts.master')
@section('title') @if (isset($pageTitle)) {{ $pageTitle }} @endif @endsection

@section('content')
    <div class="nimmu-breadcrumb">
        <div class="container-fluid">
            <div class="row">
                <ul class="d-flex mb-3 col-lg-8"><li>@if (isset($pageTitle)) {{ $pageTitle }} @endif</li></ul>
            </div>
        </div>
    </div>
    <div class="nimmu-content-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="nimmu-default-card">
                        {{ Form::open(['route' => 'admin.storeProduct', 'action' => 'post' ,'files' => 'true']) }}
                        <div class="input-area nimmu-input-default">
                            <div class="row">
                                {{-- brand_id --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('Brand')}}<span class="text-danger">*</span></label>
                                        <select id="parentIdField" name="brand_id" class="form-control">
                                            <option value="{{null}}" >{{__('Brand')}}</option>
                                            @if (isset($brands))
                                                @foreach($brands as $value)
                                                    <option @if(isset($product) && ($product->brand_id == $value->id)) selected
                                                            @elseif((old('brand_id') != null) && (old('brand_id') == $value->id)) selected @endif value="{{ $value->id }}">{{$value->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                {{-- name --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('Name')}}<span class="text-danger">*</span></label>
                                        <input id="nameField" type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="Name">
                                    </div>
                                    @if (isset($errors) && $errors->has('name'))
                                        <span class="text-danger">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                {{-- description --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{__('Description')}}<span class="text-danger">*</span></label>
                                        <textarea name="description" id="descriptionField" rows="6" class="form-control">{{old('description')}}</textarea>
                                    </div>
                                    @if (isset($errors) && $errors->has('description'))
                                        <span class="text-danger">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                {{-- regular_price --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{__('Regular Price')}}<span class="text-danger">*</span></label>
                                        <input id="regularPriceField" type="number" step="0.01" name="regular_price" min="0" value="{{old('regular_price')}}" class="form-control" placeholder="Regular Price" min="0">
                                    </div>
                                    @if (isset($errors) && $errors->has('regular_price'))
                                        <span class="text-danger">
                                            <strong>{{ $errors->first('regular_price') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                {{-- sell_price --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{__('Sell Price')}}<span class="text-danger">*</span></label>
                                        <input id="sellPriceField" type="number" step="0.01" name="sell_price" min="0" value="{{old('sell_price')}}" class="form-control" placeholder="Sell Price" min="0">
                                    </div>
                                    @if (isset($errors) && $errors->has('sell_price'))
                                        <span class="text-danger">
                                            <strong>{{ $errors->first('sell_price') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                {{-- quantity --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{__('Quantity')}}<span class="text-danger">*</span></label>
                                        <input id="regularPriceField" type="number" name="quantity" min="0" value="{{old('quantity')}}" class="form-control" placeholder="Quantity" min="0">
                                    </div>
                                    @if (isset($errors) && $errors->has('quantity'))
                                        <span class="text-danger">
                                            <strong>{{ $errors->first('quantity') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <button id="saveProductButton" class="btn btn-primary btn-block add-product-btn">{{__('Add New')}}</button>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End content area  -->
@endsection

@section('script')
    <script>

    </script>
@endsection
