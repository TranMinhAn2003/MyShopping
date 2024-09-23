<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Eflyer</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->

    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/bootstrap.min.css')}}">
    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/style.css')}}">
    <!-- Responsive-->
    <link rel="stylesheet" href="{{asset('frontend/css/responsive.css')}}">
    <!-- fevicon -->
    <link rel="icon" href="{{asset('frontend/images/fevicon.png')}}" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="{{asset('frontend/css/jquery.mCustomScrollbar.min.css')}}">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <!-- font awesome -->
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--  -->
    <!-- owl stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes|Poppins:400,700&display=swap&subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('frontend/css/owl.carousel.min.css')}}">
    <link rel="stylesoeet" href="{{asset('frontend/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">


    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet">

    <link href="{{ asset('public/css/animate.css')}}" rel="stylesheet">
    <link href="{{ asset('css/style.css')}}" rel="stylesheet">
    <link href="{{ asset('css/setup.css')}}" rel="stylesheet">


</head>

<body class="gray-bg">
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
                            <li><a href="{{route('index')}}">Login</a></li>
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
<div class="loginColumns animated fadeInDown">
    <div class="row">
        <div class="col-md-10">
            <div class="ibox-content">
                <form class="m-t" role="form" method="post" action="">
                    @csrf
                    <legend>Lấy lại mật khẩu</legend>
                    <p>Vui lòng nhập email mà bạn đã đăng kí tài khoản</p>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Email" name="email" value="{{old('email')}}" >
                        @if($errors->has('email'))
                            <span class="error-message"> * {{$errors->first('email')}}</span>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary block full-width m-b">Gửi Email xác nhận</button>
                </form>

            </div>
        </div>
    </div>
    <hr/>

</div>

</body>

</html>
