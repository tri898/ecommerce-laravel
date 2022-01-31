@extends('layouts.front.main')

@section('title', 'Checkout')

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
<link rel="stylesheet" type="text/css" href="{{ asset('users/vendor/select2/select2.min.css') }}">
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
            <a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                Checkout
            </span>
        </div>
    </div>


    <!-- Information -->
    <section class="bg0 p-t-80 p-b-80">
        <div class="container">
            <div class="flex-w flex-tr">
                <div class="size-209 bor10 p-lr-70 p-t-55 p-b-10 p-lr-15-lg w-full-md">
                    <form>
                        <h4 class="mtext-105 cl2 txt-center p-b-30">
                            Delivery information
                        </h4>

                        <div class="bor8 m-b-20 how-pos4-parent">
                            <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="name"
                                placeholder="Your Name">
                            <img class="how-pos4 pointer-none" src="{{ asset('users/images/icons/user.png') }}"
                                alt="ICON">
                        </div>
                        <div class="bor8 m-b-20 how-pos4-parent">
                            <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="phone"
                                placeholder="Phone Number">
                            <img class="how-pos4 pointer-none" src="{{ asset('users/images/icons/phone-call.png') }}"
                                alt="ICON">
                        </div>
                        <div class="bor8 m-b-20 how-pos4-parent">
                            <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="address"
                                placeholder="Address">
                            <img class="how-pos4 pointer-none" src="{{ asset('users/images/icons/address.png') }}"
                                alt="ICON">
                        </div>
                        <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                            <select class="js-select2" name="time">
                                <option>Select a country...</option>
                                <option>USA</option>
                                <option>UK</option>
                            </select>
                            <div class="dropDownSelect2"></div>
                        </div>
                        <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                            <select class="js-select2" name="time">
                                <option>Select a country...</option>
                                <option>USA</option>
                                <option>UK</option>
                            </select>
                            <div class="dropDownSelect2"></div>
                        </div>
                        <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                            <select class="js-select2" name="time">
                                <option>Select a country...</option>
                                <option>USA</option>
                                <option>UK</option>
                            </select>
                            <div class="dropDownSelect2"></div>
                        </div>
                        <div class="bor8 m-b-30">
                            <textarea class="stext-111 cl2 plh3 size-120 p-lr-28 p-tb-25" name="msg"
                                placeholder="Note about your order"></textarea>
                        </div>
                    </form>
                </div>

                <div class="size-219 bg6 bor10 flex-w flex-col-t p-lr-40 p-tb-30 p-lr-15-lg w-full-md">
                    <h4 class="mtext-109 cl2 p-b-30">
                        Order Summary
                    </h4>
                    <div class="size-304 js-pscroll2">
                        @if(session('cart'))
                        @foreach(session('cart') as $id => $details)
                        <div class="flex-w flex-t p-b-20">
                            <div class="size-208 w-full-ssm">
                                <span class="stext-110 cl2">
                                    <div class="how-itemcart1">
                                        <img src="{{ asset('files/'. $details['image']) }}" alt="IMG">
                                    </div>
                                </span>
                            </div>

                            <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                                <p class="stext-111 cl6 p-t-2">
                                    {{ $details['name'] }}
                                </p>
                                <p class="stext-111 cl6 p-t-2">
                                    {{ $details['quantity'] }} x $ {{ $details['price'] }}
                                </p>
                                <p class="stext-111 cl6 p-t-2">
                                    {{ $details['options'] }}
                                </p>
                            </div>

                        </div>
                        @endforeach
                        @endif


                    </div>
                    <div class="bor12"></div>
                    <div class="flex-w flex-t bor12 p-b-13 p-t-30">
                        @php $subtotal = 0 @endphp
                        @foreach((array) session('cart') as $id => $details)
                        @php $subtotal += $details['price'] * $details['quantity'] @endphp
                        @endforeach
                        <div class="size-208">
                            <span class="stext-110 cl2">
                                Subtotal:
                            </span>
                        </div>

                        <div class="size-209">
                            <span class="mtext-110 cl2">
                                $ {{ number_format($subtotal, 2) }}
                            </span>
                        </div>
                    </div>

                    <div class="flex-w flex-t bor12 p-t-15 p-b-15">
                        <div class="size-208 w-full-ssm">
                            <span class="stext-110 cl2">
                                Shipping:
                            </span>
                        </div>

                        <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                            <span class="mtext-110 cl2">
                                -
                            </span>
                        </div>
                    </div>

                    <div class="flex-w flex-t p-t-27 p-b-33">
                        <div class="size-208">
                            <span class="mtext-101 cl2">
                                Total:
                            </span>
                        </div>

                        <div class="size-209 p-t-1">
                            <span class="mtext-110 cl2">
                                $79.65
                            </span>
                        </div>
                    </div>

                    <button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                        Proceed to Checkout
                    </button>

                </div>
            </div>
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
$('.js-pscroll2').each(function() {
    $(this).css('position', 'relative');
    $(this).css('overflow', 'auto');
    $(this).css('max-height', '420px');
    var ps = new PerfectScrollbar(this, {
        wheelSpeed: 1,
        scrollingThreshold: 5000,
        wheelPropagation: false,
    });

    $(window).on('resize', function() {
        ps.update();
    })
});
</script>
<!--===============================================================================================-->
<script src="{{ asset('users/vendor/select2/select2.min.js') }}"></script>
<script>
$(".js-select2").each(function() {
    $(this).select2({
        minimumResultsForSearch: 20,
        dropdownParent: $(this).next('.dropDownSelect2')
    });
})
</script>
<!--===============================================================================================-->
<script src="{{ asset('users/js/main.js') }}"></script>
<script>
$(document).ready(function() {
    @if(!session('cart'))
    console.log('ookk');
    @endif
});
</script>
@endsection