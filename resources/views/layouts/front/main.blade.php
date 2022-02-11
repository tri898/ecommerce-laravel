<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!--===============================================================================================-->
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('admins/assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('admins/assets/img/favicon.png') }}">
    <!--=========================================VENDOR CSS=================================================-->
    @section('vendor_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('users/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('users/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('users/fonts/iconic/css/material-design-iconic-font.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('users/fonts/linearicons-v1.0.0/icon-font.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('users/vendor/animate/animate.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('users/vendor/css-hamburgers/hamburgers.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('users/vendor/animsition/css/animsition.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('users/vendor/perfect-scrollbar/perfect-scrollbar.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('users/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('users/css/main.css') }}">
    <!--===============================================================================================-->
    @show
</head>

<body class="animsition">

    <!-- Header -->
    <header class="header-v2">
        <!-- Header desktop -->
        <div class="container-menu-desktop">
            <!-- Topbar -->
            <div class="top-bar">
                <div class="content-topbar flex-sb-m h-full container">
                    <div class="left-top-bar">
                        Free shipping for standard order over $100
                    </div>
                    @auth
                    <div class="right-top-bar flex-w h-full">
                        <a href="{{route('user.profile.index')}}" class="flex-c-m trans-04 p-lr-25">
                            {{ auth()->user()->name }}
                        </a>
                        <a href="{{route('user.order.index')}}" class="flex-c-m trans-04 p-lr-25">
                            My Orders
                        </a>
                        @if (auth()->user()->is_admin)
                        <a href="{{route('admin.dashboard.index')}}" class="flex-c-m trans-04 p-lr-25">
                            Dashboard
                        </a>
                        @endif
                        <a href="{{route('logout')}}" class="flex-c-m trans-04 p-lr-25">
                            Logout
                        </a>
                    </div>
                    @endauth
                    @guest
                    <div class="right-top-bar flex-w h-full">
                        <a href="{{route('login.index')}}" class="flex-c-m trans-04 p-lr-25">
                            Login
                        </a>
                        <a href="{{route('register.index')}}" class="flex-c-m trans-04 p-lr-25">
                            Register
                        </a>
                    </div>
                    @endguest
                </div>
            </div>
            @php
            $categories = App\Models\Category::with('subcategories:name,slug,category_id')
            ->get(['id','name','slug']);
            @endphp
            <div class="wrap-menu-desktop">
                <nav class="limiter-menu-desktop p-l-45">

                    <!-- Logo desktop -->
                    <a href="{{route('front.home.index')}}" class="logo">
                        <img src="{{ asset('admins/assets/img/logo-dark.png') }}" alt="Klorofil Logo">
                    </a>
                    <!-- Menu desktop -->
                    <div class="menu-desktop">
                        <ul class="main-menu">
                            <li class="{{ (request()->is('/')) ? 'active-menu' : '' }}">
                                <a href="{{route('front.home.index')}}">Home</a>
                            </li>
                            <li class="{{ (request()->is('shop')) ? 'active-menu' : '' }}">
                                <a href="{{ route('front.product.all') }}">Shop</a>
                                <ul class="sub-menu">
                                    @foreach ($categories as $category)
                                    <li><a
                                            href="{{ route('front.product.category', $category->slug) }}">{{ $category->name}}</a>
                                        <ul class="sub-menu">
                                            @foreach ($category->subcategories as $subcategory )
                                            <li><a href="{{ route('front.product.subcategory',
                                                [$category->slug,$subcategory->slug]) }}">
                                                    {{ $subcategory->name }}
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    @endforeach
                                </ul>
                            </li>

                            <li class="{{ (request()->is('cart')) ? 'active-menu' : '' }}">
                                <a href="{{route('front.cart.index')}}">Cart</a>
                            </li>

                            <li class="label1 {{ (request()->is('blog*')) ? 'active-menu' : '' }}" data-label1="hot">
                                <a href="{{ route('front.blog.index') }}">Blog</a>
                            </li>

                            <li>
                                <a href="#">About</a>
                            </li>

                            <li>
                                <a href="#">Contact</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Icon header -->
                    <div class="wrap-icon-header flex-w flex-r-m h-full">
                        <div class="flex-c-m h-full p-r-24">
                            <div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 js-show-modal-search">
                                <i class="zmdi zmdi-search"></i>
                            </div>
                        </div>

                        <div class="flex-c-m h-full p-l-18 p-r-25 bor5">
                            <div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 js-show-cart">
                                <i class="zmdi zmdi-shopping-cart js-show-cart"></i>
                            </div>
                            <div id="ajax-noti-cart">
                                <div class="noti-cart-load">({{ count((array) session('cart')) }})</div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>

        <!-- Header Mobile -->
        <div class="wrap-header-mobile">
            <!-- Logo moblie -->
            <div class="logo-mobile">
                <a href="{{route('front.home.index')}}"><img src="{{ asset('admins/assets/img/logo-dark.png') }}"
                        alt="IMG-LOGO"></a>
            </div>

            <!-- Icon header -->
            <div class="wrap-icon-header flex-w flex-r-m h-full m-r-15">
                <div class="flex-c-m h-full p-r-10">
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 js-show-modal-search">
                        <i class="zmdi zmdi-search"></i>
                    </div>
                </div>

                <div class="flex-c-m h-full p-lr-10 bor5">
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 js-show-cart">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </div>
                    <div id="ajax-noti-cart-m">
                        <div class="noti-cart-load-m">({{ count((array) session('cart')) }})</div>
                    </div>
                </div>
            </div>

            <!-- Button show menu -->
            <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </div>
        </div>
        <!-- Menu Mobile -->
        <div class="menu-mobile">
            <ul class="topbar-mobile">
                <li>
                    <div class="left-top-bar">
                        Free shipping for standard order over $100
                    </div>
                </li>

                <li>
                    @auth
                    <div class="right-top-bar flex-w h-full">
                        <a href="{{route('user.profile.index')}}" class="flex-c-m trans-04 p-lr-25">
                            {{ auth()->user()->name }}
                        </a>

                        <a href="{{route('user.order.index')}}" class="flex-c-m trans-04 p-lr-25">
                            My Orders
                        </a>
                        @if (auth()->user()->is_admin)
                        <a href="{{route('admin.dashboard.index')}}" class="flex-c-m trans-04 p-lr-25">
                            Dashboard
                        </a>
                        @endif
                        <a href="{{route('logout')}}" class="flex-c-m trans-04 p-lr-25">
                            Logout
                        </a>
                    </div>
                    @endauth
                    @guest
                    <div class="right-top-bar flex-w h-full">
                        <a href="{{route('login.index')}}" class="flex-c-m trans-04 p-lr-25">
                            Login
                        </a>

                        <a href="{{route('register.index')}}" class="flex-c-m trans-04 p-lr-25">
                            Register
                        </a>
                    </div>
                    @endguest
                </li>
            </ul>
            <ul class="main-menu-m">
                <li>
                    <a href="{{route('front.home.index')}}">Home</a>
                </li>

                <li>
                    <a href="{{ route('front.product.all') }}">Shop</a>
                    <ul class="sub-menu-m">
                        @foreach ($categories as $category)
                        <li><a href="{{ route('front.product.category', $category->slug) }}">{{ $category->name}}</a>
                            <ul class="sub-menu-m">
                                @foreach ($category->subcategories as $subcategory )
                                <li><a
                                        href="{{ route('front.product.subcategory',[$category->slug,$subcategory->slug]) }}">
                                        {{ $subcategory->name }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        @endforeach
                    </ul>
                    <span class="arrow-main-menu-m">
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </span>
                </li>

                <li>
                    <a href="{{route('front.cart.index')}}">Cart</a>
                </li>

                <li>
                    <a href="{{ route('front.blog.index') }}" class="label1 rs1" data-label1="hot">Blog</a>
                </li>

                <li>
                    <a href="#">About</a>
                </li>

                <li>
                    <a href="#">Contact</a>
                </li>
            </ul>
        </div>

        <!-- Modal Search -->
        @include('layouts.front.elements.search')

    </header>
    <!-- Cart -->
    @include('layouts.front.elements.cart')
    <!-- Content -->
    @yield('content')
    <!-- Footer -->
    @include('layouts.front.elements.footer')
    <!-- Back to top -->
    <div class="btn-back-to-top" id="myBtn">
        <span class="symbol-btn-back-to-top">
            <i class="zmdi zmdi-chevron-up"></i>
        </span>
    </div>
    <!-- Script -->
    @section('script')
    <script src="{{ asset('users/vendor/jquery/jquery-3.2.1.min.js') }}">
    </script>
    <!--===============================================================================================-->
    <script src="{{ asset('users/vendor/animsition/js/animsition.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('users/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('users/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <!--===============================================================================================-->
    <!--===============================================================================================-->
    <script src="{{ asset('users/vendor/perfect-scrollbar/perfect-scrollbar.min.js') }}">
    </script>
    <script>
    $('.js-pscroll').each(function() {
        $(this).css('position', 'relative');
        $(this).css('overflow', 'hidden');
        var ps = new PerfectScrollbar(this, {
            wheelSpeed: 1,
            scrollingThreshold: 1000,
            wheelPropagation: false,
        });

        $(window).on('resize', function() {
            ps.update();
        })
    });
    </script>
    <!--===============================================================================================-->
    <script src="{{ asset('users/js/main.js') }}"></script>
    @show
</body>

</html>