<div class="page-sidebar">
    <div class="logo">
        <a class="logo-img" href="{{ route('admin.home') }}">
            <img class="desktop-logo" src="../../assets/images/logo.png" alt="">
            <img class="small-logo" src="../../assets/images/small-logo.png" alt="">
        </a>
        <a id="sidebar-toggle-button-close"><i class="wd-20 ht-20" data-feather="x"></i> </a>
    </div>
    <!--================================-->
    <!-- Sidebar Menu Start -->
    <!--================================-->
    <div class="page-sidebar-inner">
        <div class="page-sidebar-menu">
            <ul class="accordion-menu">
                <li class="menu-label"></li>
                <li class="home {{ Request::routeIs('admin.home') ? 'active' : '' }}">
                    <a href="{{ route('admin.home') }}">
                        <i class="mr-2 fa fa-home"></i>
                        <span class="mt-5">HOME</span>
                    </a>
                </li>

                {{-- admin --}}
                <li class="menu-label mt-4">ADMIN</li>
                <li class="user @if (Request::routeIs('admin.user.list') || Request::routeIs('admin.user.getCreate') || Request::routeIs('admin.user.getProfile')) open active @endif">
                    <a href="#">
                        <i class="fa  fa-users mr-2"></i>
                        <span>SETTING USER</span><i class="accordion-icon fa fa-angle-left"></i>
                    </a>
                    <ul class="sub-menu li-user">
                        <li class="list_user  @if (Request::routeIs('admin.user.list') || Request::routeIs('admin.user.getProfile')) active @endif"><a href="{{ route('admin.user.list') }}">List</a></li>
                        <li class="getCreate {{ Request::routeIs('admin.user.getCreate') ? 'active' : '' }}"><a href="{{ route('admin.user.getCreate') }}">Create</a></li>
                    </ul>
                </li>
                <li class="list_role {{ Request::routeIs('admin.role.list') ? 'active' : '' }}">
                    <a href="{{ route('admin.role.list') }}">
                        <div class="mr-2 fa fa-spin fa-asterisk"></div>
                        <span class="mt-5">SETTING ROLE</span>
                    </a>
                </li>
                <li class="@if (Request::routeIs('admin.emails') || Request::routeIs('admin.emails.edit')) active @endif">
                    <a href="{{ route('admin.emails') }}">
                        <i class="fa fa-spin fa-envelope-open-o mr-2"></i>
                        <span>SETTING EMAIL</span>
                    </a>
                </li>
                {{-- end admin --}}
                {{-- restaurant --}}
                <li class="menu-label mt-2">RESTAURANT</li>
                <li class="project @if (Request::routeIs('admin.restaurant.restaurant_setting') || Request::routeIs('admin.restaurant.index') || Request::routeIs('admin.restaurant.update')) open active @endif">
                    <a href="#">
                        <i class="fa fa-spin fa-asterisk mr-2"></i>
                        <span>RESTAURANT</span><i class="accordion-icon fa fa-angle-left"></i>
                    </a>
                    <ul class="sub-menu ">
                        <li class="@if (Request::routeIs('admin.restaurant.index') ) active @endif"><a href="{{ route('admin.restaurant.index') }}">List</a></li>
                        <li class="@if (Request::routeIs('admin.restaurant.restaurant_setting') ) active @endif"><a href="{{ route('admin.restaurant.restaurant_setting') }}">Create</a></li>
                    </ul>
                </li>
                <li class="project @if (Request::routeIs('admin.setting_food.index') || Request::routeIs('admin.setting_food.getCreate')) open active @endif">
                    <a href="#">
                        <i class="fa fa-spin fa-gear mr-2"></i>
                        <span>SETTING FOODS</span><i class="accordion-icon fa fa-angle-left"></i>
                    </a>
                    <ul class="sub-menu ">
                        <li class="@if (Request::routeIs('admin.setting_food.index') ) active @endif"><a href="{{ route('admin.setting_food.index') }}">List</a></li>
                        <li class="@if (Request::routeIs('admin.setting_food.getCreate') ) active @endif"><a href="{{ route('admin.setting_food.getCreate') }}">Create</a></li>
                    </ul>
                </li>
                <li class="{{ Request::routeIs('admin.restaurant_food.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.restaurant_food.index') }}">
                        <i class="fa fa-spin fa-life-ring mr-2"></i>
                        <span class="mt-5">RESTAURANT FOODS</span>
                    </a>
                </li>
                <li class="{{ Request::routeIs('admin.coupons') ? 'active' : '' }}">
                    <a href="{{ route('admin.coupons') }}">
                        <i class="fa fa-spin fa-star-o mr-2"></i>
                        <span class="mt-5">RESTAURANT COUPON</span>
                    </a>
                </li>
                <li class="{{ Request::routeIs('admin.listTable') ? 'active' : '' }}">
                    <a href="{{ route('admin.listTable') }}">
                        <i class="fa fa-spin fa-table mr-2"></i>
                        <span class="mt-5">RESTAURANT TABLES</span>
                    </a>
                </li>
                {{-- order --}}
                <li class="menu-label mt-2">ORDERS</li>
                <li class="{{ Request::routeIs('admin.order.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.order.index') }}">
                        <i class="fa fa-spin fa-life-ring mr-2"></i>
                        <span class="mt-5">ORDERS</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!--/ Sidebar Menu End -->
</div>
