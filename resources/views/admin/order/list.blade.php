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
                        <table id="order-table" class="table order-table table-bordered text-center mb-0">
                            <thead>
                            <tr>
                                <th class="all">{{__('Order Code')}}</th>
                                <th class="all">{{__('Customer Name')}}</th>
                                <th class="all">{{__('Total Price')}}</th>
                                <th class="all">{{__('Payment Status')}}</th>
                                <th class="all">{{__('Delivery Status')}}</th>
                                <th class="all">{{__('Created At')}}</th>
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
        $('#order-table').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 25,
            bLengthChange: true,
            responsive:true,
            sScrollX: "100%",
            ajax: '{{route('admin.getOrderList')}}',
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
                {"data": "order_code"},
                {"data": "customer_name"},
                {"data": "total_price"},
                {"data": "payment_status"},
                {"data": "delivery_status"},
                {"data": "created_at"},
                {"data": "actions", orderable: false, searchable: false}
            ]
        });
    </script>
@endsection
