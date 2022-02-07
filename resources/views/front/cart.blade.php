@extends('layouts.front.main')

@section('title', 'Cart')

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
    <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-80 p-lr-0-lg">
        <a href="{{ route('front.home.index')}}" class="stext-109 cl8 hov-cl1 trans-04">
            Home
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <span class="stext-109 cl4">
            Shoping Cart
        </span>
    </div>

    <!-- Shoping Cart -->
    <section class="bg0 p-t-75 p-b-85">
        <div class="container">
            @if (count((array) session('cart')) > 0)
            <div class="row">
                <div class="col-lg-10 col-xl-10 m-lr-auto m-b-50">
                    <div class="m-l-25 m-r--38 m-lr-0-xl">
                        <div class="wrap-table-shopping-cart">
                            <table class="table-shopping-cart">
                                <tr class="table_head">
                                    <th class="column-1">Product</th>
                                    <th class="column-2"></th>
                                    <th class="column-3">Price</th>
                                    <th class="column-4">Quantity</th>
                                    <th class="column-5">Total</th>
                                    <th class="column-6"></th>
                                </tr>
                                @php $total = 0 @endphp
                                @if(session('cart'))
                                @foreach(session('cart') as $id => $details)
                                @php $total += $details['price'] * $details['quantity'] @endphp
                                <tr class="table_row" id="{{ $id }}">
                                    <td class="column-1">
                                        <div class="how-itemcart1">
                                            <img src="{{ asset('files/'. $details['image']) }}" alt="IMG">
                                        </div>
                                    </td>
                                    <td class="column-2">
                                        <span class="mtext-104">
                                            <a href="{{route('front.product.show',$details['slug']) }}">
                                                {{ $details['name'] }}
                                            </a>
                                        </span>
                                        <p>{{ $details['options'] }}</p>
                                    </td>
                                    <td class="column-3 product-price">${{ $details['price'] }}</td>
                                    <td class="column-4">
                                        <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                            <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-minus"></i>
                                            </div>

                                            <input class="mtext-104 cl3 txt-center num-product" type="number" min="1"
                                                max="999" name="num-product1" value="{{ $details['quantity'] }}"
                                                disabled>

                                            <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-plus"></i>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="column-5 product-total-price">
                                        ${{ number_format($details['price'] * $details['quantity'],2) }}
                                    </td>
                                    <td class="column-6">
                                        <a href="javascript:void(0)" data-id="{{ $id }}" class=""
                                            onclick="deleteProduct(event.currentTarget)">
                                            <img src="{{ asset('users/images/icons/icon-close2.png') }}" alt="Delete">
                                        </a>
                                    </td>

                                </tr>
                                @endforeach
                                @endif

                            </table>
                        </div>
                        <div class="bor15">
                            <div id="ajax-load">
                                <div class="total-load">
                                    <div class="flex-w flex-r bor12 p-t-18 p-b-15 p-lr-25 p-lr-15-sm">
                                        <span class="mtext-101 cl2 p-lr-20">
                                            Total:
                                        </span>
                                        <span class="mtext-103 cl2">
                                            ${{ number_format($total, 2) }}
                                        </span>
                                    </div>
                                    <div class="flex-w flex-r p-t-18 p-b-15 p-lr-20 p-lr-15-sm">
                                        <a href="{{route('front.purchase.index')}}"
                                            class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                                            Proceed to Purchase
                                        </a>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            @else
            @if(Session::has('success'))
            <div class="row">
                <div class="col-lg-10 col-xl-10 m-lr-auto m-b-50">
                    <div class="flex-c flex-c-m p-t-18 p-b-15 p-lr-25 p-lr-15-sm">
                        <img src="{{ asset('users/images/icons/success.png') }}" alt="ICON">
                    </div>
                    <div class="flex-c flex-c-m p-t-18 p-b-15 p-lr-25 p-lr-15-sm">
                        <span class="mtext-105 cl2 p-lr-20">
                            THANK YOU FOR YOUR PURCHASE
                        </span>
                    </div>
                    <div class="flex-c flex-c-m bor12 p-t-18 p-b-15 p-lr-25 p-lr-15-sm">
                        <span class="mtext-100 cl2 p-lr-20">
                            You can check your order<a href="{{route('user.order.index')}}"> here</a>
                        </span>
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-lg-10 col-xl-10 m-lr-auto m-b-50">
                    <div class="flex-w flex-sb-m p-t-18 p-b-15 p-lr-25 p-lr-15-sm total-load">
                        <span class="mtext-101 cl2 p-lr-20">
                            Cart is empty.
                        </span>
                        <p><a href="{{route('front.product.all')}}">Go to shopping</a></p>
                    </div>
                </div>
            </div>


            @endif

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
</script>
<!--===============================================================================================-->
<script src="{{ asset('users/js/main.js') }}"></script>
<script>
$(document).ready(function() {
    $('.btn-num-product-down, .btn-num-product-up').click(function(e) {
        var id = $(this).parents('tr').attr('id');
        var quantity = $(this).parents('tr').find('.num-product').val();

        var totalPrice = $(this).parents('tr').find('.product-total-price');
        var price = $(this).parents('tr').find('.product-price');

        let _url = '{{ route('front.cart.update',':id')}}';
        _url = _url.replace(':id', id);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: _url,
            type: 'PUT',
            data: {
                quantity: quantity
            },
            success: function(response) {
                totalPrice.text('$' + response.totalPrice);
                price.text('$' + response.price);
                $('#ajax-load').load(location.href + ' .total-load');
                $('#ajax-header-cart').load(location.href + ' .header-cart-load');
                $('#ajax-noti-cart-m').load(location.href + ' .noti-cart-load-m');

            }
        });


    });

});

function deleteProduct(event) {
    var id = $(event).data('id');
    let _url = '{{ route('front.cart.destroy',':id')}}';
    _url = _url.replace(':id', id);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: _url,
        type: 'DELETE',
        success: function(response) {

            $('#' + id).remove();
            $('#ajax-load').load(location.href + ' .total-load');

            $('#ajax-header-cart').load(location.href + ' .header-cart-load');
            $('#ajax-noti-cart').load(location.href + ' .noti-cart-load');
            $('#ajax-noti-cart-m').load(location.href + ' .noti-cart-load-m');

        }
    });
}
</script>
@endsection