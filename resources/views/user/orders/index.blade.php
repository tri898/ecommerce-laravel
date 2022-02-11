@extends('layouts.front.main')

@section('title', 'My orders')

@section('vendor_css')
@parent
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
            @foreach ($orders as $order)
            <div class="row">
                <div class="col-lg-10 col-xl-10 m-lr-auto m-b-25 bor10">
                    <div class="flex-w flex-sb-m bor12 p-t-18 p-b-15 p-lr-25 p-lr-15-sm">
                        <span class="mtext-107 cl2 p-lr-20">
                            ID: #{{ $order->id}}
                        </span>
                        <span class="mtext-102 cl2 p-lr-20">
                            @if ($order->status == 0)
                            Cancelled by you
                            @elseif ($order->status == 1)
                            Pending
                            @elseif ($order->status == 2)
                            Confirmed
                            @elseif ($order->status == 3)
                            Delivery
                            @elseif ($order->status == 4)
                            Completed
                            @else
                            Cancelled by admin
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
@parent
@endsection