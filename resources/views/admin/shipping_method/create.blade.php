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
                        {{ Form::open(['route' => 'admin.storeShippingMethod', 'action' => 'post' ,'files' => 'true']) }}
                        <div class="input-area nimmu-input-default">
                            <div class="row">
                                {{-- name --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{__('Name')}}</label>
                                        <input id="nameField" type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="Name">
                                    </div>
                                    @if (isset($errors) && $errors->has('name'))
                                        <span class="text-danger">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <button id="saveShippingMethodButton" class="btn btn-primary btn-block add-category-btn">{{__('Add New')}}</button>
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
@endsection
