@extends('layouts.front.main')

@section('title', 'Order details')

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
                Order details #{{$order->id}}
            </span>
        </div>
    </div>


    <!-- Information -->
    <section class="bg0 p-t-80 p-b-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-xl-10 m-lr-auto m-b-25">
                    <div class="stepper-wrapper">
                        <div class="stepper-item completed active">
                            <div class="step-counter">1</div>
                            <div class="step-name cl2">Pending</div>
                        </div>

                        @if ($order->status == 0)
                        <div class="stepper-item completed active">
                            <div class="step-counter">2</div>
                            <div class="step-name cl2">Canceled by me</div>
                        </div>

                        @elseif ($order->status == 5)
                        <div class="stepper-item completed active">
                            <div class="step-counter">2</div>
                            <div class="step-name cl2">Canceled by admin</div>
                        </div>

                        @else
                        <div class="stepper-item @if ($order->status >=2) completed active @endif">
                            <div class="step-counter">2</div>
                            <div class="step-name cl2">Confirmed</div>
                        </div>
                        <div class="stepper-item @if ($order->status >=3) completed active @endif">
                            <div class="step-counter">3</div>
                            <div class="step-name cl2">Delivery</div>
                        </div>
                        <div class="stepper-item @if ($order->status ==4) completed active @endif">
                            <div class="step-counter">4</div>
                            <div class="step-name cl2">Completed</div>
                        </div>

                        @endif

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                    <div class="m-l-25 m-r--38 m-lr-0-xl">
                        <div class="wrap-table-shopping-cart">
                            <table class="table-shopping-cart">
                                <tr class="table_head">
                                    <th class="column-1">Product</th>
                                    <th class="column-2"></th>
                                    <th class="column-3">Price</th>
                                    <th class="column-4">Total</th>
                                </tr>
                                @foreach ($order->products as $item)
                                <tr class="table_row">
                                    <td class="column-1">
                                        @php
                                        $image = json_decode($item->image_list, true);
                                        @endphp
                                        <div class="how-itemcart1">
                                            <img src="{{ asset('files/'.$image[0]) }}" alt="IMG">
                                        </div>
                                    </td>
                                    <td class="column-2">
                                        <span class="mtext-114">
                                            <a href="{{route('front.product.show',$item->slug) }}">
                                                {{$item->name}}
                                            </a>
                                        </span>
                                        <p class="mtext-114">{{$item->pivot->options}}</p>
                                        <p class="mtext-114">x {{$item->pivot->quantity}}</p>
                                    </td>
                                    <td class="column-3">${{number_format($item->pivot->price, 2)}}</td>
                                    <td class="column-4">
                                        ${{number_format($item->pivot->total, 2)}}
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="bor15">
                            <div class="flex-w flex-r p-t-18 p-b-15 p-lr-25 p-lr-15-sm">
                                <span class="mtext-101 cl2 p-lr-20">
                                    Subtotal:
                                </span>
                                <span class="mtext-103 cl2">
                                    ${{number_format($order->subtotal, 2)}}
                                </span>
                            </div>
                            <div class="flex-w flex-r p-b-15 p-lr-20 p-lr-15-sm">
                                <span class="mtext-101 cl2 p-lr-20">
                                    Shipping:
                                </span>
                                <span class="mtext-103 cl2">
                                    ${{number_format($order->shipping_fee, 2)}}
                                </span>
                            </div>
                            <div class="flex-w flex-r p-b-15 p-lr-20 p-lr-15-sm">
                                <span class="mtext-101 cl2 p-lr-20">
                                    Total:
                                </span>
                                <span class="mtext-103 cl2">
                                    ${{number_format($order->total, 2)}}
                                </span>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                    <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                        <h4 class="mtext-109 cl2 p-b-30">
                            Delivery information</h4>
                        </h4>
                        <div class="flex-w flex-t bor12 p-b-13">
                            <div class="size-208">
                                <span class="stext-110 cl2">
                                    Name:
                                </span>
                            </div>

                            <div class="size-209">
                                <span class="mtext-110 cl2">
                                    {{$order->name}}
                                </span>
                            </div>
                        </div>

                        <div class="flex-w flex-t bor12 p-t-15 p-b-13">
                            <div class="size-208 w-full-ssm">
                                <span class="stext-110 cl2">
                                    Phone:
                                </span>
                            </div>

                            <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                                <p class="stext-111 cl6 p-t-2">
                                    {{$order->phone}}
                                </p>
                            </div>

                        </div>
                        <div class="flex-w flex-t p-t-15 bor12 p-b-13">
                            <div class="size-208 w-full-ssm">
                                <span class="stext-110 cl2">
                                    Address:
                                </span>
                            </div>

                            <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                                <p class="stext-111 cl6 p-t-2">
                                    {{$order->address}}
                                </p>
                            </div>

                        </div>
                        <div class="flex-w flex-t p-t-15 bor12 p-b-13">
                            <div class="size-208 w-full-ssm">
                                <span class="stext-110 cl2">
                                    Note:
                                </span>
                            </div>

                            <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                                <p class="stext-111 cl6 p-t-2">
                                    {{$order->note}}
                                </p>
                            </div>

                        </div>
                        <div class="flex-w flex-t p-t-15">
                            <div class="size-208 w-full-ssm">
                                <span class="stext-110 cl2">
                                    Date time:
                                </span>
                            </div>

                            <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                                <p class="stext-111 cl6 p-t-2">
                                    {{$order->created_at}}
                                </p>
                            </div>

                        </div>
                    </div>
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