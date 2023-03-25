@extends('layouts.front-end.app')

@section('title',\App\CPU\translate('Privacy policy'))

@push('css_or_js')
    <meta property="og:image" content="{{asset('storage/app/public/company')}}/{{$web_config['web_logo']->value}}"/>
    <meta property="og:title" content="Terms & conditions of {{$web_config['name']->value}} "/>
    <meta property="og:url" content="{{env('APP_URL')}}">
    <meta property="og:description" content="{!! substr($web_config['about']->value,0,100) !!}">

    <meta property="twitter:card" content="{{asset('storage/app/public/company')}}/{{$web_config['web_logo']->value}}"/>
    <meta property="twitter:title" content="Terms & conditions of {{$web_config['name']->value}}"/>
    <meta property="twitter:url" content="{{env('APP_URL')}}">
    <meta property="twitter:description" content="{!! substr($web_config['about']->value,0,100) !!}">

    <style>
        .headerTitle {
            font-size: 25px;
            font-weight: 700;
            margin-top: 2rem;
        }

        .for-container {
            width: 91%;
            border: 1px solid #D8D8D8;
            margin-top: 3%;
            margin-bottom: 3%;
        }

        .for-padding {
            padding: 3%;
        }
    </style>
@endpush

@section('content')
    <div class="container rounded for-container rtl" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
        {{-- <h2 class="text-center mt-3 headerTitle">{{\App\CPU\translate('Privacy policy')}}</h2> --}}
        <div class="for-padding">
            {{-- {!! $privacy_policy['value'] !!} --}}


           <h2><b>Mission & Vision</b></h2>
            Nillgiri online shopping Mall brings Nillgiri is a Bangladeshi Ecommerce marketplace, it Launched in 1 may 2022. Nillgiri has been running since 1 June 2022. Nillgiri has started the journey with 4 partners. and Nillgiri is a multitevender ecommerce company.
            All legal products can be traded here. to online shopping while helping customers good, cheap and needfull.<br><br>

            "Nillgiri Online Shopping Mall will keep on being a customer focused store, offering the Original, Cheap rated and Best product. We will keep on developing the business by giving great worth, administration, and satisfaction past the desires of our clients."<br><br>

           <h2><b>Mission</b></h2>
            The mission statement is longer than a motto but shorter than a vision statement, and should communicate the most important information about the company in as concise a fashion as possible. This sentence should catch a potential buyer or investor’s attention quickly even if they only give it a glance.<br><br>
            <h2><b>Vision</b></h2>

            A vision statement outlines your long-term, grander goals for the company’s future. It’s more important for a vision statement to be inspiring than it is to be realistic, but at the same time, you want to avoid setting a vision that’s clearly hyperbolic or impossible.<br><br>
            “At Nillgiri Online Shopping Mall, our mission is to provide original, chef-rated and best products to our customers worldwide. We strive to offer an exceptional customer experience and to be the leading provider of products and services.”
            Join us!
            If you think this work matters as much as we do, you should consider joining us. Check out https://www.facebook.com/nillgiri.bd and see if you fit any of our currently available roles.



        </div>
    </div>
@endsection
