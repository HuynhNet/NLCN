<header class="main-header">
    <!-- Logo -->
    <a href="{{ route('getAdmin') }}" class="logo" style="height: 60px;">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>LT</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button" 
            style="margin-top: 5px;">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <!-- Notifications: style can be found in dropdown.less -->
                {{-- <li class="dropdown notifications-menu" style="padding-top: 5px;">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning">10</span>
                    </a>

                    <ul class="dropdown-menu">
                        <li class="header">Có 10 thông báo mới</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-users text-aqua"></i> 5 khách hàng mới đăng ký trong hôm nay
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <i class="fa fa-users text-red"></i> 5 new members joined
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <i class="fa fa-shopping-cart text-green"></i> 5 yêu cầu cấp lại mật khẩu
                                    </a>
                                </li>
                                
                            </ul>
                        </li>
                        <li class="footer"><a href="#">View all</a></li>
                    </ul>
                </li>   --}}

                <!-- User Account: style can be found in dropdown.less -->
                @if(Auth::check())
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ asset('public/upload/image_admin/'.Auth::user()->image) }}" class="img-responsive" alt="Image" style="height: 25px; width: 25px; border-radius: 50%;">
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header" style="height: 100px;">
                                <p style="color: white; font-size: 16px;"> 
                                    {{ Auth::user()->name }} - Web Developer
                                    <small>Thành viên từ năm 2019</small>
                                </p>
                            </li>
                            
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{ route('getInforUser',Auth::user()->id) }}" class="btn btn-success">Thông tin</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ route('getLogout') }}" class="btn btn-success">Đăng xuất</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                @else
                    <p>Chua dang nhap</p>
                @endif
            </ul>
        </div>
    </nav>
</header>

<style>
    .sidebar-menu li{
        font-size: 17px;
        color: white;
    }

    .sidebar-menu .treeview-menu li a{
        font-size: 16px;
    }
</style>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <div class="user-panel" style="height: 50px;">
            @if(Auth::check())
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            @endif
        </div>


        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">BẢNG ĐIỀU KHIỂN</li>
            <li class="active treeview menu-open">
            <a href="#">
                <i class="fa fa-dashboard"></i> <span>Quản lý giao diện</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ route('getManageBanner') }}"><i class="glyphicon glyphicon-chevron-right"></i> Banner</a></li>
            </ul>
            </li>

            <li class="treeview">
            <a href="#">
                <i class="glyphicon glyphicon-user"></i>
                <span>Quản lý người dùng</span>
                <span class="pull-right-container">
                    <span class="label label-primary pull-right">3</span>
                </span>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a href="{{ route('getManageAdmin') }}">
                        <i class="glyphicon glyphicon-chevron-right"></i>Quản lý admin
                    </a>
                </li>
                <li>
                    <a href="{{ route('getManageMember') }}">
                        <i class="glyphicon glyphicon-chevron-right"></i>Quản lý thành viên
                    </a>
                </li>
            </ul>
            </li>

            <li class="treeview">
            <a href="">
                <i class="fa fa-files-o"></i>
                <span>Quản lý đặt hàng</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a href="{{ route('getManageOrder') }}">
                        <i class="glyphicon glyphicon-chevron-right"></i> Quản lý hóa đơn
                    </a>
                </li>
                <!-- <li>
                    <a href="">
                        <i class="glyphicon glyphicon-chevron-right"></i> Quản lý cán bộ
                    </a>
                </li> -->
            </ul>
            </li>
        
            <li>
                <a href="{{ route('getManageProducts') }}">
                    <i class="fa fa-book"></i><span>Quản lý sản phẩm</span>
                </a>
            </li>
        </ul>

    </section>
    <!-- /.sidebar -->
</aside>