<div class="wrap-header-cart js-panel-cart">
    <div class="s-full js-hide-cart"></div>

    <div class="header-cart flex-col-l p-l-65 p-r-25">
        <div class="header-cart-title flex-w flex-sb-m p-b-8">
            <span class="mtext-103 cl2">
                Your Cart
            </span>

            <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>

        <div class="header-cart-content flex-w js-pscroll">
            <div id="ajax-header-cart">
                <div class="header-cart-load">
                    <ul class="header-cart-wrapitem w-full">

                        @if(session('cart'))
                        @foreach(session('cart') as $id => $details)
                        <li class="header-cart-item flex-w flex-t m-b-12">
                            <div class="header-cart-item-img">
                                <img src="{{ asset('files/'. $details['image']) }}" alt="IMG">
                            </div>

                            <div class="header-cart-item-txt p-t-4">
                                <a href="{{ route('front.product.show', $details['slug']) }}"
                                    class="header-cart-item-name m-b-9 hov-cl1 trans-04">
                                    {{ $details['name'] }}
                                </a>

                                <span class="header-cart-item-info">
                                    {{ $details['quantity'] }} x $ {{ $details['price'] }}
                                </span>
                                <span class="header-cart-item-info">
                                    {{ $details['options'] }}
                                </span>
                            </div>
                        </li>
                        @endforeach
                        @endif

                    </ul>
                    <div class="w-full">
                        @php $total = 0 @endphp
                        @foreach((array) session('cart') as $id => $details)
                        @php $total += $details['price'] * $details['quantity'] @endphp
                        @endforeach
                        <div class="header-cart-total w-full p-tb-40">
                            Total: $ {{ number_format($total, 2) }}
                        </div>

                        <div class="header-cart-buttons flex-w w-full">
                            <a href="{{route('front.cart.index')}}"
                                class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                                View Cart
                            </a>

                            <a href="shoping-cart.html"
                                class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
                                Check Out
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>




    </div>
</div>