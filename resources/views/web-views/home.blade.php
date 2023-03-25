@extends('layouts.front-end.app')

@section('title', \App\CPU\translate('Online Shopping in Bangladesh -') . ' ' . $web_config['name']->value)

@push('css_or_js')
    <meta name='description'
          content="Nillgiri is a Bangladeshi Ecommerce marketplace, Nillgiri Launched in 1 may 2022. Nillgiri has been running since 1 June 2022. Nillgiri has started the journey with 4 partners. Nillgiri is a multitevender ecommerce company. All legal products can be traded here." />
    <meta name='keywords'
          content='Nillgiri is a Bangladeshi Ecommerce marketplace, Nillgiri Launched in 1 may 2022. Nillgiri has been running since 1 June 2022. Nillgiri has started the journey with 4 partners. Nillgiri is a multitevender ecommerce company. All legal products can be traded here.' />
    <meta property="og:url" content="https://www.nillgiri.com" />
    <meta property="og:type"
          content="Nillgiri is a Bangladeshi Ecommerce marketplace, Nillgiri Launched in 1 may 2022. Nillgiri has been running since 1 June 2022. Nillgiri has started the journey with 4 partners. Nillgiri is a multitevender ecommerce company. All legal products can be traded here." />
    <meta property="og:title" content="Welcome to nillgiri" />
    <meta property="og:description"
          content="Nillgiri is a Bangladeshi Ecommerce marketplace, Nillgiri Launched in 1 may 2022. Nillgiri has been running since 1 June 2022. Nillgiri has started the journey with 4 partners. Nillgiri is a multitevender ecommerce company. All legal products can be traded here." />

    <meta property="og:image" content="{{ asset('storage/app/public/company') }}/{{ $web_config['web_logo']->value }}" />
    <meta property="twitter:image"
          content="{{ asset('storage/app/public/company') }}/{{ $web_config['web_logo']->value }}" />
    <meta name="og:image" content="{{ asset('storage/app/public/company') }}/{{ $web_config['web_logo']->value }}" />
    <meta name="twitter:image" content="{{ asset('storage/app/public/company') }}/{{ $web_config['web_logo']->value }}" />
    <meta name="twitter:card" content="{{ asset('storage/app/public/company') }}/{{ $web_config['web_logo']->value }}" />

    <meta name="twitter:title" content="Welcome to nillgiri" />
    <meta name="twitter:site" content="Welcome to nillgiri" />
    <meta property="twitter:url" content="https://www.nillgiri.com">
    <meta name="distribution" content="Global">
    <meta name="Developed By" content="SOFTECH BD LTD" />
    <meta name="Developer" content="SOFTECH BD LTD Team" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="Nillgiri" />

    <link rel="stylesheet" href="{{ asset('public/assets/front-end') }}/css/home.css" />

    <style>
        .media {
            background: white;
            border-radius: 7px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
        }

        .cz-countdown-days {
            color: white !important;
            background-color: {{ $web_config['primary_color'] }};
            padding: 0px 6px;
            border-radius: 3px;
            margin-right: 3px !important;
        }

        .cz-countdown-hours {
            color: white !important;
            background-color: {{ $web_config['primary_color'] }};
            padding: 0px 6px;
            border-radius: 3px;
            margin-right: 3px !important;
        }

        .cz-countdown-minutes {
            color: white !important;
            background-color: {{ $web_config['primary_color'] }};
            padding: 0px 6px;
            border-radius: 3px;
            margin-right: 3px !important;
        }

        .cz-countdown-seconds {
            color: {{ $web_config['primary_color'] }};
            border: 1px solid{{ $web_config['primary_color'] }};
            padding: 0px 6px;
            border-radius: 3px !important;
        }

        .flash_deal_product_details .flash-product-price {
            font-weight: 700;
            font-size: 18px;
            color: {{ $web_config['primary_color'] }};
        }

        .featured_deal_left {
            height: 130px;
            background: {{ $web_config['primary_color'] }} 0% 0% no-repeat padding-box;
            padding: 10px 13px;
            text-align: center;
        }

        .category_div:hover {
            color: {{ $web_config['secondary_color'] }};
        }

        .deal_of_the_day {
            /* filter: grayscale(0.5); */
            opacity: .8;
            background: {{ $web_config['secondary_color'] }};
            border-radius: 3px;
        }

        .deal-title {
            font-size: 12px;

        }

        .for-flash-deal-img img {
            max-width: none;
        }

        .cat-nxt{
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            height: 25px;
            width: 25px;
            line-height: 25px;
            background: #ffffff;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
            border-radius: 50%;
            font-size: 18px;
            display: inline-block;
            border: 1px solid #cccccc;
            text-align: center;
            cursor: pointer !important;
            z-index: 2;
        }
        .cat-nxt:hover{
            background: #000000;
            color: #ffffff;
        }

        .cat-prv{
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            height: 25px;
            width: 25px;
            line-height: 25px;
            background: #ffffff;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
            border-radius: 50%;
            font-size: 18px;
            display: inline-block;
            border: 1px solid #cccccc;
            text-align: center;
            cursor: pointer !important;
            z-index: 2;
        }
        .cat-prv:hover{
            background: #000000;
            color: #ffffff;
        }

        .flashMarginBottom{
            margin-bottom: 30px
        }

        @media (max-width: 375px) {
            .cz-countdown {
                display: flex !important;

            }

            .cz-countdown .cz-countdown-seconds {

                margin-top: -5px !important;
            }

            .for-feature-title {
                font-size: 20px !important;
            }
        }

        @media (max-width: 600px) {
            .flash_deal_title {
                /*font-weight: 600;*/
                /*font-size: 18px;*/
                /*text-transform: uppercase;*/

                font-weight: 700;
                font-size: 25px;
                text-transform: uppercase;
            }

            .cz-countdown .cz-countdown-value {
                font-family: "Roboto", sans-serif;
                font-size: 11px !important;
                font-weight: 700 !important;
            }

            .featured_deal {
                opacity: 1 !important;
            }

            .cz-countdown {
                display: inline-block;
                flex-wrap: wrap;
                font-weight: normal;
                margin-top: 4px;
                font-size: smaller;
            }

            .view-btn-div-f {
                float: right;
            }

            .view-btn-div {
                float: right;
            }

            .viw-btn-a {
                font-size: 10px;
                font-weight: 600;
            }


            .for-mobile {
                display: none;
            }

            .featured_for_mobile {
                max-width: 100%;
                margin-top: 20px;
                margin-bottom: 20px;
            }
        }

        @media (max-width: 360px) {
            .featured_for_mobile {
                max-width: 100%;
                margin-top: 10px;
                margin-bottom: 10px;
            }

            .featured_deal {
                opacity: 1 !important;
            }
        }

        @media (max-width: 375px) {
            .featured_for_mobile {
                max-width: 100%;
                margin-top: 10px;
                margin-bottom: 10px;
            }

            .featured_deal {
                opacity: 1 !important;
            }
        }

        @media screen and (max-width: 1024px) {
            .flashMarginBottom{
                margin-bottom: 17px;
            }
        }

        @media (min-width: 768px) {
            .displayTab {
                display: block !important;
            }
        }

        @media (max-width: 800px) {
            .for-tab-view-img {
                width: 40%;
            }

            .for-tab-view-img {
                width: 105px;
            }

            .widget-title {
                font-size: 19px !important;
            }
        }

        @media screen and (max-width: 767px) {
            .flashMarginBottom{
                margin-bottom: 0px ;
            }
        }


        .featured_deal_carosel .carousel-inner {
            width: 100% !important;
        }

        .badge-style2 {
            color: black !important;
            background: transparent !important;
            font-size: 11px;
        }

        .rounded-7{
            border-radius: 7px
        }

        img{
            border-radius: 7px;
        }
    </style>

    <link rel="stylesheet" href="{{ asset('public/assets/front-end') }}/css/owl.carousel.min.css" />
    <link rel="stylesheet" href="{{ asset('public/assets/front-end') }}/css/owl.theme.default.min.css" />
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>


@endpush

@section('content')
    <!-- Hero (Banners + Slider)-->
    <section class="bg-transparent">
        <div class="container">
            <div class="row ">
                <div class="col-12">
                    @include('web-views.partials._home-top-slider')
                </div>
            </div>
        </div>
    </section>

    <section class="setionPaddingBottom setionPaddingTop2">
        <div class="container">
            <div class="row rounded-7" style="background: #ffffff; border: 1px solid #ebebeb;">
                <div class="col-3 p-2">
                    <a href="{{ route('nillgiri.mall') }}"
                       class="top-special-menu text-center headerboxicon p-2 clearfix d-sm-flex align-items-center">
                        <img src="{{ asset('public/assets/front-end/img/health_beauty_2.png') }}" alt="Nillgiri Mall">
                        <p>Ovendar Mall</p>
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </a>
                </div>

                @foreach($categories as $key=>$category)
                    @if($key<11)
                        @if($category['id'] === 13)
                            <div class="col-3 p-2">
                                <a href="javascript:void(0)"
                                    class="top-special-menu text-center headerboxicon p-2 clearfix d-sm-flex align-items-center"
                                    onclick="location.href='{{route('fashions',['id'=> $category['id'],'data_from'=>'category','page'=>1])}}'"
                                >
                                    <img src="{{ asset('public/assets/front-end/img/woman.png') }}" alt="Woman">
                                    <p>Fashion</p>
                                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                                </a>
                            </div>
                        @endif
                    @endif
                @endforeach

                @foreach($categories as $key=>$category)
                    @if($key<11)
                        @if($category['id'] === 1)
                            <div class="col-3 p-2">
                                <a href="javascript:void(0)"
                                    class="top-special-menu text-center headerboxicon p-2 clearfix d-sm-flex align-items-center"
                                   onclick="location.href='{{route('products',['id'=> $category['id'],'data_from'=>'category','page'=>1])}}'"
                                >
                                    <img src="{{ asset('public/assets/front-end/img/health_beauty.png') }}" alt="Health & Beauty">
                                    <p>Health & Beauty</p>
                                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                                </a>
                            </div>
                            @endif
                    @endif
                @endforeach


                @php
                    $flash_deals = \App\Model\FlashDeal::with(['products.product'])
                        ->where(['status' => 1])
                        ->where(['deal_type' => 'flash_deal'])
                        ->whereDate('start_date', '<=', date('Y-m-d'))
                        ->whereDate('end_date', '>=', date('Y-m-d'))
                        ->where('id', '3')
                        ->first();
                @endphp

                <div class="col-3 p-2">
                    <a href="{{ route('products', ['data_from' => 'free_shipping']) }}"
                       class="top-special-menu text-center headerboxicon p-2 clearfix d-sm-flex align-items-center">
                        <img src="{{ asset('public/assets/front-end/img/free_delivery.png') }}" alt="Free Delivery">
                        <p>Free Delivery</p>
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </a>
                </div>

            </div>
        </div>
    </section>


    {{-- flash deal --}}
    @php
        $flash_deals = \App\Model\FlashDeal::with(['products.product'])
            ->where(['status' => 1])
            ->where(['deal_type' => 'flash_deal'])
            ->whereDate('start_date', '<=', date('Y-m-d'))
            ->whereDate('end_date', '>=', date('Y-m-d'))
            ->first();
    @endphp

    @if (isset($flash_deals))
        <div class="container">
            <div class="row flashMarginBottom">
                <div class="col-md-12">
                    <div class="row setionPaddingBottom section-header fd rtl mx-0">
                        <div class=""
                             style="padding-{{ Session::get('direction') === 'rtl' ? 'right' : 'left' }}: 0">
                            <div class="d-inline-flex displayTab">
                                <span class="flash_deal_title ">
                                    {{ $flash_deals['title'] }}
                                </span>
                            </div>
                        </div>
                        <div class=""
                             style="padding-{{ Session::get('direction') === 'rtl' ? 'left' : 'right' }}: 0">
                            <div class="row view_all view-btn-div-f float-right mx-0">
                                <div class="{{ Session::get('direction') === 'rtl' ? 'pl-2' : 'pr-2' }}">
                                    <span class="cz-countdown"
                                          data-countdown="{{ isset($flash_deals) ? date('m/d/Y', strtotime($flash_deals['end_date'])) : '' }} 11:59:00 PM">
                                        <span class="cz-countdown-days">
                                            <span class="cz-countdown-value"></span>
                                        </span>
                                        <span class="cz-countdown-value">:</span>
                                        <span class="cz-countdown-hours">
                                            <span class="cz-countdown-value"></span>
                                        </span>
                                        <span class="cz-countdown-value">:</span>
                                        <span class="cz-countdown-minutes">
                                            <span class="cz-countdown-value"></span>
                                        </span>
                                        <span class="cz-countdown-value">:</span>
                                        <span class="cz-countdown-seconds">
                                            <span class="cz-countdown-value"></span>
                                        </span>
                                    </span>
                                </div>
                                <div class="">
                                    <a class="btn btn-outline-accent btn-sm viw-btn-a"
                                       href="{{ route('flash-deals', [isset($flash_deals) ? $flash_deals['id'] : 0]) }}">{{ \App\CPU\translate('view_all') }}
                                        <i
                                            class="czi-arrow-{{ Session::get('direction') === 'rtl' ? 'left mr-1 ml-n1' : 'right ml-1 mr-n1' }}"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="owl-carousel owl-theme" id="flash-deal-slider">
                        @foreach ($flash_deals->products as $key => $deal)
                            @if ($deal->product)
                                @include('web-views.partials._product-card-1', [
                                    'product' => $deal->product,
                                ])
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="container rtl">
        <div class="row">
            <div class="col-md-12 pl-0">
                <div class="section-header">
                    <div class="feature_header setionPaddingBottom">
                        <span class="for-feature-title">{{ \App\CPU\translate('categories') }}</span>
                    </div>
                    <div>
                        <a class="btn btn-outline-accent btn-sm viw-btn-a" href="{{ route('categories') }}">
                            {{ \App\CPU\translate('view_all') }}
                            <i
                                class="czi-arrow-{{ Session::get('direction') === 'rtl' ? 'left mr-1 ml-n1' : 'right ml-1 mr-n1' }}"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-12 pl-0 setionPaddingBottom">
                <div class="card">
                    <div class="card-body" style="position: relative;">
                        <div class="slick-controls">
                            <i class="fa fa-angle-left cat-prv"></i>
                            <i class="fa fa-angle-right cat-nxt"></i>
                        </div>
                        <div class="slick-category-slider">
                            @foreach ($topcategories as $category)
                                <div class="col-6 col-sm-6 col-md-1 pl-0">
                                    <div class="text-center" style="">
                                        <a
                                            href="{{ route('products', ['id' => $category['id'], 'data_from' => 'category', 'page' => 1]) }}" style="display: inline-block; text-align-center;">
                                            <img style="height: 80px; width: 80px; border-radius: 50%; box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;"
                                                 onerror="this.src='{{ asset('public/assets/front-end/img/image-place-holder.png') }}'"
                                                 src="{{ asset("storage/app/public/category/$category->icon") }}"
                                                 alt="{{ $category->name }}">
                                            <p class="text-center small " style="margin-top: 10px">
                                                {{ Str::limit($category->name, 17) }}</p>
                                        </a>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products grid (featured products)-->
        @if (count($featured_products) > 0)
            <section class="rtl">
                <!-- Heading-->
                <div class="section-header setionPaddingBottom">
                    <div class="feature_header">
                        <span class="for-feature-title">{{ \App\CPU\translate('Just for you') }}</span>
                    </div>
                    <div>
                        <a class="btn btn-outline-accent btn-sm viw-btn-a"
                           href="{{ route('products', ['data_from' => 'featured', 'page' => 1]) }}">
                            {{ \App\CPU\translate('view_all') }}
                            <i
                                class="czi-arrow-{{ Session::get('direction') === 'rtl' ? 'left mr-1 ml-n1' : 'right ml-1 mr-n1' }}"></i>
                        </a>
                    </div>
                </div>
            {{-- <hr class="view_border"> --}}
            <!-- Grid-->
                <div class="row setionPaddingBottom">
                    @foreach ($featured_products as $product)
                        <div class="col-xl-2 col-sm-3 col-6" style="margin-bottom: 10px">
                            @include('web-views.partials._single-product', ['product' => $product])
                            {{-- <hr class="d-sm-none"> --}}
                        </div>
                    @endforeach
                </div>
            </section>
        @endif


        {{-- deal of the day --}}
        <div class="rtl">
            <div class="row setionPaddingBottom">
                <div class="col-xl-12 col-md-12">
                    <div class="section-header setionPaddingBottom">
                        <div class="feature_header">
                            <span class="for-feature-title">{{ \App\CPU\translate('latest_products') }}</span>
                        </div>
                        <div>
                            <a class="btn btn-outline-accent btn-sm viw-btn-a"
                               href="{{ route('products', ['data_from' => 'latest']) }}">
                                {{ \App\CPU\translate('view_all') }}
                                <i
                                    class="czi-arrow-{{ Session::get('direction') === 'rtl' ? 'left mr-1 ml-n1' : 'right ml-1 mr-n1' }}"></i>
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        @foreach ($latest_products as $product)
                            <div class="col-xl-2 col-sm-3 col-6 mb-2">
                                @include('web-views.partials._single-product', ['product' => $product])
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>


        {{-- Categorized product --}}
        @foreach ($home_categories as $category)
            <section class="rtl">
                <!-- Heading-->
                <div class="section-header">
                    <div class="feature_header">
                        <span class="for-feature-title">{{ $category['name'] }}</span>
                    </div>
                    <div>
                        <a class="btn btn-outline-accent btn-sm viw-btn-a"
                           href="{{ route('products', ['id' => $category['id'], 'data_from' => 'category', 'page' => 1]) }}">
                            {{ \App\CPU\translate('view_all') }}
                            <i
                                class="czi-arrow-{{ Session::get('direction') === 'rtl' ? 'left mr-1 ml-n1' : 'right ml-1 mr-n1' }}"></i>
                        </a>
                    </div>
                </div>

                <div class="row mt-2 mb-3">
                    @foreach ($category['products'] as $key => $product)
                        <div class="col-xl-2 col-sm-3 col-6" style="margin-bottom: 10px">
                            @include('web-views.partials._single-product', ['product' => $product])
                        </div>
                    @endforeach
                </div>
            </section>
        @endforeach

    <!-- Product widgets-->
        <section class="setionPaddingBottom rtl">
            <div class="row">
                <!-- Bestsellers-->
                <div class="col-12 col-sm-6 col-md-4 pb-0 mb13">
                    <div class="widget">
                        <div class="d-flex justify-content-between">
                            <h3 class="widget-title">{{ \App\CPU\translate('best_sellings') }}</h3>
                            <div>
                                <a class="btn btn-outline-accent btn-sm"
                                   href="{{ route('products', ['data_from' => 'best-selling', 'page' => 1]) }}">{{ \App\CPU\translate('view_all') }}
                                    <i
                                        class="czi-arrow-{{ Session::get('direction') === 'rtl' ? 'left mr-1 ml-n1' : 'right ml-1 mr-n1' }}"></i>
                                </a>
                            </div>
                        </div>
                        @foreach ($bestSellProduct as $key => $bestSell)
                            @if ($bestSell->product && $key < 4)
                                <div class="media align-items-center p-2 mb-2"
                                     data-href="{{ route('product', $bestSell->product->slug) }}">
                                    <a class="d-block {{ Session::get('direction') === 'rtl' ? 'ml-2' : 'mr-2' }}"
                                       href="{{ route('product', $bestSell->product->slug) }}">
                                        <img style="height: 64px; width: 54px"
                                             onerror="this.src='{{ asset('public/assets/front-end/img/image-place-holder.png') }}'"
                                             src="{{ \App\CPU\ProductManager::product_image_path('thumbnail') }}/{{ $bestSell->product['thumbnail'] }}"
                                             alt="Product" />
                                    </a>
                                    <div class="media-body">
                                        <h6 class="widget-product-title">
                                            <a class="ptr" href="{{ route('product', $product->slug) }}">
                                                {{ \Illuminate\Support\Str::limit($bestSell->product['name'], 30) }}
                                            </a>
                                        </h6>
                                        <div class="widget-product-meta">
                                            <span class="text-accent">
                                                {{ \App\CPU\Helpers::currency_converter(
                                                    $bestSell->product->unit_price -
                                                        \App\CPU\Helpers::get_product_discount($bestSell->product, $bestSell->product->unit_price),
                                                ) }}

                                                @if ($bestSell->product->discount > 0)
                                                    <strike style="font-size: 12px!important;color: grey!important;">
                                                        {{ \App\CPU\Helpers::currency_converter($bestSell->product->unit_price) }}
                                                    </strike>
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <!-- New arrivals-->
                <div class="col-12 col-sm-6 col-md-4 pb-0 mb13">
                    <div class="widget">
                        <div class="d-flex justify-content-between">
                            <h3 class="widget-title">{{ \App\CPU\translate('new_arrivals') }}</h3>
                            <div>
                                <a class="btn btn-outline-accent btn-sm"
                                   href="{{ route('products', ['data_from' => 'latest', 'page' => 1]) }}">{{ \App\CPU\translate('view_all') }}
                                    <i
                                        class="czi-arrow-{{ Session::get('direction') === 'rtl' ? 'left mr-1 ml-n1' : 'right ml-1 mr-n1' }}"></i>
                                </a>
                            </div>
                        </div>
                        @foreach ($latest_products as $key => $product)
                            @if ($key < 4)
                                <div class="media align-items-center p-2 mb-2"
                                     data-href="{{ route('product', $product->slug) }}">
                                    <a class="d-block {{ Session::get('direction') === 'rtl' ? 'ml-2' : 'mr-2' }}"
                                       href="{{ route('product', $product->slug) }}">
                                        <img style="height: 64px; width: 54px"
                                             onerror="this.src='{{ asset('public/assets/front-end/img/image-place-holder.png') }}'"
                                             src="{{ \App\CPU\ProductManager::product_image_path('thumbnail') }}/{{ $product['thumbnail'] }}"
                                             alt="Product" />
                                    </a>
                                    <div class="media-body">
                                        <h6 class="widget-product-title">
                                            <a class="ptr" href="{{ route('product', $product->slug) }}">
                                                {{ \Illuminate\Support\Str::limit($product['name'], 30) }}
                                            </a>
                                        </h6>
                                        <div class="widget-product-meta">
                                            <span class="text-accent">
                                                {{ \App\CPU\Helpers::currency_converter(
                                                    $product->unit_price - \App\CPU\Helpers::get_product_discount($product, $product->unit_price),
                                                ) }}
                                                @if ($product->discount > 0)
                                                    <strike style="font-size: 12px!important;color: grey!important;">
                                                        {{ \App\CPU\Helpers::currency_converter($product->unit_price) }}
                                                    </strike>
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <!-- Top rated-->
                <div class="col-12 col-sm-6 col-md-4 pb-0 mb13">
                    <div class="widget">
                        <div class="d-flex justify-content-between">
                            <h3 class="widget-title">{{ \App\CPU\translate('top_rated') }}</h3>
                            <div><a class="btn btn-outline-accent btn-sm"
                                    href="{{ route('products', ['data_from' => 'top-rated', 'page' => 1]) }}">{{ \App\CPU\translate('view_all') }}
                                    <i
                                        class="czi-arrow-{{ Session::get('direction') === 'rtl' ? 'left mr-1 ml-n1' : 'right ml-1 mr-n1' }}"></i></a>
                            </div>
                        </div>
                        @foreach ($topRated as $key => $top)
                            @if ($top->product && $key < 4)
                                <div class="media align-items-center p-2 mb-2"
                                     data-href="{{ route('product', $top->product->slug) }}">
                                    <a class="d-block {{ Session::get('direction') === 'rtl' ? 'ml-2' : 'mr-2' }}"
                                       href="{{ route('product', $top->product->slug) }}">
                                        <img style="height: 64px; width: 54px"
                                             onerror="this.src='{{ asset('public/assets/front-end/img/image-place-holder.png') }}'"
                                             src="{{ \App\CPU\ProductManager::product_image_path('thumbnail') }}/{{ $top->product['thumbnail'] }}"
                                             alt="Product" />
                                    </a>
                                    <div class="media-body">
                                        <h6 class="widget-product-title">
                                            <a class="ptr" href="{{ route('product', $top->product->slug) }}">
                                                {{ \Illuminate\Support\Str::limit($top->product['name'], 30) }}
                                            </a>
                                        </h6>
                                        <div class="widget-product-meta">
                                            <span class="text-accent">
                                                {{ \App\CPU\Helpers::currency_converter(
                                                    $top->product->unit_price - \App\CPU\Helpers::get_product_discount($top->product, $top->product->unit_price),
                                                ) }}

                                                @if ($top->product->discount > 0)
                                                    <strike style="font-size: 12px!important;color: grey!important;">
                                                        {{ \App\CPU\Helpers::currency_converter($top->product->unit_price) }}
                                                    </strike>
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <div class="rtl bg-white">
            <div class="row setionPaddingBottom">
                <div class="col-xl-12 col-md-12">
                    <div class="container">
                        <div class="row p-0">
                            <div class="col-3 col-sm-3  col-md-3 pt-4 text-center mobile-padding mt-1 mt-md-0">
                                <img style="height: 29px;" src="{{ asset('public/assets/front-end/png/delivery.png') }}"
                                     alt="">
                                <div class="deal-title">3 {{ \App\CPU\translate('days') }}
                                    <br><span>{{ \App\CPU\translate('free_delivery') }}</span>
                                </div>
                            </div>

                            <div class="col-3 col-sm-3 col-md-3 pt-4 text-center mt-1 mt-md-0">
                                <img style="height: 29px;" src="{{ asset('public/assets/front-end/png/money.png') }}"
                                     alt="">
                                <div class="deal-title">{{ \App\CPU\translate('money_back_guarantee') }}</div>
                            </div>

                            <div class="col-3 col-sm-3 col-md-3 pt-4 text-center mt-1 mt-md-0">
                                <img style="height: 29px;" src="{{ asset('public/assets/front-end/png/Genuine.png') }}"
                                     alt="">
                                <div class="deal-title">100% {{ \App\CPU\translate('genuine') }}
                                    <br><span>{{ \App\CPU\translate('product') }}</span>
                                </div>
                            </div>

                            <div class="col-3 col-sm-3 col-md-3 pt-4 text-center mt-1 mt-md-0">
                                <img style="height: 29px;" src="{{ asset('public/assets/front-end/png/Payment.png') }}"
                                     alt="">
                                <div class="deal-title">{{ \App\CPU\translate('authentic_payment') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        @endsection

        @push('script')
            {{-- Owl Carousel --}}
            <script src="{{ asset('public/assets/front-end') }}/js/owl.carousel.min.js"></script>
            <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>


            <script>
                $('.slick-category-slider').slick({
                    slidesToShow: 10,
                    slidesToScroll: 3,
                    rtl: false,
                    autoplay: true,
                    autoplaySpeed: 2000,
                    dots: false,
                    arrows: true,
                    nextArrow: $('.cat-nxt'),
                    prevArrow: $('.cat-prv'),
                    responsive: [{
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 9,
                            slidesToScroll: 3,
                            infinite: true,
                            dots: false
                        }
                    },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 8,
                                slidesToScroll: 2
                            }
                        },
                        {
                            breakpoint: 576,
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 1
                            }
                        },
                        {
                            breakpoint: 350,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 1
                            }
                        }

                    ]

                });




                $('#flash-deal-slider').owlCarousel({
                    loop: true,
                    autoplay: true,
                    margin: 5,
                    nav: false,
                    //navText: ["<i class='czi-arrow-left'></i>", "<i class='czi-arrow-right'></i>"],
                    dots: true,
                    autoplayHoverPause: true,
                    '{{ session('direction') }}': true,
                    // center: true,
                    responsive: {
                        //X-Small
                        0: {
                            items: 1
                        },
                        360: {
                            items: 1
                        },
                        375: {
                            items: 1
                        },
                        540: {
                            items: 2
                        },
                        //Small
                        576: {
                            items: 2
                        },
                        //Medium
                        768: {
                            items: 3
                        },
                        //Large
                        992: {
                            items: 4
                        },
                        //Extra large
                        1200: {
                            items: 4
                        },
                        //Extra extra large
                        1400: {
                            items: 4
                        }
                    }
                })

                $('#web-feature-deal-slider').owlCarousel({
                    loop: true,
                    autoplay: true,
                    margin: 5,
                    nav: false,
                    //navText: ["<i class='czi-arrow-left'></i>", "<i class='czi-arrow-right'></i>"],
                    dots: true,
                    autoplayHoverPause: true,
                    '{{ session('direction') }}': true,
                    // center: true,
                    responsive: {
                        //X-Small
                        0: {
                            items: 1
                        },
                        360: {
                            items: 1
                        },
                        375: {
                            items: 1
                        },
                        540: {
                            items: 2
                        },
                        //Small
                        576: {
                            items: 2
                        },
                        //Medium
                        768: {
                            items: 2
                        },
                        //Large
                        992: {
                            items: 2
                        },
                        //Extra large
                        1200: {
                            items: 3
                        },
                        //Extra extra large
                        1400: {
                            items: 3
                        }
                    }
                })
            </script>

            <script>
                $('#brands-slider').owlCarousel({
                    loop: false,
                    autoplay: false,
                    margin: 10,
                    nav: false,
                    '{{ session('direction') }}': true,
                    //navText: ["<i class='czi-arrow-left'></i>","<i class='czi-arrow-right'></i>"],
                    dots: true,
                    autoplayHoverPause: true,
                    // center: true,
                    responsive: {
                        //X-Small
                        0: {
                            items: 2
                        },
                        360: {
                            items: 3
                        },
                        375: {
                            items: 3
                        },
                        540: {
                            items: 4
                        },
                        //Small
                        576: {
                            items: 5
                        },
                        //Medium
                        768: {
                            items: 7
                        },
                        //Large
                        992: {
                            items: 9
                        },
                        //Extra large
                        1200: {
                            items: 11
                        },
                        //Extra extra large
                        1400: {
                            items: 12
                        }
                    }
                })
            </script>

            <script>
                $('#category-slider, #top-seller-slider').owlCarousel({
                    loop: false,
                    autoplay: false,
                    margin: 5,
                    nav: false,
                    // navText: ["<i class='czi-arrow-left'></i>","<i class='czi-arrow-right'></i>"],
                    dots: true,
                    autoplayHoverPause: true,
                    '{{ session('direction') }}': true,
                    // center: true,
                    responsive: {
                        //X-Small
                        0: {
                            items: 2
                        },
                        360: {
                            items: 3
                        },
                        375: {
                            items: 3
                        },
                        540: {
                            items: 4
                        },
                        //Small
                        576: {
                            items: 5
                        },
                        //Medium
                        768: {
                            items: 6
                        },
                        //Large
                        992: {
                            items: 8
                        },
                        //Extra large
                        1200: {
                            items: 10
                        },
                        //Extra extra large
                        1400: {
                            items: 11
                        }
                    }
                })




            </script>
    @endpush
