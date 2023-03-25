@extends('layouts.back-end.app-seller')

@section('title', \App\CPU\translate('Dashboard'))

@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .grid-card {
            border: 2px solid #00000012;
            border-radius: 10px;
            padding: 10px;
        }

        .label_1 {
            /*position: absolute;*/
            font-size: 10px;
            background: #FF4C29;
            color: #ffffff;
            width: 80px;
            padding: 2px;
            font-weight: bold;
            border-radius: 6px;
            text-align: center;
        }

        .center-div {
            text-align: center;
            border-radius: 6px;
            padding: 6px;
            border: 2px solid #8080805e;
        }
    </style>
@endpush

@section('content')

    <div class="content container-fluid">
        <!-- Page Heading -->
        <div class="page-header pb-0" style="border-bottom: 0!important">
            <div class="flex-between row align-items-center mx-1">
                <h1 class="page-header-title">{{ \App\CPU\translate('Dashboard') }}</h1>

                <div>
                    <a class="btn btn-primary" href="{{ route('seller.product.list') }}">
                        <i class="tio-premium-outlined mr-1"></i> {{ \App\CPU\translate('Products') }}
                    </a>
                </div>
            </div>
        </div>

        @php

            $seller = App\Model\Seller::find(auth('seller')->id());

        @endphp
        @if (isset($seller) && $seller['status'] == 'approved')
            <div class="card mb-3">
                <div class="card-body">
                    <div class="flex-between row gx-2 gx-lg-3 mb-2">
                        <div style="{{ Session::get('direction') === 'rtl' ? 'margin-right:2px' : '' }};">
                            <h4><i style="font-size: 30px"
                                    class="tio-chart-bar-4"></i>{{ \App\CPU\translate('dashboard_order_statistics') }}</h4>
                        </div>
                        <div style="width: 20vw">
                            <select class="custom-select" name="statistics_type" onchange="order_stats_update(this.value)">
                                <option value="overall"
                                    {{ session()->has('statistics_type') && session('statistics_type') == 'overall' ? 'selected' : '' }}>
                                    {{ \App\CPU\translate('Overall Statistics') }}
                                </option>
                                <option value="today"
                                    {{ session()->has('statistics_type') && session('statistics_type') == 'today' ? 'selected' : '' }}>
                                    {{ \App\CPU\translate('Todays Statistics') }}
                                </option>
                                <option value="this_month"
                                    {{ session()->has('statistics_type') && session('statistics_type') == 'this_month' ? 'selected' : '' }}>
                                    {{ \App\CPU\translate('This Months Statistics') }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="row gx-2 gx-lg-3" id="order_stats">
                        @include('seller-views.partials._dashboard-order-stats', ['data' => $data])
                    </div>
                </div>
            </div>


            <div class="card mb-3">
                <div class="card-body">
                    <div class="row gx-2 gx-lg-3" id="order_stats">

                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow h-100" href="#" style="background: #3E215D">
                                <div class="card-body">
                                    <div class="flex-between align-items-center mb-1">
                                        <div
                                            style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
                                            <h6 class="card-subtitle" style="color: white!important;">Pending Orders</h6>
                                            <span class="card-title h2" style="color: white!important;">
                                                0
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <i class="tio-shopping-cart" style="font-size: 30px;color: white"></i>
                                        </div>
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>
                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow h-100" href="#" style="background: #006666">
                                <div class="card-body">
                                    <div class="flex-between align-items-center mb-1">
                                        <div
                                            style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
                                            <h6 class="card-subtitle" style="color: white!important;">Ready To Ship</h6>
                                            <span class="card-title h2" style="color: white!important;">
                                                0
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <i class="tio-shopping-cart" style="font-size: 30px;color: white"></i>
                                        </div>
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>
                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow h-100" href="#" style="background: #669999">
                                <div class="card-body">
                                    <div class="flex-between align-items-center mb-1">
                                        <div
                                            style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
                                            <h6 class="card-subtitle" style="color: white!important;">Pending Return</h6>
                                            <span class="card-title h2" style="color: white!important;">
                                                0
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <i class="tio-shopping-cart" style="font-size: 30px;color: white"></i>
                                        </div>
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>
                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow h-100" href="#" style="background: #339966">
                                <div class="card-body">
                                    <div class="flex-between align-items-center mb-1">
                                        <div
                                            style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
                                            <h6 class="card-subtitle" style="color: white!important;">new reviews</h6>
                                            <span class="card-title h2" style="color: white!important;">
                                                0
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <i class="tio-shopping-cart" style="font-size: 30px;color: white"></i>
                                        </div>
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>
                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow h-100" href="#" style="background: #339933">
                                <div class="card-body">
                                    <div class="flex-between align-items-center mb-1">
                                        <div
                                            style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
                                            <h6 class="card-subtitle" style="color: white!important;">new products</h6>
                                            <span class="card-title h2" style="color: white!important;">
                                                0
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <i class="tio-shopping-cart" style="font-size: 30px;color: white"></i>
                                        </div>
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>
                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow h-100" href="#" style="background: #006600">
                                <div class="card-body">
                                    <div class="flex-between align-items-center mb-1">
                                        <div
                                            style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
                                            <h6 class="card-subtitle" style="color: white!important;">pending approval
                                            </h6>
                                            <span class="card-title h2" style="color: white!important;">
                                                0
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <i class="tio-shopping-cart" style="font-size: 30px;color: white"></i>
                                        </div>
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>
                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow h-100" href="#" style="background: #003300">
                                <div class="card-body">
                                    <div class="flex-between align-items-center mb-1">
                                        <div
                                            style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
                                            <h6 class="card-subtitle" style="color: white!important;">online</h6>
                                            <span class="card-title h2" style="color: white!important;">
                                                0
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <i class="tio-shopping-cart" style="font-size: 30px;color: white"></i>
                                        </div>
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>
                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow h-100" href="#" style="background: #336600">
                                <div class="card-body">
                                    <div class="flex-between align-items-center mb-1">
                                        <div
                                            style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
                                            <h6 class="card-subtitle" style="color: white!important;">out of stock</h6>
                                            <span class="card-title h2" style="color: white!important;">
                                                0
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <i class="tio-shopping-cart" style="font-size: 30px;color: white"></i>
                                        </div>
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>
                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow h-100" href="#" style="background: #333300">
                                <div class="card-body">
                                    <div class="flex-between align-items-center mb-1">
                                        <div
                                            style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
                                            <h6 class="card-subtitle" style="color: white!important;">rejected</h6>
                                            <span class="card-title h2" style="color: white!important;">
                                                0
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <i class="tio-shopping-cart" style="font-size: 30px;color: white"></i>
                                        </div>
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>
                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow h-100" href="#" style="background: #666633">
                                <div class="card-body">
                                    <div class="flex-between align-items-center mb-1">
                                        <div
                                            style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
                                            <h6 class="card-subtitle" style="color: white!important;">pending orders</h6>
                                            <span class="card-title h2" style="color: white!important;">
                                                0
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <i class="tio-shopping-cart" style="font-size: 30px;color: white"></i>
                                        </div>
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>
                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow h-100" href="#" style="background: #999966">
                                <div class="card-body">
                                    <div class="flex-between align-items-center mb-1">
                                        <div
                                            style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
                                            <h6 class="card-subtitle" style="color: white!important;">since > 24h</h6>
                                            <span class="card-title h2" style="color: white!important;">
                                                0
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <i class="tio-shopping-cart" style="font-size: 30px;color: white"></i>
                                        </div>
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>
                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow h-100" href="#" style="background: #996633">
                                <div class="card-body">
                                    <div class="flex-between align-items-center mb-1">
                                        <div
                                            style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
                                            <h6 class="card-subtitle" style="color: white!important;">since 12-24h</h6>
                                            <span class="card-title h2" style="color: white!important;">
                                                0
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <i class="tio-shopping-cart" style="font-size: 30px;color: white"></i>
                                        </div>
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>
                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow h-100" href="#" style="background: #663300">
                                <div class="card-body">
                                    <div class="flex-between align-items-center mb-1">
                                        <div
                                            style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
                                            <h6 class="card-subtitle" style="color: white!important;">since < 12h</h6>
                                                    <span class="card-title h2" style="color: white!important;">
                                                        0
                                                    </span>
                                        </div>
                                        <div class="mt-2">
                                            <i class="tio-shopping-cart" style="font-size: 30px;color: white"></i>
                                        </div>
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>
                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow h-100" href="#" style="background: #996600">
                                <div class="card-body">
                                    <div class="flex-between align-items-center mb-1">
                                        <div
                                            style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
                                            <h6 class="card-subtitle" style="color: white!important;">customar returns
                                            </h6>
                                            <span class="card-title h2" style="color: white!important;">
                                                0
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <i class="tio-shopping-cart" style="font-size: 30px;color: white"></i>
                                        </div>
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>
                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow h-100" href="#" style="background: #cc3300">
                                <div class="card-body">
                                    <div class="flex-between align-items-center mb-1">
                                        <div
                                            style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
                                            <h6 class="card-subtitle" style="color: white!important;">buyer initiated
                                                return</h6>
                                            <span class="card-title h2" style="color: white!important;">
                                                0
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <i class="tio-shopping-cart" style="font-size: 30px;color: white"></i>
                                        </div>
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>
                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow h-100" href="#" style="background: #993300">
                                <div class="card-body">
                                    <div class="flex-between align-items-center mb-1">
                                        <div
                                            style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
                                            <h6 class="card-subtitle" style="color: white!important;">pending inspection
                                            </h6>
                                            <span class="card-title h2" style="color: white!important;">
                                                0
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <i class="tio-shopping-cart" style="font-size: 30px;color: white"></i>
                                        </div>
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>
                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow h-100" href="#" style="background: #990000">
                                <div class="card-body">
                                    <div class="flex-between align-items-center mb-1">
                                        <div
                                            style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
                                            <h6 class="card-subtitle" style="color: white!important;">ratings</h6>
                                            <span class="card-title h2" style="color: white!important;">
                                                0
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <i class="tio-shopping-cart" style="font-size: 30px;color: white"></i>
                                        </div>
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>
                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow h-100" href="#" style="background: #993333">
                                <div class="card-body">
                                    <div class="flex-between align-items-center mb-1">
                                        <div
                                            style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
                                            <h6 class="card-subtitle" style="color: white!important;">positive seller
                                                rating</h6>
                                            <span class="card-title h2" style="color: white!important;">
                                                0
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <i class="tio-shopping-cart" style="font-size: 30px;color: white"></i>
                                        </div>
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>
                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow h-100" href="#" style="background: #990099">
                                <div class="card-body">
                                    <div class="flex-between align-items-center mb-1">
                                        <div
                                            style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
                                            <h6 class="card-subtitle" style="color: white!important;">product rating</h6>
                                            <span class="card-title h2" style="color: white!important;">
                                                0
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <i class="tio-shopping-cart" style="font-size: 30px;color: white"></i>
                                        </div>
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>
                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow h-100" href="#" style="background: #993399">
                                <div class="card-body">
                                    <div class="flex-between align-items-center mb-1">
                                        <div
                                            style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
                                            <h6 class="card-subtitle" style="color: white!important;">orders performance
                                            </h6>
                                            <span class="card-title h2" style="color: white!important;">
                                                0
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <i class="tio-shopping-cart" style="font-size: 30px;color: white"></i>
                                        </div>
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>
                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow h-100" href="#" style="background: #660066">
                                <div class="card-body">
                                    <div class="flex-between align-items-center mb-1">
                                        <div
                                            style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
                                            <h6 class="card-subtitle" style="color: white!important;">shipped on time</h6>
                                            <span class="card-title h2" style="color: white!important;">
                                                0
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <i class="tio-shopping-cart" style="font-size: 30px;color: white"></i>
                                        </div>
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>
                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow h-100" href="#" style="background: #9900cc">
                                <div class="card-body">
                                    <div class="flex-between align-items-center mb-1">
                                        <div
                                            style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
                                            <h6 class="card-subtitle" style="color: white!important;">shipped on time</h6>
                                            <span class="card-title h2" style="color: white!important;">
                                                0
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <i class="tio-shopping-cart" style="font-size: 30px;color: white"></i>
                                        </div>
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>
                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow h-100" href="#" style="background: #9900ff">
                                <div class="card-body">
                                    <div class="flex-between align-items-center mb-1">
                                        <div
                                            style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
                                            <h6 class="card-subtitle" style="color: white!important;">cancellation rate
                                            </h6>
                                            <span class="card-title h2" style="color: white!important;">
                                                0
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <i class="tio-shopping-cart" style="font-size: 30px;color: white"></i>
                                        </div>
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>
                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow h-100" href="#" style="background: #6600cc">
                                <div class="card-body">
                                    <div class="flex-between align-items-center mb-1">
                                        <div
                                            style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
                                            <h6 class="card-subtitle" style="color: white!important;">return rate</h6>
                                            <span class="card-title h2" style="color: white!important;">
                                                0
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <i class="tio-shopping-cart" style="font-size: 30px;color: white"></i>
                                        </div>
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>
                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow h-100" href="#" style="background: #666699">
                                <div class="card-body">
                                    <div class="flex-between align-items-center mb-1">
                                        <div
                                            style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
                                            <h6 class="card-subtitle" style="color: white!important;">seller picks</h6>
                                            <span class="card-title h2" style="color: white!important;">
                                                0
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <i class="tio-shopping-cart" style="font-size: 30px;color: white"></i>
                                        </div>
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>
                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow h-100" href="#" style="background: #0000cc">
                                <div class="card-body">
                                    <div class="flex-between align-items-center mb-1">
                                        <div
                                            style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
                                            <h6 class="card-subtitle" style="color: white!important;">quota usage</h6>
                                            <span class="card-title h2" style="color: white!important;">
                                                0
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <i class="tio-shopping-cart" style="font-size: 30px;color: white"></i>
                                        </div>
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>
                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow h-100" href="#" style="background: #3366cc">
                                <div class="card-body">
                                    <div class="flex-between align-items-center mb-1">
                                        <div
                                            style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
                                            <h6 class="card-subtitle" style="color: white!important;">page view</h6>
                                            <span class="card-title h2" style="color: white!important;">
                                                0
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <i class="tio-shopping-cart" style="font-size: 30px;color: white"></i>
                                        </div>
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>
                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow h-100" href="#" style="background: #006699">
                                <div class="card-body">
                                    <div class="flex-between align-items-center mb-1">
                                        <div
                                            style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
                                            <h6 class="card-subtitle" style="color: white!important;">click page view</h6>
                                            <span class="card-title h2" style="color: white!important;">
                                                0
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <i class="tio-shopping-cart" style="font-size: 30px;color: white"></i>
                                        </div>
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>
                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow h-100" href="#" style="background: #009999">
                                <div class="card-body">
                                    <div class="flex-between align-items-center mb-1">
                                        <div
                                            style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
                                            <h6 class="card-subtitle" style="color: white!important;">total sales</h6>
                                            <span class="card-title h2" style="color: white!important;">
                                                0
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <i class="tio-shopping-cart" style="font-size: 30px;color: white"></i>
                                        </div>
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>
                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow h-100" href="#" style="background: #00cc99">
                                <div class="card-body">
                                    <div class="flex-between align-items-center mb-1">
                                        <div
                                            style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
                                            <h6 class="card-subtitle" style="color: white!important;">chat</h6>
                                            <span class="card-title h2" style="color: white!important;">
                                                0
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <i class="tio-shopping-cart" style="font-size: 30px;color: white"></i>
                                        </div>
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>
                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow h-100" href="#" style="background: #00cc66">
                                <div class="card-body">
                                    <div class="flex-between align-items-center mb-1">
                                        <div
                                            style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
                                            <h6 class="card-subtitle" style="color: white!important;">response rate</h6>
                                            <span class="card-title h2" style="color: white!important;">
                                                0
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <i class="tio-shopping-cart" style="font-size: 30px;color: white"></i>
                                        </div>
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>
                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow h-100" href="#" style="background: #009933">
                                <div class="card-body">
                                    <div class="flex-between align-items-center mb-1">
                                        <div
                                            style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
                                            <h6 class="card-subtitle" style="color: white!important;">response time</h6>
                                            <span class="card-title h2" style="color: white!important;">
                                                0
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <i class="tio-shopping-cart" style="font-size: 30px;color: white"></i>
                                        </div>
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>
                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow h-100" href="#" style="background: #009900">
                                <div class="card-body">
                                    <div class="flex-between align-items-center mb-1">
                                        <div
                                            style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
                                            <h6 class="card-subtitle" style="color: white!important;">conversion rate</h6>
                                            <span class="card-title h2" style="color: white!important;">
                                                0
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <i class="tio-shopping-cart" style="font-size: 30px;color: white"></i>
                                        </div>
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>

                        <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                            <!-- Card -->
                            <a class="card card-hover-shadow h-100" href="#" style="background: #669900">
                                <div class="card-body">
                                    <div class="flex-between align-items-center mb-1">
                                        <div
                                            style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
                                            <h6 class="card-subtitle" style="color: white!important;">conversations</h6>
                                            <span class="card-title h2" style="color: white!important;">
                                                0
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <i class="tio-shopping-cart" style="font-size: 30px;color: white"></i>
                                        </div>
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </a>
                            <!-- End Card -->
                        </div>



                    </div>
                </div>
            </div>


            <div class="card mb-3">
                <div class="card-body">
                    <div class="flex-between gx-2 gx-lg-3 mb-2">
                        <div>
                            <h4><i style="font-size: 30px"
                                    class="tio-wallet"></i>{{ \App\CPU\translate('seller_wallet') }}</h4>
                        </div>
                    </div>
                    <div class="row gx-2 gx-lg-3" id="order_stats">
                        @include('seller-views.partials._dashboard-wallet-stats', ['data' => $data])
                    </div>

                    <div class="row">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-6 for-card col-md-6 mt-4">
                            <div class="card for-card-body-2 shadow h-100  badge-primary"
                                style="background: #362222!important;">
                                <div class="card-body text-light">
                                    <div class="flex-between row no-gutters align-items-center">
                                        <div>
                                            <div class="font-weight-bold text-uppercase for-card-text mb-1">
                                                {{ \App\CPU\translate('Withdrawable_balance') }}
                                            </div>
                                            <div class="for-card-count">
                                                {{ \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($data['total_earning'])) }}
                                            </div>
                                        </div>
                                        <div>
                                            <a href="javascript:" style="background: #3A6351!important;"
                                                class="btn btn-primary" data-toggle="modal" data-target="#balance-modal">
                                                <i class="tio-wallet-outlined"></i> {{ \App\CPU\translate('Withdraw') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-6 for-card col-md-6 mt-4" style="cursor: pointer">
                            <div class="card  shadow h-100 for-card-body-3 badge-info"
                                style="background: #171010!important;">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class=" font-weight-bold for-card-text text-uppercase mb-1">
                                                {{ \App\CPU\translate('withdrawn') }}</div>
                                            <div class="for-card-count">
                                                {{ \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($data['withdrawn'])) }}
                                            </div>
                                        </div>
                                        <div class="col-auto for-margin">
                                            <i class="tio-money-vs"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Stats -->

            <div class="modal fade" id="balance-modal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content"
                        style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{ \App\CPU\translate('Withdraw Request') }}
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('seller.withdraw.request') }}" method="post">
                            <div class="modal-body">
                                @csrf
                                <div class="form-group">
                                    <label for="recipient-name"
                                        class="col-form-label">{{ \App\CPU\translate('Amount') }}:</label>
                                    <input type="number" name="amount" step=".01"
                                        value="{{ \App\CPU\BackEndHelper::usd_to_currency($data['total_earning']) }}"
                                        class="form-control" id="">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">{{ \App\CPU\translate('Close') }}</button>
                                @if (auth('seller')->user()->account_no == null || auth('seller')->user()->bank_name == null)
                                    <button type="button" class="btn btn-primary" onclick="call_duty()">
                                        {{ \App\CPU\translate('Incomplete bank info') }}
                                    </button>
                                @else
                                    <button type="submit"
                                        class="btn btn-primary">{{ \App\CPU\translate('Request') }}</button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row gx-2 gx-lg-3">
                <div class="col-lg-12 mb-3 mb-lg-12">
                    <!-- Card -->
                    <div class="card h-100">
                        <!-- Body -->
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-12 mb-3 border-bottom">
                                    <h5 class="card-header-title float-left mb-2">
                                        <i style="font-size: 30px" class="tio-chart-pie-1"></i>
                                        {{ \App\CPU\translate('Earning statistics for business analytics') }}
                                    </h5>
                                    <!-- Legend Indicators -->
                                    <h5 class="card-header-title float-right mb-2">
                                        {{ \App\CPU\translate('This Year Earning') }}
                                        <i style="font-size: 30px" class="tio-chart-bar-2"></i>
                                    </h5>
                                    <!-- End Legend Indicators -->
                                </div>
                                <div class="col-6 graph-border-1">
                                    <div class="mt-2 center-div">
                                        <span class="h6 mb-0">
                                            <i class="legend-indicator bg-success"
                                                style="background-color: #B6C867!important;"></i>
                                            {{ \App\CPU\translate('Your Earnings') }} :
                                            {{ \App\CPU\BackEndHelper::usd_to_currency(array_sum($seller_data)) . ' ' . \App\CPU\BackEndHelper::currency_symbol() }}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-6 graph-border-1">
                                    <div class="mt-2 center-div">
                                        <span class="h6 mb-0">
                                            <i class="legend-indicator bg-danger"
                                                style="background-color: #01937C!important;"></i>
                                            {{ \App\CPU\translate('Commission Given') }} :
                                            {{ \App\CPU\BackEndHelper::usd_to_currency(array_sum($commission_data)) . ' ' . \App\CPU\BackEndHelper::currency_symbol() }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <!-- End Row -->

                            <!-- Bar Chart -->
                            <div class="chartjs-custom">
                                <canvas id="updatingData" style="height: 20rem;"
                                    data-hs-chartjs-options='{
                            "type": "bar",
                            "data": {
                              "labels": ["Jan","Feb","Mar","April","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],
                              "datasets": [{
                                "data": [{{ $seller_data[1] }},{{ $seller_data[2] }},{{ $seller_data[3] }},{{ $seller_data[4] }},{{ $seller_data[5] }},{{ $seller_data[6] }},{{ $seller_data[7] }},{{ $seller_data[8] }},{{ $seller_data[9] }},{{ $seller_data[10] }},{{ $seller_data[11] }},{{ $seller_data[12] }}],
                                "backgroundColor": "#B6C867",
                                "borderColor": "#B6C867"
                              },
                              {
                                "data": [{{ $commission_data[1] }},{{ $commission_data[2] }},{{ $commission_data[3] }},{{ $commission_data[4] }},{{ $commission_data[5] }},{{ $commission_data[6] }},{{ $commission_data[7] }},{{ $commission_data[8] }},{{ $commission_data[9] }},{{ $commission_data[10] }},{{ $commission_data[11] }},{{ $commission_data[12] }}],
                                "backgroundColor": "#01937C",
                                "borderColor": "#01937C"
                              }]
                            },
                            "options": {
                              "scales": {
                                "yAxes": [{
                                  "gridLines": {
                                    "color": "#e7eaf3",
                                    "drawBorder": false,
                                    "zeroLineColor": "#e7eaf3"
                                  },
                                  "ticks": {
                                    "beginAtZero": true,
                                    "stepSize": 50000,
                                    "fontSize": 12,
                                    "fontColor": "#97a4af",
                                    "fontFamily": "Open Sans, sans-serif",
                                    "padding": 10,
                                    "postfix": " {{ \App\CPU\BackEndHelper::currency_symbol() }}"
                                  }
                                }],
                                "xAxes": [{
                                  "gridLines": {
                                    "display": false,
                                    "drawBorder": false
                                  },
                                  "ticks": {
                                    "fontSize": 12,
                                    "fontColor": "#97a4af",
                                    "fontFamily": "Open Sans, sans-serif",
                                    "padding": 5
                                  },
                                  "categoryPercentage": 0.5,
                                  "maxBarThickness": "10"
                                }]
                              },
                              "cornerRadius": 2,
                              "tooltips": {
                                "prefix": " ",
                                "hasIndicator": true,
                                "mode": "index",
                                "intersect": false
                              },
                              "hover": {
                                "mode": "nearest",
                                "intersect": true
                              }
                            }
                          }'></canvas>
                            </div>
                            <!-- End Bar Chart -->
                        </div>
                        <!-- End Body -->
                    </div>
                    <!-- End Card -->
                </div>

                <div class="col-lg-6 mt-3">
                    <!-- Card -->
                    <div class="card h-100">
                        @include('seller-views.partials._top-selling-products', [
                            'top_sell' => $data['top_sell'],
                        ])
                    </div>
                    <!-- End Card -->
                </div>

                <div class="col-lg-6 mt-3">
                    <!-- Card -->
                    <div class="card h-100">
                        @include('seller-views.partials._most-rated-products', [
                            'most_rated_products' => $data['most_rated_products'],
                        ])
                    </div>
                    <!-- End Card -->
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="card">
                        <div class="card-body">
                            <p>Seller ID : <span class="bg bg-info p-2 text-white">{{ $seller->selleruid }}</span> </p>
                            <p>Account Status : <span class="btn btn-danger btn-sm">Pending</span> </p>
                            <h3>Please update your profile</h3>

                            <a href="{{ route('seller.shop.view') }}" class="btn btn-primary">Click here</a>
                        </div>
                    </div>

                </div>
            </div>
        @endif
    </div>

@endsection

@push('script')
    <script src="{{ asset('public/assets/back-end') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('public/assets/back-end') }}/vendor/chart.js.extensions/chartjs-extensions.js"></script>
    <script
        src="{{ asset('public/assets/back-end') }}/vendor/chartjs-plugin-datalabels/dist/chartjs-plugin-datalabels.min.js">
    </script>
@endpush

@push('script_2')
    <script>
        // INITIALIZATION OF CHARTJS
        // =======================================================
        Chart.plugins.unregister(ChartDataLabels);

        $('.js-chart').each(function() {
            $.HSCore.components.HSChartJS.init($(this));
        });

        var updatingChart = $.HSCore.components.HSChartJS.init($('#updatingData'));
    </script>

    <script>
        function call_duty() {
            toastr.warning('{{ \App\CPU\translate('Update your bank info first!') }}',
                '{{ \App\CPU\translate('Warning') }}!', {
                    CloseButton: true,
                    ProgressBar: true
                });
        }
    </script>

    <script>
        function order_stats_update(type) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '{{ route('seller.dashboard.order-stats') }}',
                data: {
                    statistics_type: type
                },
                beforeSend: function() {
                    $('#loading').show()
                },
                success: function(data) {
                    $('#order_stats').html(data.view)
                },
                complete: function() {
                    $('#loading').hide()
                }
            });
        }

        function business_overview_stats_update(type) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '{{ route('admin.dashboard.business-overview') }}',
                data: {
                    business_overview: type
                },
                beforeSend: function() {
                    $('#loading').show()
                },
                success: function(data) {
                    console.log(data.view)
                    $('#business-overview-board').html(data.view)
                },
                complete: function() {
                    $('#loading').hide()
                }
            });
        }
    </script>
@endpush
