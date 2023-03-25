@extends('layouts.front-end.app')

@section('title', \App\CPU\translate('Seller Apply'))

@push('css_or_js')
    {{-- <link href="{{asset('public/assets/back-end')}}/css/select2.min.css" rel="stylesheet"/>
<link href="{{asset('public/assets/back-end/css/croppie.css')}}" rel="stylesheet"> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .seller-signup-section {
            background: #dbdbdb;
        }

        .seller-signup-box {
            max-width: 600px;
            box-shadow: rgba(17, 17, 26, 0.1) 0px 4px 16px, rgba(17, 17, 26, 0.05) 0px 8px 32px;
            margin: 0 auto;
            padding: 50px;
            background: #ffffff;
            border-radius: 15px;
        }

        .seller-signup-box form input {
            display: block;
            width: 100%;
            border: 1px solid #cccccc;
            outline: none;
            padding: 6px;
            border-radius: 3px;
        }

        .seller-signup-box form input[type="radio"] {
            width: inherit;
            margin: 0;
            position: inherit;
            height: inherit;
            display: inline-block;
        }

        .seller-signup-box form label {
            font-weight: 600;
        }

        .seller-signup-box h4 {
            text-align: center;
            font-weight: 700;
            margin: 0;
            padding-bottom: 30px;
        }

        .verify-code-btn {
            width: 100%;
            display: block;
            background: #121D2C;
            color: #ffffff;
            padding: 5px;
            text-align: center;
            border-radius: 5px;
        }

        .seller-signup-box .signup-btn {
            width: 100%;
            display: block;
            background: #F16C29;
            color: #ffffff;
            padding: 10px;
            text-align: center;
            border-radius: 5px;
            border: none;
            font-size: 18px;
            font-weight: 700;
        }
    </style>
@endpush


@section('content')

    <section class="seller-signup-section py-5">
        <div class="container">
            <div class="seller-signup-box">
                <h4>Seller Sign Up</h4>
                <form action="{{ route('shop.apply') }}" method="post">
                    @csrf
                    <div class="d-flex align-items-center py-2">
                        <label for="" class="pr-4">Account/Busness Type : </label>
                        <div class="px-3">
                            <input type="radio" id="Individual" value="Individual" name="busness_type" checked>
                            <label for="Individual">Individual</label>
                        </div>
                        <div class="px-3">
                            <input type="radio" id="Business" value="Business" name="busness_type">
                            <label for="Business">Business</label>
                        </div>
                    </div>

                    <div class="p-1">
                        <label for="">Name <span class="text-danger">*</span></label>
                        <div class="row">
                            <input type="text" name="f_name" class="col-md-6" value="{{ old('f_name') }}"
                                placeholder="First Name">
                            <input type="text" name="l_name" class="col-md-6" value="{{ old('l_name') }}"
                                placeholder="Last Name">
                        </div>
                        <span class="text-danger">{{ $errors->first('f_name') }}</span>
                        <input class="d-none my-2" type="number" placeholder="Verify Code">
                    </div>

                    <div class="py-2">
                        <label for="">Mobile Number <span class="text-danger">*</span></label>
                        <input type="text" name="phone" value="{{ old('phone') }}">
                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                        <input class="d-none my-2" type="number" placeholder="Verify Code">
                    </div>
                    <div class="d-none">
                        <button class="verify-code-btn">Verify Code</button>
                    </div>
                    <div class="py-2">
                        <label for="">Shop Name <span class="text-danger">*</span></label>
                        <input type="text" name="shop_name" value="{{ old('shop_name') }}" required>
                        <span class="text-danger">{{ $errors->first('shop_name') }}</span>
                    </div>
                    <div class="py-2">
                        <label for="">Email Address <span class="text-danger">*</span></label>
                        <input type="email" name="email" value="{{ old('email') }}" required>
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    </div>
                    <div class="py-2">
                        <label for="">Referral ID </label>
                        <input type="text" name="referral_id" value="{{ old('referral_id') }}">
                    </div>
                    <div class="py-2">
                        <label for="">Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" required>
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    </div>
                    <div class="py-2">
                        <label for="">Confirm Password <span class="text-danger">*</span></label>
                        <input type="password" name="password_confirmation" required>
                    </div>
                    <div class="pt-2">
                        <button type="submit" class="signup-btn">Sign Up</button>
                    </div>
                </form>
            </div>
        </div>
    </section>


@endsection

@push('script')
    <script></script>
@endpush




















{{--
<div class="container main-card rtl" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">

    <div class="card o-hidden border-0 shadow-lg my-4">
        <div class="card-body ">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center mb-2 ">
                            <h3 class="" > {{\App\CPU\translate('Shop')}} {{\App\CPU\translate('Application')}}</h3>
                            <hr>
                        </div>
                        <form class="user" action="{{route('shop.apply')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <h5 class="black">{{\App\CPU\translate('Seller')}} {{\App\CPU\translate('Info')}} </h5>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" id="exampleFirstName" name="f_name" value="{{old('f_name')}}" placeholder="{{\App\CPU\translate('first_name')}}" required>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-user" id="exampleLastName" name="l_name" value="{{old('l_name')}}" placeholder="{{\App\CPU\translate('last_name')}}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0 mt-4">
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail" name="email" value="{{old('email')}}" placeholder="{{\App\CPU\translate('email_address')}}" required>
                                </div>
                                <div class="col-sm-6"><small class="text-danger">( * {{\App\CPU\translate('country_code_is_must')}} {{\App\CPU\translate('like_for_BD_880')}} )</small>
                                    <input type="number" class="form-control form-control-user" id="exampleInputPhone" name="phone" value="{{old('phone')}}" placeholder="{{\App\CPU\translate('phone_number')}}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user" minlength="6" id="exampleInputPassword" name="password" placeholder="{{\App\CPU\translate('password')}}" required>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user" minlength="6" id="exampleRepeatPassword" placeholder="{{\App\CPU\translate('repeat_password')}}" required>
                                    <div class="pass invalid-feedback">{{\App\CPU\translate('Repeat')}}  {{\App\CPU\translate('password')}} {{\App\CPU\translate('not match')}} .</div>
                                </div>
                            </div>

                            <div class="">
                                <div class="pb-1">
                                    <center>
                                        <img style="width: auto;border: 1px solid; border-radius: 10px; max-height:200px;" id="viewer"
                                            src="{{asset('public\assets\back-end\img\400x400\img2.jpg')}}" alt="banner image"/>
                                    </center>
                                </div>

                                <div class="form-group">
                                    <div class="custom-file" style="text-align: left">
                                        <input type="file" name="image" id="customFileUpload" class="custom-file-input"
                                            accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                        <label class="custom-file-label" for="customFileUpload">{{\App\CPU\translate('Upload')}} {{\App\CPU\translate('image')}}</label>
                                    </div>
                                </div>
                            </div>


                            <h5 class="black">{{\App\CPU\translate('Shop')}} {{\App\CPU\translate('Info')}}</h5>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0 ">
                                    <input type="text" class="form-control form-control-user" id="shop_name" name="shop_name" placeholder="{{\App\CPU\translate('shop_name')}}" value="{{old('shop_name')}}"required>
                                </div>
                                <div class="col-sm-6">
                                    <textarea name="shop_address" class="form-control" id="shop_address"rows="1" placeholder="{{\App\CPU\translate('shop_address')}}">{{old('shop_address')}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="pb-1">
                                        <center>
                                            <img style="width: auto;border: 1px solid; border-radius: 10px; max-height:200px;" id="viewerLogo"
                                                src="{{asset('public\assets\back-end\img\400x400\img2.jpg')}}" alt="banner image"/>
                                        </center>
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-file" style="text-align: left">
                                            <input type="file" name="logo" id="LogoUpload" class="custom-file-input"
                                                accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                            <label class="custom-file-label" for="LogoUpload">{{\App\CPU\translate('Upload')}} {{\App\CPU\translate('logo')}}</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="pb-1">
                                        <center>
                                            <img style="width: auto;border: 1px solid; border-radius: 10px; max-height:200px;" id="viewerBanner"
                                                src="{{asset('public\assets\back-end\img\400x400\img2.jpg')}}" alt="banner image"/>
                                        </center>
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-file" style="text-align: left">
                                            <input type="file" name="banner" id="BannerUpload" class="custom-file-input"
                                                accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" style="overflow: hidden; padding: 2%">
                                            <label class="custom-file-label" for="BannerUpload">{{\App\CPU\translate('Upload')}} {{\App\CPU\translate('Banner')}}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>









                            <button type="submit" class="btn btn-primary btn-user btn-block" id="apply">{{\App\CPU\translate('Apply')}} {{\App\CPU\translate('Shop')}} </button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small"  href="{{route('seller.auth.login')}}">{{\App\CPU\translate('already_have_an_account?_login.')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

{{--

@push('script')
@if ($errors->any())
    <script>
        @foreach ($errors->all() as $error)
        toastr.error('{{$error}}', Error, {
            CloseButton: true,
            ProgressBar: true
        });
        @endforeach
    </script>
@endif
<script>
    $('#exampleInputPassword ,#exampleRepeatPassword').on('keyup',function () {
        var pass = $("#exampleInputPassword").val();
        var passRepeat = $("#exampleRepeatPassword").val();
        if (pass==passRepeat){
            $('.pass').hide();
        }
        else{
            $('.pass').show();
        }
    });
    $('#apply').on('click',function () {

        var image = $("#image-set").val();
        if (image=="")
        {
            $('.image').show();
            return false;
        }
        var pass = $("#exampleInputPassword").val();
        var passRepeat = $("#exampleRepeatPassword").val();
        if (pass!=passRepeat){
            $('.pass').show();
            return false;
        }


    });
    function Validate(file) {
        var x;
        var le = file.length;
        var poin = file.lastIndexOf(".");
        var accu1 = file.substring(poin, le);
        var accu = accu1.toLowerCase();
        if ((accu != '.png') && (accu != '.jpg') && (accu != '.jpeg')) {
            x = 1;
            return x;
        } else {
            x = 0;
            return x;
        }
    }

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#viewer').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#customFileUpload").change(function () {
        readURL(this);
    });

    function readlogoURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#viewerLogo').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }



    function readBannerURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#viewerBanner').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#LogoUpload").change(function () {
        readlogoURL(this);
    });

    $("#BannerUpload").change(function () {
        readBannerURL(this);
    });
</script>
@endpush --}}
