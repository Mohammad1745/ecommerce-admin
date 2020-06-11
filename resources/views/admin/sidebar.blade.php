
<div class="nimmu-sidebar nimmu-sidebar-hide">
    <div class="nimmu-logo">
        <a href="index.html">
            <img src="{{asset('assets/images/logo.png')}}" class="img-fluid logo-large" alt="">
            <img src="{{asset('assets/images/small-logo.png')}}" class="img-fluid logo-small d-none" alt="">
        </a>
    </div>
    <div class="nimmu-sidebar-menu scrollbar-macosx">
        <ul>
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <span class="icon">
                        <img src="{{asset('assets/images/sidebar-icons/dashboard.svg')}}" class="img-fluid" alt="">
                    </span>
                    <span class="name">{{__('Dashboard')}}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.userList') }}">
                    <span class="icon">
                        <img src="{{asset('assets/images/sidebar-icons/man.svg')}}" class="img-fluid" alt="">
                    </span>
                    <span class="name">{{__('User Management')}}</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.categoryList')}}">
                    <span class="icon">
                        <img src="{{asset('assets/images/sidebar-icons/list.svg')}}" class="img-fluid" alt="">
                    </span>
                    <span class="name">{{ __('Category') }}</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.productList')}}">
                    <span class="icon">
                        <img src="{{asset('assets/images/sidebar-icons/product.svg')}}" class="img-fluid" alt="">
                    </span>
                    <span class="name">{{ __('Product') }}</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.flashSaleList')}}">
                    <span class="icon">
                        <img src="{{asset('assets/images/sidebar-icons/sale.svg')}}" class="img-fluid" alt="">
                    </span>
                    <span class="name">{{ __('Flash Sale') }}</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.orderList')}}">
                    <span class="icon">
                        <img src="{{asset('assets/images/sidebar-icons/order.svg')}}" class="img-fluid" alt="">
                    </span>
                    <span class="name">{{ __('Order') }}</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.shippingMethodList')}}">
                    <span class="icon">
                        <img src="{{asset('assets/images/sidebar-icons/delivery.svg')}}" class="img-fluid" alt="">
                    </span>
                    <span class="name">{{ __('Shipping Methods') }}</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.settings')}}">
                    <span class="icon">
                        <img src="{{asset('assets/images/sidebar-icons/settings.svg')}}" class="img-fluid" alt="">
                    </span>
                    <span class="name">{{ __('Settings') }}</span>
                </a>
            </li>
        </ul>
    </div>
</div>
