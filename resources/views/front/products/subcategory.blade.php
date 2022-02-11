@extends('layouts.front.main')

@section('title', $subcategory->name .' | Products')

@section('vendor_css')
@parent
@endsection
@section('content')
<!-- Product -->
<div class="bg0 m-t-30 p-b-140">
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-50 p-lr-0-lg">
            <a href="{{ route('front.home.index')}}" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>
            <a href="{{ route('front.product.category', $category->slug)}}" class="stext-109 cl8 hov-cl1 trans-04">
                {{ $category->name}}
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>
            <span class="stext-109 cl4">
                {{ $subcategory->name}}
            </span>
        </div>
        <div class="flex-w flex-r p-b-52">

            <div class="flex-w flex-c-m m-tb-10">
                <div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
                    <i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
                    <i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                    Filter
                </div>

            </div>

            <!-- Filter -->
            <div class="dis-none panel-filter w-full p-t-10">
                <div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
                    <div class="filter-col1 p-r-15 p-b-27">
                        <div class="mtext-102 cl2 p-b-15">
                            Sort By
                        </div>

                        <ul>
                            <li class="p-b-6">
                                <input type="radio" id="default" class="selector sort" name="sort" value="default">
                                <label for="default" class="filter-link stext-106 trans-04">
                                    Default</label>
                            </li>

                            <li class="p-b-6">
                                <input type="radio" id="azSort" class="selector sort" name="sort" value="azSort">
                                <label for="azSort" class="filter-link stext-106 trans-04">
                                    Name: A-Z</label>
                            </li>

                            <li class="p-b-6">
                                <input type="radio" id="zaSort" class="selector sort" name="sort" value="zaSort">
                                <label for="zaSort" class="filter-link stext-106 trans-04">
                                    Name: Z-A</label>
                            </li>

                            <li class="p-b-6">
                                <input type="radio" id="hPrice" class="selector sort" name="sort" value="hPrice">
                                <label for="hPrice" class="filter-link stext-106 trans-04">
                                    Price: High to Low</label>
                            </li>

                            <li class="p-b-6">
                                <input type="radio" id="lPrice" class="selector sort" name="sort" value="lPrice">
                                <label for="lPrice" class="filter-link stext-106 trans-04">
                                    Price: Low to High</label>
                            </li>
                        </ul>
                    </div>

                    <div class="filter-col2 p-r-15 p-b-27">
                        <div class="mtext-102 cl2 p-b-15">
                            Price
                        </div>

                        <ul>
                            <li class="p-b-6">
                                <input type="radio" id="0-9999" class="selector price" name="price" value="0-9999">
                                <label for="0-9999" class="filter-link stext-106 trans-04">
                                    All</label>
                            </li>

                            <li class="p-b-6">
                                <input type="radio" id="0-50" class="selector price" name="price" value="0-50">
                                <label for="0-50" class="filter-link stext-106 trans-04">
                                    $0.00 - $50.00</label>
                                <a href="#" class="filter-link stext-106 trans-04">

                                </a>
                            </li>

                            <li class="p-b-6">
                                <input type="radio" id="50-100" class="selector price" name="price" value="50-100">
                                <label for="50-100" class="filter-link stext-106 trans-04">
                                    $50.00 - $100.00</label>
                            </li>

                            <li class="p-b-6">
                                <input type="radio" id="100-150" class="selector price" name="price" value="100-150">
                                <label for="100-150" class="filter-link stext-106 trans-04">
                                    $100.00 - $150.00</label>
                            </li>

                            <li class="p-b-6">
                                <input type="radio" id="150-200" class="selector price" name="price" value="150-200">
                                <label for="150-200" class="filter-link stext-106 trans-04">
                                    $150.00 - $200.00</label>
                            </li>

                            <li class="p-b-6">
                                <input type="radio" id="200-9999" class="selector price" name="price" value="200-9999">
                                <label for="200-9999" class="filter-link stext-106 trans-04">
                                    $200.00+</label>
                            </li>
                        </ul>
                    </div>

                    <div class="filter-col3 p-r-15 p-b-27">
                        <div class="mtext-102 cl2 p-b-15">
                            Color
                        </div>

                        <ul>
                            <li class="p-b-6">
                                <input type="checkbox" id="black" class="selector colors" name="color" value="Black">
                                <label for="black" class="filter-link stext-106 trans-04">
                                    Black</label>
                            </li>

                            <li class="p-b-6">
                                <input type="checkbox" id="blue" class="selector colors" name="color" value="Blue">
                                <label for="blue" class="filter-link stext-106 trans-04">
                                    Blue</label>
                            </li>
                            </li>

                            <li class="p-b-6">
                                <input type="checkbox" id="grey" class="selector colors" name="color" value="Grey">
                                <label for="grey" class="filter-link stext-106 trans-04">
                                    Grey</label>
                            </li>

                            <li class="p-b-6">
                                <input type="checkbox" id="green" class="selector colors" name="color" value="Green">
                                <label for="green" class="filter-link stext-106 trans-04">
                                    Green</label>
                            </li>

                            <li class="p-b-6">
                                <input type="checkbox" id="red" class="selector colors" name="color" value="Red">
                                <label for="red" class="filter-link stext-106 trans-04">
                                    Red</label>
                            </li>

                            <li class="p-b-6">
                                <input type="checkbox" id="white" class="selector colors" name="color" value="White">
                                <label for="white" class="filter-link stext-106 trans-04">
                                    White</label>
                            </li>
                        </ul>
                    </div>

                    <div class="filter-col4 p-b-27">
                        <div class="mtext-102 cl2 p-b-15">
                            Tags
                        </div>
                        <div class="flex-w p-t-4 m-r--5">
                            <a href="#"
                                class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                                Fashion
                            </a>

                            <a href="#"
                                class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                                Lifestyle
                            </a>

                            <a href="#"
                                class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                                Denim
                            </a>

                            <a href="#"
                                class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                                Streetstyle
                            </a>

                            <a href="#"
                                class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                                Crafts
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="data-list"></div>
    </div>
</div>
@endsection
@section('script')
@parent
<!--===============================================================================================-->
<script>
$(document).ready(function() {

    loadData();

    function loadData() {

        // get page
        var urlParams = new URLSearchParams(window.location.search);
        var page = urlParams.get('page') || 1;

        var sort = getClass('sort') || urlParams.get('sort') || 'default';
        var price = getClass('price') || urlParams.get('price');
        var colors = getClasses('colors') || urlParams.get('colors');
        _url = '{{ route('front.product.subcategory',[$category->slug,$subcategory->slug]) }}'+`?page=${page}`;
        $.ajax({
            url: _url,
            type: 'GET',
            data: {
                sort: sort,
                price: price,
                colors: colors
            },
            success: function(response) {
                if (response) {
                    $('#data-list').html(response.data);

                    if (response.filter.sort) {
                        $('#' + response.filter.sort).prop('checked', true);
                    }
                    if (response.filter.price) {
                        $('#' + response.filter.price).prop('checked', true);
                    }
                    if (response.filter.colors) {
                        var colorsChecked = response.filter.colors.split(',');
                        $.each(colorsChecked, function(key, value) {
                            $('#' + value.toLowerCase()).prop('checked', true);
                        });
                    }
                    history.pushState(null, null, decodeQueryParam(response.url));
                }
            }
        });
    }
    // get class
    function getClass(className) {
        var result = $('.' + className + ':checked').val();
        return result;
    }
    // get classes
    function getClasses(className) {
        var result = [];
        $('.' + className + ':checked').each(function() {
            result.push($(this).val());
        });
        return result.join(',');
    }
    // selector
    $('.selector').click(function() {
        var colors = getClasses('colors');

        if (!colors) {
            history.pushState(null, null, '/subcategory?colors=&page=&price=&sort=');
        }
        loadData();
    });

    function decodeQueryParam(p) {
        return decodeURIComponent(p.replace(/\+/g, ' '));
    }
});
</script>
@endsection