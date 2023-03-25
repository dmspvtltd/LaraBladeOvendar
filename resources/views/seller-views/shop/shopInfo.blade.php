@extends('layouts.back-end.app-seller')
@section('title', \App\CPU\translate('Shop view'))
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
                        href="{{ route('seller.dashboard.index') }}">{{ \App\CPU\translate('Dashboard') }}</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">{{ \App\CPU\translate('Account & Setting') }}</li>

            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1 class="h3 mb-0 ">{{ \App\CPU\translate('Account & Settings') }}</h1>
                        <a href="{{ route('seller.shop.edit', [$shop->id]) }}" class="btn btn-primary">Edit Account &
                            Settings</a>
                    </div>
                    <div class="card-body application-form">
                        <div class="row">
                            <div class="col-12 py-2">
                                <h4>Seller Account, ID : {{ $seller->selleruid }}</h4>
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
                                <h6>{{ $shop->name }}</h6>
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
                                    <label>Business Registration Number</label>
                                    <h6>
                                        @if ($seller->business_registration_number)
                                            <a href="{{ asset($seller->business_registration_number) }}">Preview</a>
                                        @else
                                            No Documents
                                        @endif
                                    </h6>
                                </div>
                                <div class="col-12 col-md-6 py-2">
                                    <label>Upload ID Copy - Front Side </label>
                                    <h6>
                                        @if ($seller->id_front_side)
                                            <a href="{{ asset($seller->id_front_side) }}">Preview</a>
                                        @else
                                            No Documents
                                        @endif
                                    </h6>
                                </div>
                                <div class="col-12 col-md-6 py-2">
                                    <label>Upload ID Copy - Back Side </label>
                                    <h6>
                                        @if ($seller->id_back_side)
                                            <a href="{{ asset($seller->id_back_side) }}">Preview</a>
                                        @else
                                            No Documents
                                        @endif
                                    </h6>
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
                                    <input type="radio" name="return_copy_from_warehouse" id="yes" value="yes"
                                        onclick="handleClick(this);"
                                        {{ $seller->return_copy_from_warehouse == 'yes' ? 'checked' : '' }} disabled>
                                    <label for="yes">Yes</label></label>

                                </div>
                                <div style="margin-left: 30px;">
                                    <input type="radio" name="return_copy_from_warehouse" id="no" value="no"
                                        onclick="handleClick(this);"
                                        {{ $seller->return_copy_from_warehouse == 'no' ? 'checked' : '' }} disabled>
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
    </div>
@endsection

{{-- @section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="h3 mb-0  ">{{\App\CPU\translate('my_shop')}} {{\App\CPU\translate('Info')}} </h3>
                    </div>
                    <div class="card-body">
                        <div class="row mt-2">
                            @if ($shop->image == 'def.png')
                                <div class="col-md-3 text-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}">
                                    <img height="200" width="200" class="rounded-circle border"
                                         onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                         src="{{asset('public/assets/back-end')}}/img/shop.png">
                                </div>
                            @else
                                <div class="col-md-3 text-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}">
                                    <img src="{{asset('storage/app/public/shop/'.$shop->image)}}"
                                         onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                         class="rounded-circle border"
                                         height="200" width="200" alt="">
                                </div>
                            @endif


                            <div class="col-md-3 mt-4">
                                <div class="flex-start">
                                    <h4>{{\App\CPU\translate('Name')}} : </h4>
                                    <h4 class="mx-1">{{$shop->name}}</h4>
                                </div>
                                <div class="flex-start">
                                    <h6>{{\App\CPU\translate('Phone')}} : </h6>
                                    <h6 class="mx-1">{{$shop->contact}}</h6>
                                </div>
                                <div class="flex-start">
                                    <h6>{{\App\CPU\translate('address')}} : </h6>
                                    <h6 class="mx-1">{{$shop->address}}</h6>
                                </div>
                                <div class="flex-start">
                                    <a class="btn btn-primary" href="{{route('seller.shop.edit',[$shop->id])}}">{{\App\CPU\translate('edit')}}</a>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="flex-start">
                                    <h4>{{\App\CPU\translate('Address')}} : </h4>

                                </div>
                                <div class="flex-start">
                                    <h6>{{\App\CPU\translate('Pickup Address')}} : </h6>
                                    <h6 class="mx-1">{{$shop->pickup_address}}</h6>
                                </div>
                                <div class="flex-start">
                                    <h6>{{\App\CPU\translate('Return Address')}} : </h6>
                                    <h6 class="mx-1">{{$shop->return_address}}</h6>
                                </div>
                                <div class="flex-start">
                                    <h6>{{\App\CPU\translate('City')}} : </h6>
                                    <h6 class="mx-1">{{$shop->city?$shop->city->en_name:NULL }}</h6>
                                </div>

                            </div>

                            <div class="col-md-3">
                                <div class="flex-start">
                                    <h4>{{\App\CPU\translate('Owner Info')}} : </h4>

                                </div>
                                <div class="flex-start">
                                    <h6>{{\App\CPU\translate('Owner Name')}} : </h6>
                                    <h6 class="mx-1">{{$shop->owner_name}}</h6>
                                </div>
                                <div class="flex-start">
                                    <h6>{{\App\CPU\translate('Owner Mobile')}} : </h6>
                                    <h6 class="mx-1">{{$shop->owner_mobile}}</h6>
                                </div>
                                <div class="flex-start">
                                    <h6>{{\App\CPU\translate('Establish Year')}} : </h6>
                                    <h6 class="mx-1">{{$shop->establish_year }}</h6>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection --}}

@push('script')
    <!-- Page level plugins -->
@endpush
