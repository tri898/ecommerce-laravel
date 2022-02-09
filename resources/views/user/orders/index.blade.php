@extends('layouts.front.main')

@section('title', 'My orders')

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
<!-- breadcrumb -->
<div class="container">
    <!-- breadcrumb -->
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-80 p-lr-0-lg">
            <a href="{{route('front.home.index')}}" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                My orders
            </span>
        </div>
    </div>


    <!-- Information -->
    <section class="bg0 p-t-50 p-b-80">
        <div class="container">
            <div class="flex-w flex-r p-t-18 p-b-15 p-lr-85 p-lr-15-sm">
                <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
                    <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
                    <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                    Search
                </div>
            </div>
            <!-- Search product -->
				<div class="dis-none panel-search w-full p-t-10 p-b-15 p-lr-85">
					<div class="bor8 dis-flex p-l-15">
						<button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
							<i class="zmdi zmdi-search"></i>
						</button>

						<input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product" placeholder="Search">
					</div>	
				</div>
            @foreach ($orders as $order)
            <div class="row">
                <div class="col-lg-10 col-xl-10 m-lr-auto m-b-25 bor10">
                    <div class="flex-w flex-sb-m bor12 p-t-18 p-b-15 p-lr-25 p-lr-15-sm">
                        <span class="mtext-107 cl2 p-lr-20">
                            ID: #{{ $order->id}}
                        </span>
                        <span class="mtext-102 cl2 p-lr-20">
                            @if ($order->status == 0)
                            Canceled by me
                            @elseif ($order->status == 1)
                            Pending
                            @elseif ($order->status == 2)
                            Confirmed
                            @elseif ($order->status == 3)
                            Delivery
                            @elseif ($order->status == 4)
                            Completed
                            @else
                            Canceled by admin
                            @endif
                        </span>
                    </div>

                    @foreach ($order->products as $item)
                    <div class="flex-w flex-t bor12 p-t-18 p-b-15 p-lr-20 p-lr-15-sm">
                        @php
                        $image = json_decode($item->image_list, true);
                        @endphp
                        <span class="stext-110 cl2">
                            <div class="how-itemcart1">
                                <img src="{{ asset('files/'. $image[0]) }}" alt="IMG">
                            </div>
                        </span>
                        <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                            <span class="mtext-114 cl2 p-lr-20">
                                {{$item->name}}
                            </span>
                            @if ($item->pivot->options)
                            <span class="mtext-114">
                                ({{$item->pivot->options}})
                            </span>
                            @endif

                            <p class="mtext-114 cl2 p-lr-20">
                                x {{$item->pivot->quantity}}
                            </p>
                            <p class="mtext-114 cl2 p-lr-20">
                                ${{number_format($item->pivot->price, 2)}}
                            </p>
                        </div>

                    </div>

                    @endforeach

                    <div class="flex-w flex-r p-t-10 p-lr-20 p-lr-15-sm">
                        <span class="mtext-107 cl2 p-lr-20">
                            Total: ${{number_format($order->total, 2)}}
                        </span>
                    </div>
                    <div class="flex-w flex-r p-t-10 p-b-15 p-lr-20 p-lr-15-sm">
                        @if ($order->status == 1)
                        <form action="{{route('user.order.cancel', $order->id)}}" method="POST">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">
                            <button type="submit"
                                class="flex-c-m stext-101 cl10 size-107 bg0 bor2 hov-btn1 p-lr-15 trans-04 m-r-8 m-b-10">
                                Cancel</button>
                        </form>
                        @endif
                        <a href="{{route('user.order.show', $order->id)}}"
                            class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                            View details
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
            {{ $orders->links() }}

        </div>
    </section>
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
<script src="{{ asset('users/vendor/perfect-scrollbar/perfect-scrollbar.min.js') }}">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js">
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