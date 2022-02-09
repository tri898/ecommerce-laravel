@extends('layouts.front.main')

@section('title', 'Change password')

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
            <a href="{{ route('user.profile.index') }}" class="stext-109 cl8 hov-cl1 trans-04">
                Profile
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>
            <span class="stext-109 cl4">
                Change Password
            </span>
        </div>
    </div>

    <!-- Information -->
    <section class="bg0 p-t-80 p-b-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-xl-7 m-lr-auto m-b-25 bor10 p-tb-25 p-lr-20">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <!-- Add review -->
                    <form id="password-form" class="w-full" action="{{route('user.password.change')}}" method="POST">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <div class="row p-b-25 p-lr-20">
                            <div class="col-12 p-tb-10">
                                <label class="stext-102 cl3" for="address">Current password</label>
                                <input class="size-111 bor8 stext-102 cl2 p-lr-20 password" id="current_password"
                                    type="password" name="current_password" value="{{ old('current_password')}}"
                                    autocomplete="on">
                            </div>
                            <div class="col-12 p-tb-10">
                                <label class="stext-102 cl3" for="address">New password</label>
                                <input class="size-111 bor8 stext-102 cl2 p-lr-20 password" id="new_password"
                                    type="password" name="new_password" value="{{ old('new_password')}}"
                                    autocomplete="on">
                            </div>
                            <div class="col-12 p-t-10">
                                <label class="stext-102 cl3" for="address">New password confirmation</label>
                                <input class="size-111 bor8 stext-102 cl2 p-lr-20 password"
                                    id="new_password_confirmation" type="password" name="new_password_confirmation"
                                    value="{{ old('new_password_confirmation')}}" autocomplete="on">
                            </div>
                        </div>
                        <div class="p-lr-20 p-lr-20-sm">
                            <input id="showPass" type="checkbox" onclick="myPassword()">
                            <label class="stext-102 cl3" for="showPass">Show password</label>
                        </div>

                        <div class="flex-w flex-r p-lr-20 p-lr-15-sm">
                            <button class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
                                Change password
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
<script>
function myPassword() {
    var x = $('.password').each(function(key, value) {
        if (value.type === "password") {
            value.type = "text";
        } else {
            value.type = "password";
        }
    });
}
</script>
<!--===============================================================================================-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script>
$(document).ready(function() {
    $('#password-form').validate({
        rules: {
            current_password: {
                required: true,
                minlength: 6
            },
            new_password: {
                required: true,
                minlength: 6
            },
            new_password_confirmation: {
                required: true,
                minlength: 6,
                equalTo: "#new_password"
            }
        },
        messages: {
            current_password: {
                required: "Please enter current password."
            },
            new_password: {
                required: "Please enter new password."
            },
            new_password_confirmation: {
                required: "Please enter new password confirmation.",
                equalTo: "Please enter the same new password."
            }
        }
    });
});
</script>
</script>
@endsection