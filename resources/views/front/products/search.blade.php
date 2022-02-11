@extends('layouts.front.main')

@section('title', 'Search results for '.$query)

@section('vendor_css')
@parent
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
        <!-- Pagination -->
        {{ $products->withQueryString()->links() }}

    </div>
</div>
@endsection
@section('script')
@parent
@endsection