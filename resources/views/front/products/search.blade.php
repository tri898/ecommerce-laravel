@extends('layouts.front.main')

@section('title', 'Search')

@section('vendor_css')
<link rel="stylesheet" type="text/css" href="{{ asset('users/vendor/bootstrap/css/bootstrap.min.css') }}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('users/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('users/fonts/iconic/css/material-design-iconic-font.min.css') }}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('users/fonts/linearicons-v1.0.0/icon-font.min.css') }}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('users/vendor/animate/animate.css') }}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('users/vendor/slick/slick.css') }}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('users/vendor/css-hamburgers/hamburgers.min.css') }}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('users/vendor/animsition/css/animsition.min.css') }}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('users/vendor/perfect-scrollbar/perfect-scrollbar.css') }}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('users/css/util.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('users/css/main.css') }}">
@endsection
@section('content')
<!-- Product -->
<div class="bg0 m-t-30 p-b-140">
    <div class="container">

        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-50 p-lr-0-lg p-b-50">
            <a href="{{ route('front.home.index')}}" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>
            <span class="stext-109 cl4">
                Search
            </span>
        </div>
        <div class="flex-w flex-sb-m p-t-12 p-b-15 p-lr-15-sm">
            <span class="mtext-102 cl2 p-lr-20">
              Found {{count($products)}} results with "{{$query}}"
            </span>
        </div>
        <div class="row isotope-grid">
            @foreach ($products as $product)
            <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
                <!-- Block2 -->
                <div class="block2">
                    <div class="block2-pic hov-img0">
                        @php
                        $image = json_decode($product->image_list, true);
                        @endphp
                        <img src="{{ asset('files/'.$image[0]) }}" alt="IMG-PRODUCT">

                        <a href="{{ route('front.product.show', $product->slug) }}"
                            class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
                            View Details
                        </a>
                    </div>

                    <div class="block2-txt flex-w flex-t p-t-14">
                        <div class="block2-txt-child1 flex-col-l ">
                            <a href="{{ route('front.product.show', $product->slug) }}"
                                class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                {{ $product->name}}
                            </a>

                            <span class="stext-105 cl3">
                                @php
                                $isActive = $product->discount;
                                @endphp
                                <span @class(['strike-through-text'=> $isActive])>
                                    ${{ number_format($product->price, 2) }}
                                </span>
                                @isset($product->discount)
                                ${{ number_format($product->price - ($product->discount/100)*$product->price, 2) }}
                                @endisset
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
        <!-- Pagination -->
        {{ $products->withQueryString()->links() }}

    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('users/vendor/jquery/jquery-3.2.1.min.js') }}">
</script>
<!--===============================================================================================-->
<script src="{{ asset('users/vendor/animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
<script src="{{ asset('users/vendor/bootstrap/js/popper.js') }}"></script>
<script src="{{ asset('users/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
<script src="{{ asset('users/vendor/slick/slick.min.js') }}"></script>
<script src="{{ asset('users/js/slick-custom.js') }}"></script>
<!--===============================================================================================-->
<script src="{{ asset('users/vendor/parallax100/parallax100.js') }}"></script>
<script>
$('.parallax100').parallax100();
</script>
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
@endsection