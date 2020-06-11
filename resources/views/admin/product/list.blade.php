@extends('layouts.master')
@section('title') @if (isset($pageTitle)) {{ $pageTitle }} @endif @endsection

@section('content')
    <div class="nimmu-breadcrumb">
        <div class="container-fluid">
            <div class="row">
                <ul class="d-flex mb-3 col-lg-8"><li>@if (isset($pageTitle)) {{ $pageTitle }} @endif</li></ul>
                <div class="col-lg-4 pb-3"><a href="{{route('admin.createProduct')}}" class="btn btn-primary px-3 position-relative float-right">{{__('Add New')}}</a></div>
            </div>
        </div>
    </div>
    <div class="nimmu-content-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="nimmu-default-card">
                        <table id="product-table" class="table product-table table-bordered text-center mb-0">
                            <thead>
                            <tr>
                                <th class="all">{{__('Name')}}</th>
                                <th class="all">{{__('Brand')}}</th>
                                <th class="all">{{__('Regular Price')}}</th>
                                <th class="all">{{__('Sell Price')}}</th>
                                <th class="all">{{__('Quantity')}}</th>
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
        $('#product-table').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 25,
            bLengthChange: true,
            responsive:true,
            sScrollX: "100%",
            ajax: '{{route('admin.getProductList')}}',
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
                {"data": "brand"},
                {"data": "regular_price"},
                {"data": "sell_price"},
                {"data": "quantity"},
                {"data": "actions", orderable: false, searchable: false}
            ]
        });
    </script>
@endsection
