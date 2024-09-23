
<div class="banner_bg_main">
    <!-- header top section start -->
    <div class="container">
        <div class="header_section_top">
            <div class="row">
                <div class="col-sm-12">
                    <div class="custom_menu">
                        <ul>
                            <li><a href="#">Best Sellers</a></li>
                            <li><a href="#">Gift Ideas</a></li>
                            <li><a href="#">New Releases</a></li>
                            <li><a href="#">Today's Deals</a></li>
                            <li><a href="#">Customer Service</a></li>
                            @if(!Auth::check())
                                <li><a href="{{route('login')}}">Login</a></li>
                            @else
                            <li><a href="{{route('logout')}}">Logout</a></li>
                            @endif
                            @if(Auth::check() && Auth::user()->role==1)
                                <li><a href="{{route('dashboard.index')}}">Admin</a></li>
                            @endif


                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- header top section end -->

    <!-- logo section start -->
    <div class="logo_section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="logo"><img src="{{ asset('frontend/images/logo.png') }}" alt=""></div>
                </div>
            </div>
        </div>
    </div>
    <!-- logo section end -->

    <!-- header section start -->
    <div class="header_section">
        <div class="container">
            <div class="containt_main">
                <form method="GET" action="{{route('home.index')}} " >
                    <div class="dropdown">
                        <div class="form-row hf">
                            <select name="category_id" id="category_id" class="form-control" >
                                <option value="">Danh mục</option>
                                @foreach($category as $cate)
                                    <option value="{{ $cate->id }}" {{ request('category_id') == $cate->id ? 'selected' : '' }}>
                                        {{ $cate->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="main search-product">
                        <div class="input-group">
                            <input type="text" name="keyword" value="{{request('keyword') ?: old('keyword')}}" class="search-product form-control" placeholder="Search this blog">
                            <div class="input-group-append">
                                <button class="btn btn-secondary" type="submit" style="background-color: #f26522; border-color: #f26522">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="header_box icon-cart ">
                    <div class="login_menu">
                        <ul class="cart-setup">
                            <li><a href="{{route('show.cart')}}">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    <span class="padding_10">Cart</span></a>
                            </li>
                            @if(!Auth::check())
                                <li><a href="{{route('index')}}">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                        <span class="padding_10">Login</span></a>
                                    <a href=""><span class="padding_10">Sign In</span></a>
                                </li>
                            @else
                                <li><a href="#">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                        <span class="padding_10">{{Auth::user()->name}}</span></a>

                                </li>
                            @endif

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- header section end -->

    <div class="banner_section layout_padding">
        <div class="container">
                    <div class="carousel-item active">
                        <div class="row">
                            <div class="col-sm-12">
                                <h1 class="banner_taital">Get Start <br>Your favorite shopping</h1>
                                <div class="buynow_bt"><a href="#">Buy Now</a></div>
                            </div>
                        </div>
                    </div>
        </div>
    </div>
</div>
