@extends('layouts.master')
@section('title') @if (isset($pageTitle)) {{ $pageTitle }} @endif @endsection
@section('style')
@endsection

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
                <div class="col-4">
                    <div class="nimmu-default-card bg-primary">
                        <div class="nimmu-sidebar-menu position-relative" style="top:0; width: auto!important;; height: auto!important;" data-perfect-scrollbar data-suppress-scroll-x="true">
                            <ul class="navigation-left mr-0 w-auto h-auto">
                                <li class="nav-item">
                                    <a class="nav-item-hold" href="{{route('admin.productDetails', encrypt($product->id))}}">
                                        <span class="nav-text {{ isset($subMenu) && $subMenu == 'general' ? 'text-white' : '' }}">{{__('General')}}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-item-hold" href="{{route('admin.productAttributes', encrypt($product->id))}}">
                                        <span class="nav-text {{ isset($subMenu) && $subMenu == 'attributes' ? 'text-white' : '' }}">{{ __('Attributes') }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-item-hold" href="{{route('admin.productPriceAndQuantity', encrypt($product->id))}}">
                                        <span class="nav-text {{ isset($subMenu) && $subMenu == 'price_and_quantity' ? 'text-white' : '' }}">{{ __('Price & Quantity') }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-item-hold" href="{{route('admin.productVariations', encrypt($product->id))}}">
                                        <span class="nav-text {{ isset($subMenu) && $subMenu == 'variations' ? 'text-white' : '' }}">{{ __('Variations') }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-item-hold" href="{{route('admin.productVariationImages', encrypt($product->id))}}">
                                        <span class="nav-text {{ isset($subMenu) && $subMenu == 'images' ? 'text-white' : '' }}">{{ __('Images') }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-item-hold" href="{{route('admin.productDescription', encrypt($product->id))}}">
                                        <span class="nav-text {{ isset($subMenu) && $subMenu == 'description' ? 'text-white' : '' }}">{{ __('Description') }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-item-hold" href="{{route('admin.productShippingMethods', encrypt($product->id))}}">
                                        <span class="nav-text {{ isset($subMenu) && $subMenu == 'shipping_method' ? 'text-white' : '' }}">{{ __('Shipping Method') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    @yield('product-information')
                </div>
            </div>
        </div>
    </div>
    <!-- End content area  -->
@endsection

@section('script')
    @yield('script')
@endsection
