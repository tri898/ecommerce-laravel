@extends('layouts.front.main')

@section('title', 'Home')

@section('vendor_css')
@parent
<link rel="stylesheet" type="text/css" href="{{ asset('users/vendor/slick/slick.css') }}">
@endsection
@section('content')
<!-- Slider -->
<section class="section-slide">
    <div class="wrap-slick1 rs1-slick1">
        <div class="slick1">
            @foreach ($sliders as $slider)
            <div class="item-slick1" style="background-image: url({{ asset('files/'.$slider->image) }});">
                <div class="container h-full">
                    <div class="flex-col-l-m h-full p-t-100 p-b-30">
                        <div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
                            <span class="ltext-202 cl2 respon2">
                                {{ $slider->product->name}}
                            </span>
                        </div>

                        <div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
                            <h2 class="ltext-104 cl2 p-t-19 p-b-43 respon1">
                                {{ $slider->name}}
                            </h2>
                        </div>
                        
                        <div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
                            <a href="{{ route('front.product.show', $slider->product->slug) }}"
                                class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                Shop Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Selling Product -->
<section class="sec-product bg0 p-t-100 p-b-50">
    <div class="container">
        <div class="p-b-32">
            <h3 class="ltext-105 cl5 txt-center respon1">
                Featured Product
            </h3>
        </div>
        <!-- Tab01 -->
        <div class="tab01">
            <!-- Tab panes -->
            <div class="tab-content p-t-23">
                <!-- - -->
                <div class="tab-pane fade show active" id="featured" role="tabpanel">
                    <!-- Slide2 -->
                    <div class="wrap-slick2">
                        <div class="slick2">
                            @foreach ($featuredProducts as $product)
                            <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
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
                                                $16.64
                                            </span>
                                        </div>


                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Product -->
<section class="bg0 p-t-23 p-b-30">
    <div class="container">
        <div class="p-b-32">
            <h3 class="ltext-105 cl5 txt-center respon1">
                New Product
            </h3>
        </div>
        </br>

        <div class="row isotope-grid">

            @foreach ($products as $product)
            <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item">
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
                            <a href="{{ route('front.product.show', $product->slug) }}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                {{ $product->name}}
                            </a>

                            <span class="stext-105 cl3">
                                @php
                                $isActive = $product->discount;
                                @endphp
                                @isset($product->discount)
                                ${{ number_format($product->price - ($product->discount/100)*$product->price, 2) }}
                                @endisset
                                <span @class(['strike-through-text'=> $isActive])>
                                    ${{ number_format($product->price, 2) }}
                                </span>
                            </span>
                        </div>

                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Load more -->
        <div class="flex-c-m flex-w w-full p-t-20">
            <a href="{{ route('front.product.all') }}" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
                View All Products
            </a>
        </div>
    </div>
</section>


<!-- Blog -->
<section class="sec-blog bg0 p-t-40 p-b-90">
    <div class="container">
        <div class="p-b-66">
            <h3 class="ltext-105 cl5 txt-center respon1">
                Our Blogs
            </h3>
        </div>
        <div class="row">
            @foreach ($blogs as $blog)
            <div class="col-sm-6 col-md-4 p-b-40">
                <div class="blog-item">
                    <div class="hov-img0">
                        <a href="{{ route('front.blog.show', $blog->slug) }}">
                            <img src="{{ asset('files/'. $blog->cover_image) }}" alt="IMG-BLOG">
                        </a>
                    </div>

                    <div class="p-t-15">
                        <div class="stext-107 flex-w p-b-14">
                            <span class="m-r-3">
                                <span class="cl4">
                                    By
                                </span>

                                <span class="cl5">
                                    {{ $blog->user->name}}
                                </span>
                            </span>

                            <span>
                                <span class="cl4">
                                    on
                                </span>

                                <span class="cl5">
                                    {{ $blog->created_at}}
                                </span>
                            </span>
                        </div>

                        <h4 class="p-b-12">
                            <a href="{{ route('front.blog.show', $blog->slug) }}"
                                class="mtext-101 cl2 hov-cl1 trans-04">
                                {{ substr($blog->title, 0, 70)}}...
                            </a>
                        </h4>

                        <p class="stext-108 cl6">
                            {{ substr($blog->description, 0, 140)}}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach

        </div>

        <!-- Load more -->
        <div class="flex-c-m flex-w w-full p-t-45">
            <a href="{{ route('front.blog.index') }}"
                class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
                View All Blogs
            </a>
        </div>
    </div>
</section>
@endsection
@section('script')
@parent
<script src="{{ asset('users/vendor/slick/slick.min.js') }}"></script>
<script src="{{ asset('users/js/slick-custom.js') }}"></script>
<!--===============================================================================================-->
<script src="{{ asset('users/vendor/isotope/isotope.pkgd.min.js') }}"></script>
<!--===============================================================================================-->
@endsection