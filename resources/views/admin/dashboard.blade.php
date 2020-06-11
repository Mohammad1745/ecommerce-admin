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
        {{-- Users Information --}}
        <div class="row">
            <!-- ICON BG -->
            <div class="col-lg-3 col-md-6 col-sm-6 rounded">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">
                        <i class="fa fa-user-o"></i>
                        <div class="content dashboard-content">
                            <p class="text-muted mt-2 mb-0">{{ __('Users this month') }}</p>
                            <p class="text-primary text-24 line-height-1 mb-2">{{ $thisMonthUsers }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 rounded">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">
                        <i class="fa fa-user-o"></i>
                        <div class="content dashboard-content">
                            <p class="text-muted mt-2 mb-0">{{ __('Total Users') }}</p>
                            <p class="text-primary text-24 line-height-1 mb-2">{{ $totalUsers }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="card-title">{{ __('New Users') }}</div>
                        <div id="echartBarUsers" style="height: 300px;"></div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Products Information --}}
        <div class="row">
            <!-- ICON BG -->
            <div class="col-lg-4 col-md-7 col-sm-7 rounded">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">
                        <i class="fa fa-product-hunt"></i>
                        <div class="content dashboard-content">
                            <p class="text-muted mt-2 mb-0">{{ __('Products this month') }}</p>
                            <p class="text-primary text-24 line-height-1 mb-2">{{ $thisMonthProducts }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 rounded">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">
                        <i class="fa fa-product-hunt"></i>
                        <div class="content dashboard-content">
                            <p class="text-muted mt-2 mb-0">{{ __('Total Products') }}</p>
                            <p class="text-primary text-24 line-height-1 mb-2">{{ $totalProducts }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="card-title">{{ __('New Products') }}</div>
                        <div id="echartBarProducts" style="height: 300px;"></div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Orders Information --}}
        <div class="row">
            <!-- ICON BG -->
            <div class="col-lg-4 col-md-7 col-sm-7 rounded">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">
                        <i class="fa fa-list-alt"></i>
                        <div class="content dashboard-content">
                            <p class="text-muted mt-2 mb-0">{{ __('Orders this month') }}</p>
                            <p class="text-primary text-24 line-height-1 mb-2">{{ $thisMonthOrders }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 rounded">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">
                        <i class="fa fa-list-alt"></i>
                        <div class="content dashboard-content">
                            <p class="text-muted mt-2 mb-0">{{ __('Total Orders') }}</p>
                            <p class="text-primary text-24 line-height-1 mb-2">{{ $totalOrders }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="card-title">{{ __('New Orders') }}</div>
                        <div id="echartBarOrders" style="height: 300px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script src="{{ asset('assets/js/vendor/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/js/es5/echart.options.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            // Users Information Chart
            let usersEchartElemBar = document.getElementById('echartBarUsers');
            if (usersEchartElemBar) {
                let usersEchartBar = echarts.init(usersEchartElemBar);
                usersEchartBar.setOption({
                    grid: {
                        left: '8px',
                        right: '8px',
                        bottom: '0',
                        containLabel: true
                    },
                    tooltip: {
                        show: true,
                        backgroundColor: 'rgba(0, 0, 0, .8)'
                    },
                    xAxis: [{
                        type: 'category',
                        data: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
                        axisTick: {
                            alignWithLabel: true
                        },
                        splitLine: {
                            show: false
                        },
                        axisLine: {
                            show: true
                        }
                    }],
                    yAxis: [{
                        type: 'value',
                        axisLabel: {
                            formatter: '{value}'
                        },
                        min: 0,
                        max: '{{ $maxUsers }}',
                        interval: 25,
                        axisLine: {
                            show: false
                        },
                        splitLine: {
                            show: true,
                            interval: 'auto'
                        }
                    }],

                    series: [{
                        name: 'Users',
                        data: <?php echo json_encode($usersChartData); ?>,
                        label: { show: false, color: '#639' },
                        type: 'bar',
                        barGap: 0,
                        color: '#7569b3',
                        smooth: true,
                        itemStyle: {
                            emphasis: {
                                shadowBlur: 10,
                                shadowOffsetX: 0,
                                shadowOffsetY: -2,
                                shadowColor: 'rgba(0, 0, 0, 0.3)'
                            }
                        }
                    },]
                });
                $(window).on('resize', function () {
                    setTimeout(function () {
                        usersEchartBar.resize();
                    }, 500);
                });
            }
            //Products Information Chart
            let productsEchartElemBar = document.getElementById('echartBarProducts');
            if (productsEchartElemBar) {
                let productsEchartBar = echarts.init(productsEchartElemBar);
                productsEchartBar.setOption({
                    grid: {
                        left: '8px',
                        right: '8px',
                        bottom: '0',
                        containLabel: true
                    },
                    tooltip: {
                        show: true,
                        backgroundColor: 'rgba(0, 0, 0, .8)'
                    },
                    xAxis: [{
                        type: 'category',
                        data: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
                        axisTick: {
                            alignWithLabel: true
                        },
                        splitLine: {
                            show: false
                        },
                        axisLine: {
                            show: true
                        }
                    }],
                    yAxis: [{
                        type: 'value',
                        axisLabel: {
                            formatter: '{value}'
                        },
                        min: 0,
                        max: '{{ $maxProducts }}',
                        interval: 25,
                        axisLine: {
                            show: false
                        },
                        splitLine: {
                            show: true,
                            interval: 'auto'
                        }
                    }],

                    series: [{
                        name: 'Products',
                        data: <?php echo json_encode($productsChartData); ?>,
                        label: { show: false, color: '#639' },
                        type: 'bar',
                        barGap: 0,
                        color: '#7569b3',
                        smooth: true,
                        itemStyle: {
                            emphasis: {
                                shadowBlur: 10,
                                shadowOffsetX: 0,
                                shadowOffsetY: -2,
                                shadowColor: 'rgba(0, 0, 0, 0.3)'
                            }
                        }
                    },]
                });
                $(window).on('resize', function () {
                    setTimeout(function () {
                        productsEchartBar.resize();
                    }, 500);
                });
            }
            //Orders Information Chart
            let ordersEchartElemBar = document.getElementById('echartBarOrders');
            if (ordersEchartElemBar) {
                let ordersEchartBar = echarts.init(ordersEchartElemBar);
                ordersEchartBar.setOption({
                    grid: {
                        left: '8px',
                        right: '8px',
                        bottom: '0',
                        containLabel: true
                    },
                    tooltip: {
                        show: true,
                        backgroundColor: 'rgba(0, 0, 0, .8)'
                    },
                    xAxis: [{
                        type: 'category',
                        data: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
                        axisTick: {
                            alignWithLabel: true
                        },
                        splitLine: {
                            show: false
                        },
                        axisLine: {
                            show: true
                        }
                    }],
                    yAxis: [{
                        type: 'value',
                        axisLabel: {
                            formatter: '{value}'
                        },
                        min: 0,
                        max: '{{ $maxOrders }}',
                        interval: 25,
                        axisLine: {
                            show: false
                        },
                        splitLine: {
                            show: true,
                            interval: 'auto'
                        }
                    }],

                    series: [{
                        name: 'Orders',
                        data: <?php echo json_encode($ordersChartData); ?>,
                        label: { show: false, color: '#639' },
                        type: 'bar',
                        barGap: 0,
                        color: '#7569b3',
                        smooth: true,
                        itemStyle: {
                            emphasis: {
                                shadowBlur: 10,
                                shadowOffsetX: 0,
                                shadowOffsetY: -2,
                                shadowColor: 'rgba(0, 0, 0, 0.3)'
                            }
                        }
                    },]
                });
                $(window).on('resize', function () {
                    setTimeout(function () {
                        ordersEchartBar.resize();
                    }, 500);
                });
            }
        });
    </script>
@endsection
