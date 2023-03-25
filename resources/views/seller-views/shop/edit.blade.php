@extends('layouts.back-end.app-seller')
@section('title', \App\CPU\translate('Account & Settings'))
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
            color: #484747;
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

        .bkash {
            display: none;
        }

        .bank {
            display: none;
        }

        .holiday-input {
            display: none;
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
                        <a href="{{ route('seller.shop.view') }}" class="btn btn-primary">Back To Account & Settings</a>
                    </div>
                    <div class="card-body application-form">
                        <form action="{{ route('seller.shop.update', [$shop->id]) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12 py-2">
                                    <h4>Seller Account</h4>

                                </div>
                                <div class="col-12 col-md-6 py-2">
                                    <label>First Name <span>*</span></label>
                                    <input type="text" name="f_name" class="form-control" value="{{ $seller->f_name }}">
                                    <span class="text-danger">{{ $errors->first('f_name') }}</span>
                                </div>
                                <div class="col-12 col-md-6 py-2">
                                    <label>Last Name <span>*</span></label>
                                    <input type="text" name="l_name" class="form-control"
                                        value="{{ $seller->l_name }}">
                                    <span class="text-danger">{{ $errors->first('l_name') }}</span>
                                </div>
                                <div class="col-12 col-md-6 py-2">
                                    <label>Contact Email address <span>*</span></label>
                                    <input type="text" name="email" class="form-control" value="{{ $seller->email }}">
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                </div>
                                <div class="col-12 col-md-6 py-2">
                                    <label>Phone Number <span>*</span></label>
                                    <input type="text" name="phone" class="form-control" value="{{ $seller->phone }}">
                                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                                </div>
                                <div class="col-12 col-md-6 py-2">
                                    <label>Display Name / Shop Name <span>*</span></label>
                                    <input type="text" name="shop_name" class="form-control"
                                        value="{{ $shop->name }}">
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                </div>
                                <div class="col-12 col-md-6 py-2">
                                    <div class="d-flex">
                                        <label>Holiday Mode</label>
                                        <div class="ml-4">
                                            <label for="holiday">Yes</label>
                                            <input type="checkbox" value="1" name="holiday_mode" id="holiday"
                                                onclick="handleCheckClick(this)"
                                                {{ $seller->holiday_mode == 1 ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                    <div class="holiday-input">
                                        <div class="row">
                                            <div class="col-6">
                                                <input type="date" class="form-control" name="holiday_mode_period_start"
                                                    value="{{ $seller->holiday_mode_period_start }}">
                                            </div>
                                            <div class="col-6">
                                                <input type="date" name="holiday_mode_period_end" class="form-control"
                                                    value="{{ $seller->holiday_mode_period_end }}">

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
                                        <input type="text" name="owner_name" class="form-control"
                                            value="{{ $shop->owner_name }}">
                                    </div>
                                    <div class="col-12 col-md-6 py-2">
                                        <label>Busness Type</label>
                                        <select name="busness_type" class="form-control" disabled>
                                            <option value="">select Type</option>
                                            <option value="Individual"
                                                {{ $seller->busness_type == 'Individual' ? 'selected' : '' }}>Individual
                                            </option>
                                            <option value="Business"
                                                {{ $seller->busness_type == 'Business' ? 'selected' : '' }}>Business
                                            </option>
                                        </select>

                                    </div>
                                    <div class="col-12 col-md-6 py-2">
                                        <label>Address <span>*</span></label>
                                        <input type="text" name="address" class="form-control"
                                            value="{{ $shop->address }}">
                                    </div>
                                    <div class="col-12 col-md-6 py-2">
                                        <label>Postcode <span>*</span></label>
                                        <input type="text" name="postcode" class="form-control"
                                            value="{{ $seller->postcode }}">
                                    </div>
                                    <div class="col-12 col-md-6 py-2">
                                        <label>Country/ Region <span>*</span></label>
                                        <input type="text" name="country" class="form-control"
                                            value="{{ $seller->country }}">
                                    </div>
                                    <div class="col-12 col-md-6 py-2">
                                        <label>Division <span>*</span></label>
                                        <input type="text" name="division" class="form-control"
                                            value="{{ $seller->division }}">
                                    </div>
                                    <div class="col-12 col-md-6 py-2">
                                        <label>City / Town <span>*</span></label>
                                        <input type="text" name="city" class="form-control"
                                            value="{{ $seller->city }}">
                                    </div>
                                    <div class="col-12 col-md-6 py-2">
                                        <label>Person in Charge Name <span>*</span></label>
                                        <input type="text" name="in_charge_name" class="form-control"
                                            value="{{ $seller->in_charge_name }}">
                                    </div>
                                    <div class="col-12 col-md-6 py-2">
                                        <label>Business Registration Certificate <span>*</span></label>
                                        <input type="file" name="business_registration_number" class="form-control"
                                            value="{{ $seller->business_registration_number }}">
                                    </div>
                                    <div class="col-12 col-md-6 py-2">
                                        <label>Upload ID Copy - Front Side <span>*</span></label>
                                        <input type="file" name="id_front_side" class="form-control">
                                    </div>
                                    <div class="col-12 col-md-6 py-2">
                                        <label>Upload ID Copy - Back Side <span>*</span></label>
                                        <input type="file" name="id_back_side" class="form-control">
                                    </div>
                                    <div class="col-12 col-md-6 py-2">
                                        <label>National Identity Card No <span>*</span></label>
                                        <input type="text" name="nid_number" class="form-control"
                                            value="{{ $seller->nid_number }}">
                                    </div>


                                    <div class="col-12 col-md-6 py-2">
                                        <label>ID Type <span>*</span></label>
                                        <select name="id_type" id="id_type" class="form-control">
                                            <option value="">Select Type</option>
                                            <option {{ $seller->id_type == 'NID' ? 'selected' : '' }} value="NID">
                                                NID</option>
                                            <option {{ $seller->id_type == 'Birth Certificate' ? 'selected' : '' }}
                                                value="Birth Certificate">
                                                Birth Certificate</option>
                                            <option {{ $seller->id_type == 'Passport' ? 'selected' : '' }}
                                                value="Passport">Passport</option>
                                        </select>
                                    </div>
                                @endif



                                <div class="col-12 py-2">
                                    <h4>Bank Account</h4>
                                </div>
                                <div class="col-12 col-md-6 py-2">
                                    <label>Account Type</label>
                                    <select name="account_type" class="form-control" id="account_type_select">
                                        <option value="">Account Type</option>
                                        <option value="Bkash" {{ $seller->account_type == 'Bkash' ? 'selected' : '' }}>
                                            Bkash</option>
                                        <option value="Bank" {{ $seller->account_type == 'Bank' ? 'selected' : '' }}>
                                            Bank</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-6 py-2 bkash">
                                    <label>Account Name</label>
                                    <input type="text" name="bkash_name" class="form-control"
                                        value="{{ $seller->bkash_name }}">
                                </div>
                                <div class="col-12 col-md-6 py-2 bkash">
                                    <label>Bkash Number</label>
                                    <input type="text" name="bkash_number" class="form-control"
                                        value="{{ $seller->bkash_number }}">
                                </div>

                                <div class="col-12 col-md-6 py-2 bank">
                                    <label>Account Holder Name <span>*</span></label>
                                    <input type="text" name="holder_name" class="form-control"
                                        value="{{ $seller->holder_name }}">
                                </div>
                                <div class="col-12 col-md-6 py-2 bank">
                                    <label>Account Number <span>*</span></label>
                                    <input type="text" name="account_no" class="form-control"
                                        value="{{ $seller->account_no }}">
                                </div>
                                <div class="col-12 col-md-6 py-2 bank">
                                    <label>Bank Name <span>*</span></label>
                                    <input type="text" name="bank_name" class="form-control"
                                        value="{{ $seller->bank_name }}">
                                </div>

                                <div class="col-12 col-md-6 py-2 bank">
                                    <label>Branch Name <span>*</span></label>
                                    <input type="text" name="branch" class="form-control"
                                        value="{{ $seller->branch }}">
                                </div>
                                <div class="col-12 col-md-6 py-2 bank">
                                    <label>Routing Number <span>*</span></label>
                                    <input type="text" name="bank_routing" class="form-control"
                                        value="{{ $seller->bank_routing }}">
                                </div>
                                <div class="col-12 col-md-6 py-2 bank">
                                    <label>Upload Cheque Copy <span>*</span></label>
                                    <input type="file" name="cheque_copy" class="form-control">
                                </div>



                                <div class="col-12 py-2">
                                    <h4>Warehouse Address</h4>
                                </div>
                                <div class="col-12 col-md-6 py-2">
                                    <label>First and Last Name <span>*</span></label>
                                    <input type="text" name="war_full_name" class="form-control"
                                        value="{{ $seller->war_full_name }}">
                                </div>
                                <div class="col-12 col-md-6 py-2">
                                    <label>Address <span>*</span></label>
                                    <input type="text" name="war_address" class="form-control"
                                        value="{{ $seller->war_address }}">
                                </div>
                                <div class="col-12 col-md-6 py-2">
                                    <label>Phone Number <span>*</span></label>
                                    <input type="text" name="war_phone" class="form-control"
                                        value="{{ $seller->war_phone }}">
                                </div>
                                <div class="col-12 col-md-6 py-2">
                                    <label>City / Town <span>*</span></label>
                                    <input type="text" name="war_city_town" class="form-control"
                                        value="{{ $seller->war_city_town }}">
                                </div>
                                <div class="col-12 col-md-6 py-2">
                                    <label>Country/ Region <span>*</span></label>
                                    <input type="text" name="war_country" class="form-control"
                                        value="{{ $seller->war_country }}">
                                </div>
                                <div class="col-12 col-md-6 py-2">
                                    <label>Division <span>*</span></label>
                                    <input type="text" name="war_division" class="form-control"
                                        value="{{ $seller->war_division }}">
                                </div>
                                <div class="col-12 col-md-6 py-2">
                                    <label>City <span>*</span></label>
                                    <input type="text" name="war_city" class="form-control"
                                        value="{{ $seller->war_city }}">
                                </div>
                                <div class="col-12 col-md-6 py-2">
                                    <label>Postcode <span>*</span></label>
                                    <input type="text" name="war_postcode" class="form-control"
                                        value="{{ $seller->war_postcode }}">
                                </div>

                                <div class="col-12 py-2">
                                    <h4>Return Address</h4>
                                </div>
                                <div class="col-12 py-2 d-flex align-items-center">
                                    <label>Copy from warehouse address <span>*</span></label>
                                    <div style="margin-left: 30px;">
                                        <input type="radio" name="return_copy_from_warehouse" id="yes"
                                            value="yes" onclick="handleClick(this);"
                                            {{ $seller->return_copy_from_warehouse == 'yes' ? 'checked' : '' }}>
                                        <label for="yes">Yes</label></label>

                                    </div>
                                    <div style="margin-left: 30px;">
                                        <input type="radio" name="return_copy_from_warehouse" id="no"
                                            value="no" onclick="handleClick(this);"
                                            {{ $seller->return_copy_from_warehouse == 'no' ? 'checked' : '' }}>
                                        <label for="no">No</label></label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 py-2 same_as">
                                    <label>First and Last Name <span>*</span></label>
                                    <input type="text" name="return_full_name" class="form-control"
                                        value="{{ $seller->return_full_name }}">
                                </div>
                                <div class="col-12 col-md-6 py-2 same_as">
                                    <label>Address <span>*</span></label>
                                    <input type="text" name="return_address" class="form-control"
                                        value="{{ $seller->return_address }}">
                                </div>
                                <div class="col-12 col-md-6 py-2 same_as">
                                    <label>Phone Number <span>*</span></label>
                                    <input type="text" name="return_phone" class="form-control"
                                        value="{{ $seller->return_phone }}">
                                </div>
                                <div class="col-12 col-md-6 py-2 same_as">
                                    <label>City / Town <span>*</span></label>
                                    <input type="text" name="return_city_town" class="form-control"
                                        value="{{ $seller->return_city_town }}">
                                </div>
                                <div class="col-12 col-md-6 py-2 same_as">
                                    <label>Country/ Region <span>*</span></label>
                                    <input type="text" name="return_country" class="form-control"
                                        value="{{ $seller->return_country }}">
                                </div>
                                <div class="col-12 col-md-6 py-2 same_as">
                                    <label>Division <span>*</span></label>
                                    <input type="text" name="return_division" class="form-control"
                                        value="{{ $seller->return_division }}">
                                </div>
                                <div class="col-12 col-md-6 py-2 same_as">
                                    <label>City <span>*</span></label>
                                    <input type="text" name="return_city" class="form-control"
                                        value="{{ $seller->return_city }}">
                                </div>
                                <div class="col-12 col-md-6 py-2 same_as">
                                    <label>Postcode <span>*</span></label>
                                    <input type="text" name="return_postcode" class="form-control"
                                        value="{{ $seller->return_postcode }}">
                                </div>

                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>


                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#viewer').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function readBannerURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#viewerBanner').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileUpload").change(function() {
            readURL(this);
        });

        $("#BannerUpload").change(function() {
            readBannerURL(this);
        });


        document.getElementById('account_type_select').addEventListener('change', function() {
            if (this.value == 'Bkash') {
                $('.bkash').show();
                $('.bank').hide();
            }
            if (this.value == 'Bank') {
                $('.bank').show();
                $('.bkash').hide();
            }
        });


        function handleClick(myRadio) {
            if (myRadio.value == 'yes') {
                $('.same_as').hide();

            }
            if (myRadio.value == 'no') {
                $('.same_as').show();

            }
        }



        function handleCheckClick(myCheck) {
            if ($(myCheck).prop("checked") == true) {

                $('.holiday-input').show();
            }
            if ($(myCheck).prop("checked") == false) {
                $('.holiday-input').hide();
            }
        }
    </script>
@endpush
