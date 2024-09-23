<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">David Williams</strong></span></span>
                    </a>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li>
                <a href="{{route('dashboard.index')}}"><i class="fa fa-th-large"></i> <span class="nav-label">Trang Chủ</span> </a>
            </li>
            <li >
                <a href="{{route('user.index')}}"><i class="fa fa-user"></i> <span class="nav-label">QL Thành Viên</span> </a>
            </li>
            <li >
                <a href="{{route('order.index')}}"><i class="bi bi-cart4"></i> <span class="nav-label">QL Đơn hàng </span> </a>
            </li>
            <li >
                <a href=""><i class="bi bi-bag-dash-fill"></i><span class="nav-label">QL Sản Phẩm</span> </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('attributecatalogue.index') }}">Nhóm thuộc tính</a>
                    </li>
                    <li>
                        <a href="{{ route('attribute.index') }}">Thuộc tính</a>
                    </li>
                    <li>
                        <a href="{{route('category.index')}}">Nhóm sản phẩm</a>
                    </li>
                    <li>
                        <a href="{{ route('product.index') }}">Sản phẩm</a>
                    </li>

                </ul>
            </li>
            <li>
                <a href="{{route('home.index')}}"><i class="bi bi-house-fill"></i> <span class="nav-label">Trang người dùng</span> </a>
            </li>
            <li>
                <a href="{{route('logout')}}">
                    <i class="fa fa-sign-out"></i> Log out
                </a>
            </li>

        </ul>
    </div>
</nav>
