@extends('layouts.front.main')

@section('title', 'Blog')

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
<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92"
    style="background-image: url({{ asset('users/images/bg-02.jpg') }});">
    <h2 class="ltext-105 cl0 txt-center">
        Blog
    </h2>
</section>
<!-- Content page -->
<section class="bg0 p-t-62 p-b-60">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-lg-9 p-b-80">
                <div class="p-r-45 p-r-0-lg">
                    @foreach ($blogs as $blog)
                    <!-- item blog -->
                    <div class="p-b-63">
                        <a href="{{ route('front.blog.show', $blog->slug) }}" class="hov-img0 how-pos5-parent">
                            <img src="{{ asset('files/'. $blog->cover_image) }}" alt="IMG-BLOG">

                            <div class="flex-col-c-m size-123 bg9 how-pos5">
                                <span class="ltext-107 cl2 txt-center">
                                    {{ date('j', $blog->created) }}
                                </span>

                                <span class="stext-109 cl3 txt-center">
                                    {{ date('F', $blog->created) }}
                                </span>
                            </div>
                        </a>

                        <div class="p-t-32">
                            <h4 class="p-b-15">
                                <a href="{{ route('front.blog.show', $blog->slug) }}" class="ltext-108 cl2 hov-cl1 trans-04">
                                     {{ substr($blog->title, 0, 80)}} ...
                                </a>
                            </h4>

                            <p class="stext-117 cl6">
                                {{ substr($blog->description, 0, 140)}}
                            </p>

                            <div class="flex-w flex-sb-m p-t-18">
                                <span class="flex-w flex-m stext-111 cl2 p-r-30 m-tb-10">
                                    <span>
                                        <span class="cl4">By</span> {{ $blog->user->name}}
                                        <span class="cl12 m-l-4 m-r-6"></span>
                                    </span>
                                </span>

                                <a href="{{ route('front.blog.show', $blog->slug) }}" class="stext-101 cl2 hov-cl1 trans-04 m-tb-10">
                                    Continue Reading

                                    <i class="fa fa-long-arrow-right m-l-9"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <!-- Pagination -->
                    {{ $blogs->links() }}
                </div>
            </div>

            <div class="col-md-4 col-lg-3 p-b-80">
                <div class="side-menu">
                    <div class="p-t-10">
                        <h4 class="mtext-112 cl2 p-b-33">
                            Maybe You Like
                        </h4>
                        <ul>
                            @foreach ($randomProducts as $product)
                            <li class="flex-w flex-t p-b-30">
                                @php
                                $image = json_decode($product->image_list, true);
                                @endphp
                                <a href="{{ route('front.product.show', $product->slug) }}" class="wrao-pic-w size-214 hov-ovelay1 m-r-20">
                                    <img src="{{ asset('files/'.$image[0]) }}" style="width:90px;" alt="PRODUCT">
                                </a>

                                <div class="size-215 flex-col-t p-t-8">
                                    <a href="{{ route('front.product.show', $product->slug) }}" class="stext-116 cl8 hov-cl1 trans-04">
                                        {{ $product->name}}
                                    </a>

                                    <span class="stext-116 cl6 p-t-20">
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
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="p-t-50">
                        <h4 class="mtext-112 cl2 p-b-27">
                            Tags
                        </h4>

                        <div class="flex-w m-r--5">
                            <a href="#"
                                class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                                Fashion
                            </a>

                            <a href="#"
                                class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                                Lifestyle
                            </a>

                            <a href="#"
                                class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                                Denim
                            </a>

                            <a href="#"
                                class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                                Streetstyle
                            </a>

                            <a href="#"
                                class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                                Crafts
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script src="{{ asset('users/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
<script src="{{ asset('users/vendor/animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
<script src="{{ asset('users/vendor/bootstrap/js/popper.js') }}"></script>
<script src="{{ asset('users/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
<script src="{{ asset('users/vendor/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
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