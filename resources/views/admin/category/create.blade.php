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
                        {{ Form::open(['route' => 'admin.storeCategory', 'action' => 'post' ,'files' => 'true']) }}
                        <div class="input-area nimmu-input-default">
                            <div class="row">
                                {{-- parent_id --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('Parent Category')}}</label>
                                        <select id="parentIdField" name="parent_id" class="form-control">
                                            <option value="{{null}}" >{{__('Parent Category')}}</option>
                                            @if (isset($parentCategories[0]))
                                                @foreach($parentCategories as $value)
                                                    <option @if(isset($category) && ($category->parent_id == $value->id)) selected
                                                            @elseif((old('parent_id') != null) && (old('parent_id') == $value->id)) selected @endif value="{{ $value->id }}">{{$value->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                {{-- name --}}
                                <div class="col-md-6">
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
                            <div class="row">
                                {{-- description --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{__('Description')}}</label>
                                        <textarea name="description" id="descriptionField" rows="6" class="form-control">{{old('description')}}</textarea>
                                    </div>
                                    @if (isset($errors) && $errors->has('description'))
                                        <span class="text-danger">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            {{-- image --}}
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{__('Image')}}<span class="text-danger"></span></label>
                                    <div id="file-upload">
                                        <!--Default version-->
                                        <div class="fallback">
                                            <input name="image" id="input-file-now" class="dropify" type="file" />
                                        </div>
                                        <!--Default value-->
                                    </div>
                                </div>
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
