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
                <li class="home">
                    <a href="{{ route('admin.home') }}">
                        <svg class="adata-svg-icon">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"></rect>
                                <path
                                    d="M3.95709826,8.41510662 L11.47855,3.81866389 C11.7986624,3.62303967 12.2013376,3.62303967 12.52145,3.81866389 L20.0429,8.41510557 C20.6374094,8.77841684 21,9.42493654 21,10.1216692 L21,19.0000642 C21,20.1046337 20.1045695,21.0000642 19,21.0000642 L4.99998155,21.0000673 C3.89541205,21.0000673 2.99998155,20.1046368 2.99998155,19.0000673 L2.99999828,10.1216672 C2.99999935,9.42493561 3.36258984,8.77841732 3.95709826,8.41510662 Z M10,13 C9.44771525,13 9,13.4477153 9,14 L9,17 C9,17.5522847 9.44771525,18 10,18 L14,18 C14.5522847,18 15,17.5522847 15,17 L15,14 C15,13.4477153 14.5522847,13 14,13 L10,13 Z"
                                    fill="#000000"></path>
                            </g>
                        </svg>
                        <span class="mt-5">Home</span>
                    </a>
                </li>

                <li class="menu-label mt-4">Admin</li>
                <li class="list_role">
                    <a href="{{ route('admin.role.list') }}">
                        <svg width="24px" height="24px" class="adata-svg-icon">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                               <polygon points="0 0 24 0 24 24 0 24"></polygon>
                               <circle fill="#000000" opacity="0.3" cx="15" cy="17" r="5"></circle>
                               <circle fill="#000000" opacity="0.3" cx="9" cy="17" r="5"></circle>
                               <circle fill="#000000" opacity="0.3" cx="7" cy="11" r="5"></circle>
                               <circle fill="#000000" opacity="0.3" cx="17" cy="11" r="5"></circle>
                               <circle fill="#000000" opacity="0.3" cx="12" cy="7" r="5"></circle>
                            </g>
                         </svg>
                        <span class="mt-5">Role</span>
                    </a>
                </li>
                <li class="user">
                    <a href="">
                        <svg class="adata-svg-icon">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                <path
                                    d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                                    fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                <path
                                    d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                                    fill="#000000" fill-rule="nonzero"></path>
                            </g>
                        </svg>
                        <span>User</span><i class="accordion-icon fa fa-angle-left"></i>
                    </a>
                    <ul class="sub-menu">
                        <li class="list_user"><a href="{{ route('admin.user.list') }}">List</a></li>
                        <li class="getCreate"><a href="{{ route('admin.user.getCreate') }}">Create</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!--/ Sidebar Menu End -->
</div>
