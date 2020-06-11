@extends('layouts.master')
@section('title') @if (isset($pageTitle)) {{ $pageTitle }} @endif @endsection
@section('content')
    <div class="nimmu-breadcrumb">
        <div class="container-fluid">
            <div class="row">
                <ul class="d-flex mb-3 col-lg-8"><li>@if (isset($pageTitle)) {{ $pageTitle }} @endif</li></ul>
                <div class="col-lg-4 pb-3"><a href="{{route('admin.userAdd')}}" class="btn btn-primary px-3 position-relative float-right">{{__('Create User')}}</a></div>
            </div>
        </div>
    </div>
    <div class="nimmu-content-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="nimmu-default-card">
                        <table class="table" id="band" width="100%" class="table user-table table-bordered text-center mb-0">
                            <thead>
                            <tr>
                                <th class="all">{{__('Name')}}</th>
                                <th class="all">{{__('Email')}}</th>
                                <th class="all">{{__('Phone')}}</th>
                                <th class="all">{{__('Address')}}</th>
                                <th class="all">{{__('Zip Code')}}</th>
                                <th class="all">{{__('City')}}</th>
                                <th class="all">{{__('Country')}}</th>
                                <th class="all">{{__('Status')}}</th>
                                <th class="desktop">{{__('Actions')}}</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#band').DataTable({
            processing: true,
            serverSide: true,
            responsive: false,
            sScrollX: "100%",
            ajax: '{{route('admin.getUserList')}}',
            order: [0, 'asc'],
            autoWidth:false,
            columnDefs: [
                {"className": "text-center", "targets": "_all"}
            ],
            columns: [
                {"data": "first_name"},
                {"data": "email"},
                {"data": "phone"},
                {"data": "address"},
                {"data": "zip_code"},
                {"data": "city"},
                {"data": "country"},
                {"data": "status"},
                {"data": "action", orderable: false, searchable: false}
            ]
        });
    </script>
@endsection
