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
                        {{ Form::open(['route' => 'admin.updateFlashSale', 'action' => 'post' ,'files' => 'true']) }}
                        <input id="id" type="hidden" name="id" value="{{isset($flashSale->id) ? $flashSale->id : ''}}">
                        <div class="input-area nimmu-input-default">
                            <div class="row">
                                {{-- product_id --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('Product')}}</label>
                                        <select id="productIdField" name="product_id" class="form-control">
                                            <option value="{{null}}" >{{__('Select Product')}}</option>
                                            @if (isset($products))
                                                <option selected value="{{ $flashSaleProduct->id }}">{{$flashSaleProduct->name}}</option>
                                                @foreach($products as $product)
                                                    <option @if(isset($flashSale) && ($flashSale->product_id == $product->id)) selected
                                                            @elseif((old('product_id') != null) && (old('product_id') == $product->id)) selected @endif  value="{{ $product->id }}">{{$product->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                {{-- expires_at --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('Expires At')}}</label>
                                        <input id="expiresAtField" type="datetime-local" name="expires_at" @if(isset($flashSale)) value="{{$flashSale->expires_at}}" @else value="{{old('expires_at')}}" @endif class="form-control">
                                    </div>
                                    @if (isset($errors) && $errors->has('expires_at'))
                                        <span class="text-danger">
                                            <strong>{{ $errors->first('expires_at') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                {{-- flash_sale_price --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('Flash Sale Price')}}</label>
                                        <input id="flashSalePriceField" type="number" step="0.01" name="flash_sale_price" min="0" @if(isset($flashSale)) value="{{$flashSale->flash_sale_price}}" @else value="{{old('flash_sale_price')}}" @endif class="form-control" placeholder="Flash Sale Price">
                                    </div>
                                    @if (isset($errors) && $errors->has('flash_sale_price'))
                                        <span class="text-danger">
                                            <strong>{{ $errors->first('flash_sale_price') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <button id="saveCategoryButton" class="btn btn-primary btn-block add-category-btn">{{__('Add New')}}</button>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End content area  -->
@endsection

@section('script')
@endsection
