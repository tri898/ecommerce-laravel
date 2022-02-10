@extends('layouts.front.main')

@section('title', 'Profile')

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
                Profile
            </span>
        </div>
    </div>

    <!-- Information -->
    <section class="bg0 p-t-80 p-b-80">
        <div class="container">

            <div class="row">
                <div class="col-lg-10 col-xl-10 m-lr-auto m-b-25 bor10 p-tb-25 p-lr-40">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if(Session::has('success'))
                    <div class="alert alert-success">
                        Updated profile successfully.
                    </div>
                    @endif
                    <!-- Add review -->
                    <form id="profile-form" class="w-full" action="{{route('user.profile.update')}}" method="POST">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <div class="row p-b-25">
                            <div class="col-sm-12 p-b-20">
                                <label class="stext-102 cl3" for="name">Name</label>
                                <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="name" type="text" name="name"
                                    value="{{ old('name', auth()->user()->name) }}">
                            </div>

                            <div class="col-sm-6 p-b-20">
                                <label class="stext-102 cl3" for="email">Email</label>
                                <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="email" type="text" name="email"
                                    value="{{ old('email', auth()->user()->email) }}" disabled>
                            </div>

                            <div class="col-sm-6 p-b-20">
                                <label class="stext-102 cl3" for="phone">Phone</label>
                                <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="phone" type="text" name="phone"
                                    value="{{ old('phone', auth()->user()->phone) }}">
                            </div>

                            <div class="col-12 p-b-20">
                                <label class="stext-102 cl3" for="address">Address</label>
                                <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="address" type="text"
                                    name="address" value="{{ old('address', auth()->user()->address) }}">
                            </div>
                        </div>

                        <div class="flex-w flex-sb-m p-b-10 p-lr-15-sm">
                            <a href="{{route('user.password.index')}}">Change password</a>
                            <button class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
                                Save Changes
                            </button>
                        </div>

                    </form>


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
<!--===============================================================================================-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script>
$(document).ready(function() {
    $('#profile-form').validate({
        rules: {
            name: {
                required: true,
                minlength: 2,
                maxlength: 100
            },
            phone: {
                required: true,
                number: true,
				minlength: 10,
            },
            address: {
                required: true,
                maxlength: 255
            }
        },
        messages: {
            name: {
                required: "Please enter your name."
            },
            phone: {
                required: "Please enter your phone number."
            },
            address: {
                required: "Please enter address."
            }
        }
    });
});
</script>
@endsection