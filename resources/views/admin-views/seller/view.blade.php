@extends('layouts.back-end.app')

@section('title', $seller->shop ? $seller->shop->name : \App\CPU\translate('Shop Name'))

@push('css_or_js')
    <!-- Custom styles for this page -->
    <link href="{{ asset('public/assets/back-end') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="{{ asset('public/assets/back-end/css/croppie.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .application-form .form-control {
            border: 1px solid #cccccc;
        }

        .application-form label {
            color: #575757;
            font-weight: 600;
            font-size: 14px;
        }

        .application-form label span {
            color: red;
        }

        .application-form h4 {
            background: #cccccc;
            font-size: 18px;
            padding: 5px 10px;
            margin: 0;
            border-radius: 3px;
        }
    </style>
@endpush

@section('content')
    <div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a
                        href="{{ route('admin.dashboard.index') }}">{{ \App\CPU\translate('Dashboard') }}</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">{{ \App\CPU\translate('Seller_Details') }}</li>
            </ol>
        </nav>

        <!-- Page Heading -->
        <div class="flex-between d-sm-flex row align-items-center justify-content-between mb-2 mx-1">
            <div>
                <a href="{{ route('admin.sellers.seller-list') }}"
                    class="btn btn-primary mt-3 mb-3">{{ \App\CPU\translate('Back_to_seller_list') }}</a>
            </div>
            <div>
                @if ($seller->status == 'pending')
                    <div class="mt-4 pr-2 float-{{ Session::get('direction') === 'rtl' ? 'left' : 'right' }}">
                        <div class="flex-start">
                            <h4 class="mx-1"><i class="tio-shop-outlined"></i></h4>
                            <div>
                                <h4>{{ \App\CPU\translate('Seller_request_for_open_a_shop.') }}</h4>
                            </div>
                        </div>
                        <div class="text-center">
                            <form class="d-inline-block" action="{{ route('admin.sellers.updateStatus') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $seller->id }}">
                                <input type="hidden" name="status" value="approved">
                                <button type="submit" class="btn btn-primary">{{ \App\CPU\translate('Approve') }}</button>
                            </form>
                            <form class="d-inline-block" action="{{ route('admin.sellers.updateStatus') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $seller->id }}">
                                <input type="hidden" name="status" value="rejected">
                                <button type="submit" class="btn btn-danger">{{ \App\CPU\translate('reject') }}</button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <!-- Page Header -->
        <div class="page-header">
            <div class="flex-between row mx-1">
                <div>
                    <h1 class="page-header-title">{{ $seller->shop ? $seller->shop->name : 'Shop Name : Update Please' }}
                    </h1>
                </div>
            </div>
            <!-- Nav Scroller -->
            <div class="js-nav-scroller hs-nav-scroller-horizontal">
                <!-- Nav -->
                <ul class="nav nav-tabs page-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active"
                            href="{{ route('admin.sellers.view', $seller->id) }}">{{ \App\CPU\translate('Shop') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="{{ route('admin.sellers.view', ['id' => $seller->id, 'tab' => 'order']) }}">{{ \App\CPU\translate('Order') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="{{ route('admin.sellers.view', ['id' => $seller->id, 'tab' => 'product']) }}">{{ \App\CPU\translate('Product') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="{{ route('admin.sellers.view', ['id' => $seller->id, 'tab' => 'setting']) }}">{{ \App\CPU\translate('Setting') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="{{ route('admin.sellers.view', ['id' => $seller->id, 'tab' => 'transaction']) }}">{{ \App\CPU\translate('Transaction') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="{{ route('admin.sellers.view', ['id' => $seller->id, 'tab' => 'review']) }}">{{ \App\CPU\translate('Review') }}</a>
                    </li>

                </ul>
                <!-- End Nav -->
            </div>
            <!-- End Nav Scroller -->
        </div>
        <!-- End Page Header -->
        <div class="card mb-3">
            <div class="card-body">
                <div class=" gx-2 gx-lg-3 mb-2">
                    <div>
                        <h4><i style="font-size: 30px" class="tio-wallet"></i>{{ \App\CPU\translate('seller_wallet') }}
                        </h4>
                    </div>
                    <div class="row gx-2 gx-lg-3" id="order_stats">
                        <div class="flex-between" style="width: 100%">
                            <div class="mb-3 mb-lg-0" style="width: 18%">
                                <div class="card card-body card-hover-shadow h-100 text-white text-center"
                                    style="background-color: #22577A;">
                                    <h1 class="p-2 text-white">
                                        {{ $seller->wallet ? \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($seller->wallet->commission_given)) : 0 }}
                                    </h1>
                                    <div class="text-uppercase">{{ \App\CPU\translate('commission_given') }}</div>
                                </div>
                            </div>

                            <div class="mb-3 mb-lg-0" style="width: 18%">
                                <div class="card card-body card-hover-shadow h-100 text-white text-center"
                                    style="background-color: #595260;">
                                    <h1 class="p-2 text-white">
                                        {{ $seller->wallet ? \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($seller->wallet->pending_withdraw)) : 0 }}
                                    </h1>
                                    <div class="text-uppercase">{{ \App\CPU\translate('pending_withdraw') }}</div>
                                </div>
                            </div>

                            <div class="mb-3 mb-lg-0" style="width: 18%">
                                <div class="card card-body card-hover-shadow h-100 text-white text-center"
                                    style="background-color: #a66f2e;">
                                    <h1 class="p-2 text-white">
                                        {{ $seller->wallet ? \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($seller->wallet->delivery_charge_earned)) : 0 }}
                                    </h1>
                                    <div class="text-uppercase">{{ \App\CPU\translate('delivery_charge_earned') }}</div>
                                </div>
                            </div>

                            <div class="mb-3 mb-lg-0" style="width: 18%">
                                <div class="card card-body card-hover-shadow h-100 text-white text-center"
                                    style="background-color: #6E85B2;">
                                    <h1 class="p-2 text-white">
                                        {{ $seller->wallet ? \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($seller->wallet->collected_cash)) : 0 }}
                                    </h1>
                                    <div class="text-uppercase">{{ \App\CPU\translate('collected_cash') }}</div>
                                </div>
                            </div>

                            <div class="mb-3 mb-lg-0" style="width: 18%">
                                <div class="card card-body card-hover-shadow h-100 text-white text-center"
                                    style="background-color: #6D9886;">
                                    <h1 class="p-2 text-white">
                                        {{ $seller->wallet ? \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($seller->wallet->total_tax_collected)) : 0 }}
                                    </h1>
                                    <div class="text-uppercase">{{ \App\CPU\translate('total_collected_tax') }}</div>
                                </div>
                            </div>
                        </div>
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
                                                {{ $seller->wallet ? \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($seller->wallet->total_earning)) : 0 }}
                                            </div>
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
                                                {{ $seller->wallet ? \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($seller->wallet->withdrawn)) : 0 }}
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
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body application-form">
                        <div class="row">
                            <div class="col-12 text-right   border-bottom">
                                <div class="card-header">
                                    <h1 class="h3 mb-0 ">{{ \App\CPU\translate('Seller Account & Settings') }}</h1>
                                    <a href="{{ route('admin.sellers.shop.edit', [$shop->id]) }}" class="btn btn-primary">Edit Account &
                                        Settings</a>
                                </div>
                            </div>
                            <div class="col-12 py-2">
                                <h4>Seller Account</h4>
                            </div>
                            <div class="col-12 col-md-6 py-2">
                                <label>First Name</label>
                                <h6>{{ $seller->f_name }}</h6>
                            </div>
                            <div class="col-12 col-md-6 py-2">
                                <label>Last Name</label>
                                <h6>{{ $seller->l_name }}</h6>

                            </div>
                            <div class="col-12 col-md-6 py-2">
                                <label>Contact Email address </label>
                                <h6>{{ $seller->email }}</h6>
                            </div>
                            <div class="col-12 col-md-6 py-2">
                                <label>Phone Number</label>
                                <h6>{{ $seller->phone }}</h6>
                            </div>
                            <div class="col-12 col-md-6 py-2">
                                <label>Display Name / Shop Name </label>
                                <h6>{{ $seller->shop_name }}</h6>
                            </div>
                            <div class="col-12 col-md-6 py-2">
                                <div class="d-flex">
                                    <label>Holiday Mode</label>
                                    <div class="ml-4">
                                        <label for="holiday">Yes</label>
                                        <input type="checkbox" value="1" name="holiday_mode" id="holiday"
                                            onclick="handleCheckClick(this)"
                                            {{ $seller->holiday_mode == 1 ? 'checked' : '' }} disabled>
                                    </div>
                                </div>
                                <div class="holiday-input">
                                    <div class="row">
                                        <div class="col-12">
                                            <h6>
                                                @if ($seller->holiday_mode == 1)
                                                    {{ $seller->holiday_mode_period_start }} to
                                                    {{ $seller->holiday_mode_period_end }}
                                                @endif
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($seller->busness_type == 'Business')
                                <div class="col-12 py-2">
                                    <h4>Business Information</h4>
                                </div>
                                <div class="col-12 col-md-6 py-2">
                                    <label>Legal Name / Business Owner</label>
                                    <h6>{{ $shop->owner_name }}</h6>
                                </div>
                                <div class="col-12 col-md-6 py-2">
                                    <label>Busness Type</label>
                                    <h6>
                                        @if ($seller->busness_type == 'Individual')
                                            Individual
                                        @elseif($seller->busness_type == 'Business')
                                            Business
                                        @endif
                                    </h6>

                                </div>
                                <div class="col-12 col-md-6 py-2">
                                    <label>Address </label>
                                    <h6>{{ $shop->address }}</h6>
                                </div>
                                <div class="col-12 col-md-6 py-2">
                                    <label>City / Town </label>
                                    <h6>{{ $seller->city }}</h6>
                                </div>
                                <div class="col-12 col-md-6 py-2">
                                    <label>Country/ Region </label>
                                    <h6>{{ $seller->country }}</h6>
                                </div>
                                <div class="col-12 col-md-6 py-2">
                                    <label>Person in Charge Name</label>
                                    <h6>{{ $seller->in_charge_name }}</h6>
                                </div>
                                <div class="col-12 col-md-6 py-2">
                                    <label>Business Certificate</label>
                                    <h6>
                                        @if ($seller->business_registration_number)
                                            <a href="{{ asset($seller->business_registration_number) }}">Preview</a>
                                        @endif
                                    </h6>
                                </div>
                                <div class="col-12 col-md-6 py-2">
                                    <label>Upload ID Copy - Front Side </label>
                                    <h6>{{ $seller->id_front_side }}</h6>
                                    <img src="{{ asset($seller->id_front_side) }}" alt="image" width="80">
                                </div>
                                <div class="col-12 col-md-6 py-2">
                                    <label>Upload ID Copy - Back Side <span>*</span></label>
                                    <h6>{{ $seller->id_back_side }}</h6>
                                    <img src="{{ asset($seller->id_back_side) }}" alt="image" width="80">
                                </div>
                                <div class="col-12 col-md-6 py-2">
                                    <label>National Identity Card No</label>
                                    <h6>{{ $seller->nid_number }}</h6>

                                </div>
                                <div class="col-12 col-md-6 py-2">
                                    <label>Division</label>
                                    <h6>{{ $seller->division }}</h6>

                                </div>

                                <div class="col-12 col-md-6 py-2">
                                    <label>Postcode</label>
                                    <h6>{{ $seller->postcode }}</h6>
                                </div>

                                <div class="col-12 col-md-6 py-2">
                                    <label>ID Type </label>
                                    <h6>{{ $seller->id_type }}</h6>
                                </div>
                            @endif

                            <div class="col-12 py-2">
                                <h4>Bank Account</h4>
                            </div>
                            <div class="col-12 col-md-6 py-2">
                                <label>Account Type</label>
                                <h6>
                                    @if ($seller->account_type == 'Bkash')
                                        Bkash
                                    @elseif($seller->account_type == 'Bank')
                                        Bank
                                    @endif
                                </h6>

                            </div>

                            @if ($seller->account_type == 'Bkash')
                                <div class="col-12 col-md-6 py-2 bkash">
                                    <label>Person Name</label>
                                    <h6>{{ $seller->bkash_name }}</h6>
                                </div>
                                <div class="col-12 col-md-6 py-2 bkash">
                                    <label>Bkash Number</label>
                                    <h6>{{ $seller->bkash_number }}</h6>
                                </div>
                            @elseif($seller->account_type == 'Bank')
                                <div class="col-12 col-md-6 py-2 bank">
                                    <label>Account Holder Name </label>
                                    <h6>{{ $seller->holder_name }}</h6>
                                </div>
                                <div class="col-12 col-md-6 py-2 bank">
                                    <label>Account Number</label>
                                    <h6>{{ $seller->account_no }}</h6>
                                </div>
                                <div class="col-12 col-md-6 py-2 bank">
                                    <label>Bank Name </label>
                                    <h6>{{ $seller->bank_name }}</h6>
                                </div>

                                <div class="col-12 col-md-6 py-2 bank">
                                    <label>Branch Name </label>
                                    <h6>{{ $seller->branch }}</h6>
                                </div>
                                <div class="col-12 col-md-6 py-2 bank">
                                    <label>Routing Number </label>
                                    <h6>{{ $seller->bank_routing }}</h6>
                                </div>
                                <div class="col-12 col-md-6 py-2 bank">
                                    <label>Upload Cheque Copy </label>
                                    <div>
                                        @if ($seller->cheque_copy)
                                            <a href="{{ $seller->cheque_copy }}">Download</a>
                                        @else
                                        @endif
                                    </div>
                                </div>
                            @endif


                            <div class="col-12 py-2">
                                <h4>Warehouse Address</h4>
                            </div>
                            <div class="col-12 col-md-6 py-2">
                                <label>First and Last Name <span>*</span></label>
                                <h6>{{ $seller->war_full_name }}</h6>
                            </div>
                            <div class="col-12 col-md-6 py-2">
                                <label>Address </label>
                                <h6>{{ $seller->war_address }}</h6>
                            </div>
                            <div class="col-12 col-md-6 py-2">
                                <label>Phone Number</label>
                                <h6>{{ $seller->war_phone }}</h6>
                            </div>
                            <div class="col-12 col-md-6 py-2">
                                <label>City / Town </label>
                                <h6>{{ $seller->war_city_town }}</h6>
                            </div>
                            <div class="col-12 col-md-6 py-2">
                                <label>Country/ Region </label>
                                <h6>{{ $seller->war_country }}</h6>
                            </div>
                            <div class="col-12 col-md-6 py-2">
                                <label>Division </label>
                                <h6>{{ $seller->war_division }}</h6>
                            </div>
                            <div class="col-12 col-md-6 py-2">
                                <label>City </label>
                                <h6>{{ $seller->war_city }}</h6>
                            </div>
                            <div class="col-12 col-md-6 py-2">
                                <label>Postcode </label>
                                <h6>{{ $seller->war_postcode }}</h6>
                            </div>

                            <div class="col-12 py-2">
                                <h4>Return Address</h4>
                            </div>
                            <div class="col-12 py-2 d-flex align-items-center">
                                <label>Same as warehouse address </label>
                                <div style="margin-left: 30px;">
                                    <input type="radio" name="return_copy_from_warehouse" id="yes"
                                        value="yes" onclick="handleClick(this);"
                                        {{ $seller->return_copy_from_warehouse == 'yes' ? 'checked' : '' }} readonly>
                                    <label for="yes">Yes</label></label>

                                </div>
                                <div style="margin-left: 30px;">
                                    <input type="radio" name="return_copy_from_warehouse" id="no"
                                        value="no" onclick="handleClick(this);"
                                        {{ $seller->return_copy_from_warehouse == 'no' ? 'checked' : '' }} readonly>
                                    <label for="no">No</label></label>
                                </div>
                            </div>

                            @if ($seller->return_copy_from_warehouse == 'no')
                                <div class="col-12 col-md-6 py-2 same_as">
                                    <label>First and Last Name </label>
                                    <h6>{{ $seller->return_full_name }}</h6>
                                </div>
                                <div class="col-12 col-md-6 py-2 same_as">
                                    <label>Address </label>
                                    <h6>{{ $seller->return_address }}</h6>
                                </div>
                                <div class="col-12 col-md-6 py-2 same_as">
                                    <label>Phone Number </label>
                                    <h6>{{ $seller->return_phone }}</h6>
                                </div>
                                <div class="col-12 col-md-6 py-2 same_as">
                                    <label>City / Town </label>
                                    <h6>{{ $seller->return_city_town }}</h6>
                                </div>
                                <div class="col-12 col-md-6 py-2 same_as">
                                    <label>Country/ Region </label>
                                    <h6>{{ $seller->return_country }}</h6>
                                </div>
                                <div class="col-12 col-md-6 py-2 same_as">
                                    <label>Division </label>
                                    <h6>{{ $seller->return_division }}</h6>
                                </div>
                                <div class="col-12 col-md-6 py-2 same_as">
                                    <label>City </label>
                                    <h6>{{ $seller->return_city }}</h6>
                                </div>
                                <div class="col-12 col-md-6 py-2 same_as">
                                    <label>Postcode </label>
                                    <h6>{{ $seller->return_postcode }}</h6>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-capitalize">
                        {{\App\CPU\translate('Seller')}} {{\App\CPU\translate('Account')}} <br>
                        @if ($seller->status == 'approved')
                            <form class="d-inline-block" action="{{route('admin.sellers.updateStatus')}}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{$seller->id}}">
                                <input type="hidden" name="status" value="suspended">
                                <button type="submit"
                                        class="btn btn-outline-danger">{{\App\CPU\translate('suspend')}}</button>
                            </form>
                        @elseif($seller->status=='rejected' || $seller->status=='suspended')
                            <form class="d-inline-block" action="{{route('admin.sellers.updateStatus')}}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{$seller->id}}">
                                <input type="hidden" name="status" value="approved">
                                <button type="submit"
                                        class="btn btn-outline-success">{{\App\CPU\translate('activate')}}</button>
                            </form>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="card-body" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
                            <div class="flex-start">
                                <div><h4>Status : </h4></div>
                                <div class="mx-1"><h4>{!! $seller->status=='approved'?'<label class="badge badge-success">Active</label>':'<label class="badge badge-danger">In-Active</label>' !!}</h4></div>
                            </div>
                            <div class="flex-start">
                                <div><h5>{{\App\CPU\translate('name')}} : </h5></div>
                                <div class="mx-1"><h5>{{$seller->f_name}} {{$seller->l_name}}</h5></div>
                            </div>
                            <div class="flex-start">
                                <div><h5>{{\App\CPU\translate('Email')}} : </h5></div>
                                <div class="mx-1"><h5>{{$seller->email}}</h5></div>
                            </div>
                            <div class="flex-start">
                                <div><h5>{{\App\CPU\translate('Phone')}} : </h5></div>
                                <div class="mx-1"><h5>{{$seller->phone}}</h5></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if ($seller->shop)
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            {{\App\CPU\translate('Shop')}} {{\App\CPU\translate('info')}}
                        </div>
                        <div class="card-body" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
                            <div class="flex-start">
                                <div><h5>{{\App\CPU\translate('seller')}} : </h5></div>
                                <div class="mx-1"><h5>{{$seller->shop->name}}</h5></div>
                            </div>
                            <div class="flex-start">
                                <div><h5>{{\App\CPU\translate('Phone')}} : </h5></div>
                                <div class="mx-1"><h5>{{$seller->shop->contact}}</h5></div>
                            </div>
                            <div class="flex-start">
                                <div><h5>{{\App\CPU\translate('address')}} : </h5></div>
                                <div class="mx-1"><h5>{{$seller->shop->address}}</h5></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="col-md-6 mt-3">
                <div class="card">
                    <div class="card-header">
                        {{\App\CPU\translate('bank_info')}}
                    </div>
                    <div class="card-body" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
                        <div class="col-md-8 mt-2">
                            <div class="flex-start">
                                <div><h4>{{\App\CPU\translate('bank_name')}} : </h4></div>
                                <div class="mx-1"><h4>{{$seller->bank_name ? $seller->bank_name : 'No Data found'}}</h4></div>
                            </div>
                            <div class="flex-start">
                                <div><h6>{{\App\CPU\translate('Branch')}} : </h6></div>
                                <div class="mx-1"><h6>{{$seller->branch ? $seller->branch : 'No Data found'}}</h6></div>
                            </div>
                            <div class="flex-start">
                                <div><h6>{{\App\CPU\translate('holder_name')}} : </h6></div>
                                <div class="mx-1"><h6>{{$seller->holder_name ? $seller->holder_name : 'No Data found'}}</h6></div>
                            </div>
                            <div class="flex-start">
                                <div><h6>{{\App\CPU\translate('account_no')}} : </h6></div>
                                <div class="mx-1"><h6>{{$seller->account_no ? $seller->account_no : 'No Data found'}}</h6></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

        {{-- <div class="col-md-6 mt-3">
                <form action="{{route('admin.sellers.sales-commission-update',[$seller['id']])}}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <label> Sales Commission : </label>
                            <label class="switch ml-3">
                                <input type="checkbox" name="status"
                                       class="status"
                                       value="1" {{$seller['sales_commission_percentage']!=null?'checked':''}}>
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <div class="card-body">
                            <small class="badge badge-soft-danger mb-3">
                                If sales commission is disabled here, the system default commission will be applied.
                            </small>
                            <div class="form-group">
                                <label>Commission ( % )</label>
                                <input type="number" value="{{$seller['sales_commission_percentage']}}"
                                       class="form-control" name="commission">
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div> --}}
        {{-- </div> --}}
    </div>
@endsection

@push('script')
@endpush
