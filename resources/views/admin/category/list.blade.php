@extends('layouts.master')
@section('title') @if (isset($pageTitle)) {{ $pageTitle }} @endif @endsection

@section('content')
    <div class="nimmu-breadcrumb">
        <div class="container-fluid">
            <div class="row">
                <ul class="d-flex mb-3 col-lg-8"><li>@if (isset($pageTitle)) {{ $pageTitle }} @endif</li></ul>
                <div class="col-lg-4 pb-3"><a href="{{route('admin.createCategory')}}" class="btn btn-primary px-3 position-relative float-right">{{__('Add New')}}</a></div>
            </div>
        </div>
    </div>
    <div class="nimmu-content-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="nimmu-default-card">
                        <table id="category-table" class="table category-table table-bordered text-center mb-0">
                            <thead>
                            <tr>
                                <th class="all">{{__('Name')}}</th>
                                <th class="all">{{__('Description')}}</th>
                                <th class="all">{{__('Parent Category')}}</th>
                                <th class="all">{{__('Actions')}}</th>
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
        $('#category-table').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 25,
            bLengthChange: true,
            responsive:true,
            sScrollX: "100%",
            ajax: '{{route('admin.getCategoryList')}}',
            order:[0,'asc'],
            autoWidth:false,
            language: {
                paginate: {
                    next: 'Next &#8250;',
                    previous: '&#8249; Previous'
                },
                search: "_INPUT_",
                searchPlaceholder: "Search...",
            },
            columnDefs: [
                {"className": "text-center", "targets": "_all"}
            ],
            columns: [
                {"data": "name"},
                {"data": "description"},
                {"data": "parent_category"},
                {"data": "actions", orderable: false, searchable: false}
            ]
        });
    </script>
@endsection
