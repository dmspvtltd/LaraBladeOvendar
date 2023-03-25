@extends('layouts.front-end.app')

@section('title',$product['name'])

@push('css_or_js')


    <meta name='description' content="{!! $product['meta_description'] !!}"/>
    <meta name='keywords' content='@foreach(explode(' ',$product['name']) as $keyword) {{$keyword.' , '}} @endforeach' />
    <meta property="og:url" content="{{route('product',[$product->slug])}}" />
    <meta property="og:type" content="{!! $product['meta_description'] !!}" />
    <meta property="og:title" content="{{ $product['name'] }}" />
    <meta property="og:description" content="{!! $product['meta_description'] !!}" />
    
    @if($product->images!=null)
        @foreach (json_decode($product->images) as $key => $photo)
             <meta property="og:image" content="{{asset("storage/app/public/product/$photo")}}" />
             <meta name="twitter:card" content="{{asset("storage/app/public/product/$photo")}}" />
        @endforeach
    @endif
    
    
    <meta name="twitter:title" content="{{ $product['name'] }}" />
    <meta name="twitter:site" content="{{ $product['name'] }}" />
    <meta property="twitter:url" content="{{route('product',[$product->slug])}}">
    <meta name="distribution" content="Global">
    <meta name="Developed By" content="SOFTECH BD LTD" />
    <meta name="Developer" content="SOFTECH BD LTD Team" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="Nillgiri" />

    <link rel="stylesheet" href="{{asset('public/assets/front-end/css/product-details.css')}}"/>
    <style>
        .msg-option {
            display: none;
        }

        .chatInputBox {
            width: 100%;
        }

        .go-to-chatbox {
            width: 100%;
            text-align: center;
            padding: 5px 0px;
            display: none;
        }

        .feature_header {
            display: flex;
            justify-content: center;
        }

        .btn-number:hover {
            color: {{$web_config['secondary_color']}};

        }

        .for-total-price {
            margin- {{Session::get('direction') === "rtl" ? 'right' : 'left'}}: -30%;
        }

        .feature_header span {
            padding- {{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 15px;
            font-weight: 700;
            font-size: 25px;
            /* background-color: #ffffff; */
            text-transform: uppercase;
        }

        @media (max-width: 768px) {
            .feature_header span {
                margin-bottom: -40px;
            }

            .for-total-price {
                padding- {{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 30%;
            }

            .product-quantity {
                padding- {{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 4%;
            }

            .for-margin-bnt-mobile {
                margin- {{Session::get('direction') === "rtl" ? 'left' : 'right'}}: 7px;
            }

            .font-for-tab {
                font-size: 11px !important;
            }

            .pro {
                font-size: 13px;
            }
        }

        @media (max-width: 375px) {
            .for-margin-bnt-mobile {
                margin- {{Session::get('direction') === "rtl" ? 'left' : 'right'}}: 3px;
            }

            .for-discount {
                margin- {{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 10% !important;
            }

            .for-dicount-div {
                margin-top: -5%;
                margin- {{Session::get('direction') === "rtl" ? 'left' : 'right'}}: -7%;
            }

            .product-quantity {
                margin- {{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 4%;
            }

        }

        @media (max-width: 500px) {
            .for-dicount-div {
                margin-top: -4%;
                margin- {{Session::get('direction') === "rtl" ? 'left' : 'right'}}: -5%;
            }

            .for-total-price {
                margin- {{Session::get('direction') === "rtl" ? 'right' : 'left'}}: -20%;
            }

            .view-btn-div {

                margin-top: -9%;
                float: {{Session::get('direction') === "rtl" ? 'left' : 'right'}};
            }

            .for-discount {
                margin- {{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 7%;
            }

            .viw-btn-a {
                font-size: 10px;
                font-weight: 600;
            }

            .feature_header span {
                margin-bottom: -7px;
            }

            .for-mobile-capacity {
                margin- {{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 7%;
            }
        }

        img{
            border-radius: 7px;
        }

        .RelatedProduct{
            margin-bottom: 30px
        }

        @media screen and (max-width: 1024px) {
            .RelatedProduct{
                margin-bottom: 10px
            }
        }

        @media screen and (max-width: 991px) {
            .MarginTop{
                margin-top: 20px
            }
        }

        @media screen and (max-width: 767px) {
            .RelatedProduct{
                margin-bottom: 0px
            }

            .MarginTop{
                margin-top: 10px
            }
        }

        .delivary{
            background: white;
            /* box-shadow: 0 0 5px #c7c7c7; */
            padding: 10px;
            border-radius: 6px;
        }

        .delivary2{
            margin-top: 12px;
        }

        .delivary2 .PdpSellerInfoPc{
            display: flex;
            justify-content: space-between;
        }

        .delivary2 .PdpSellerInfoPc span{
            font-size: 14px;
        }

        .delivary2 .PdpSellerInfoPc h5{
            margin-bottom: 0;
            border: none;
        }

        .delivary h5{
            color: black;
            font-weight: 600;
            padding-bottom: 7px;
            margin-bottom: 1rem;
            border-bottom: 2px solid black;
        }

        .delivary div:not(:last-child){
            margin-bottom: 1rem;
        }

        .product-view-area ul li:not(:last-child){
            /* display: block; */
            margin-right: .4rem;
        }

        .delivary ul{
            padding: 0;
        }

        .delivary ul li{
            display: block;
            padding: 8px 0;
        }

        .delivary ul li i{
            margin-right: .5rem;
            font-size: 16px;
            margin-right: 0.5rem;
            font-size: 20px;
            color: black;
            font-weight: bold;
        }

        .delivary ul li:not(:last-child){
            border-bottom: 1px solid grey;
        }
    </style>
    
    <style>
        th, td {
            border-bottom: 1px solid #ddd;
            padding: 5px;
        }

        thead {
            background: {{$web_config['primary_color']}}                         !important;
            color: white;
        }
    </style>
@endpush

@section('content')
    <?php
    $overallRating = \App\CPU\ProductManager::get_overall_rating($product->reviews);
    $rating = \App\CPU\ProductManager::get_rating($product->reviews);
    ?>
    <!-- Page Content-->
    <div class="container setionPaddingTop2 setionPaddingBottom rtl" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
        <!-- General info tab-->
        <div class="row" style="direction: ltr">
            <!-- Product gallery-->
            <div class="col-lg-4 col-md-5 col-sm-5">
                <div class="cz-product-gallery">
                    <div class="cz-preview">
                        @if($product->images!=null)
                            @foreach (json_decode($product->images) as $key => $photo)
                                <div
                                    class="cz-preview-item d-flex align-items-center justify-content-center {{$key==0?'active':''}}"
                                    id="image{{$key}}">
                                    <img class="cz-image-zoom img-responsive"
                                         onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                         src="{{asset("storage/app/public/product/$photo")}}"
                                         data-zoom="{{asset("storage/app/public/product/$photo")}}"
                                         alt="Product image" width="">
                                    <div class="cz-image-zoom-pane"></div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <div class="cz">
                        <div class="container">
                            <div class="row">
                                <div class="table-responsive" data-simplebar style="max-height: 515px; padding: 1px;">
                                    <div class="d-flex">
                                        @if($product->images!=null)
                                            @foreach (json_decode($product->images) as $key => $photo)
                                                <div class="cz-thumblist">
                                                    <a class="cz-thumblist-item  {{$key==0?'active':''}} d-flex align-items-center justify-content-center "
                                                       href="#image{{$key}}">
                                                        <img
                                                            onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                                            src="{{asset("storage/app/public/product/$photo")}}"
                                                            alt="Product thumb">
                                                    </a>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product details-->
            <div class="col-lg-5 col-md-7 col-sm-6 mt-md-0 mt-sm-3" style="direction: {{ Session::get('direction') }}">
                <div class="details">
                    <h1 class="h3 mb-2">{{$product->name}}</h1>
                    <div class="d-flex align-items-center mb-2 pro">
                        <span
                            class="d-inline-block font-size-sm text-body align-middle mt-1 {{Session::get('direction') === "rtl" ? 'ml-md-2 ml-sm-0 pl-2' : 'mr-md-2 mr-sm-0 pr-2'}}">{{$overallRating[0]}}</span>
                        <div class="star-rating">
                            @for($inc=0;$inc<5;$inc++)
                                @if($inc<$overallRating[0])
                                    <i class="sr-star czi-star-filled active"></i>
                                @else
                                    <i class="sr-star czi-star"></i>
                                @endif
                            @endfor
                        </div>
                        <span
                            class="font-for-tab d-inline-block font-size-sm text-body align-middle mt-1 {{Session::get('direction') === "rtl" ? 'mr-1 ml-md-2 ml-1 pr-md-2 pr-sm-1 pl-md-2 pl-sm-1' : 'ml-1 mr-md-2 mr-1 pl-md-2 pl-sm-1 pr-md-2 pr-sm-1'}}">{{$overallRating[1]}} {{\App\CPU\translate('Reviews')}}</span>
                        <span style="width: 0px;height: 10px;border: 0.5px solid #707070; margin-top: 6px"></span>
                        <span
                            class="font-for-tab d-inline-block font-size-sm text-body align-middle mt-1 {{Session::get('direction') === "rtl" ? 'mr-1 ml-md-2 ml-1 pr-md-2 pr-sm-1 pl-md-2 pl-sm-1' : 'ml-1 mr-md-2 mr-1 pl-md-2 pl-sm-1 pr-md-2 pr-sm-1'}}">{{$countOrder}} {{\App\CPU\translate('orders')}}   </span>
                        <span style="width: 0px;height: 10px;border: 0.5px solid #707070; margin-top: 6px">    </span>
                        <span
                            class=" font-for-tab d-inline-block font-size-sm text-body align-middle mt-1 {{Session::get('direction') === "rtl" ? 'mr-1 ml-md-2 ml-0 pr-md-2 pr-sm-1 pl-md-2 pl-sm-1' : 'ml-1 mr-md-2 mr-0 pl-md-2 pl-sm-1 pr-md-2 pr-sm-1'}}">  {{$countWishlist}} {{\App\CPU\translate('wish')}} </span>

                    </div>
                    <div class="mb-3">
                        <span
                            class="h3 font-weight-normal text-accent {{Session::get('direction') === "rtl" ? 'ml-1' : 'mr-1'}}">
                            {{\App\CPU\Helpers::get_price_range($product) }}
                        </span>
                        @if($product->discount > 0)
                            <strike style="color: {{$web_config['secondary_color']}};">
                                {{\App\CPU\Helpers::currency_converter($product->unit_price)}}
                            </strike>
                        @endif
                    </div>

                    @if($product->discount > 0)
                        <div class="mb-3">
                            <strong>{{\App\CPU\translate('discount')}} : </strong>
                            <strong id="set-discount-amount"></strong>
                        </div>
                    @endif

                    <div class="mb-3">
                        <strong>{{\App\CPU\translate('Vat')}} : </strong>
                        <strong id="set-tax-amount"></strong>
                    </div>
                    <div class="mb-3">
                        <strong>{{\App\CPU\translate('Sold By')}} : </strong>
                        @if($product->added_by=='seller')
                            <a href="{{ route('shopView',[$product->seller->id]) }}">
                                {{$product->seller->shop->name}}
                            </a>
                        @else
                            <a href="{{ route('shopView',[0]) }}">
                                {{$web_config['name']->value}}
                            </a>
                           
                        @endif
                    </div>


                    <form id="add-to-cart-form" class="mb-2">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <div class="position-relative {{Session::get('direction') === "rtl" ? 'ml-n4' : 'mr-n4'}} mb-3">
                            @if (count(json_decode($product->colors)) > 0)
                                <div class="flex-start">
                                    <div class="product-description-label mt-2">{{\App\CPU\translate('color')}}:
                                    </div>
                                    <div>
                                        <ul class="list-inline checkbox-color mb-1 flex-start {{Session::get('direction') === "rtl" ? 'mr-2' : 'ml-2'}}"
                                            style="padding-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 0;">
                                            @foreach (json_decode($product->colors) as $key => $color)
                                                <div>
                                                    <li>
                                                        <input type="radio"
                                                               id="{{ $product->id }}-color-{{ $key }}"
                                                               name="color" value="{{ $color }}"
                                                               @if($key == 0) checked @endif>
                                                        <label style="background: {{ $color }};"
                                                               for="{{ $product->id }}-color-{{ $key }}"
                                                               data-toggle="tooltip"></label>
                                                    </li>
                                                </div>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                            @php
                                $qty = 0;
                                if(!empty($product->variation)){
                                foreach (json_decode($product->variation) as $key => $variation) {
                                        $qty += $variation->qty;
                                    }
                                }
                            @endphp
                        </div>
                        @foreach (json_decode($product->choice_options) as $key => $choice)
                            <div class="row flex-start mx-0">
                                <div
                                    class="product-description-label mt-2 {{Session::get('direction') === "rtl" ? 'pl-2' : 'pr-2'}}">{{ $choice->title }}
                                    :
                                </div>
                                <div>
                                    <ul class="list-inline checkbox-alphanumeric checkbox-alphanumeric--style-1 mb-2 mx-1 flex-start"
                                        style="padding-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 0;">
                                        @foreach ($choice->options as $key => $option)
                                            <div>
                                                <li class="for-mobile-capacity">
                                                    <input type="radio"
                                                           id="{{ $choice->name }}-{{ $option }}"
                                                           name="{{ $choice->name }}" value="{{ $option }}"
                                                           @if($key == 0) checked @endif >
                                                    <label style="font-size: .6em"
                                                           for="{{ $choice->name }}-{{ $option }}">{{ $option }}</label>
                                                </li>
                                            </div>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                    @endforeach

                    <!-- Quantity + Add to cart -->
                        <div class="row no-gutters">
                            <div class="col-2">
                                <div class="product-description-label mt-2">{{\App\CPU\translate('Quantity')}}:</div>
                            </div>
                            <div class="col-10">
                                <div class="product-quantity d-flex align-items-center">
                                    <div
                                        class="input-group input-group--style-2 {{Session::get('direction') === "rtl" ? 'pl-3' : 'pr-3'}}"
                                        style="width: 160px;">
                                        <span class="input-group-btn">
                                            <button class="btn btn-number" type="button"
                                                    data-type="minus" data-field="quantity"
                                                    disabled="disabled" style="padding: 10px">
                                                -
                                            </button>
                                        </span>
                                        <input type="text" name="quantity"
                                               class="form-control input-number text-center cart-qty-field"
                                               placeholder="1" value="1" min="1" max="100">
                                        <span class="input-group-btn">
                                            <button class="btn btn-number" type="button" data-type="plus"
                                                    data-field="quantity" style="padding: 10px">
                                               +
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row flex-start no-gutters d-none mt-2" id="chosen_price_div">
                            <div class="{{Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'}}">
                                <div class="product-description-label">{{\App\CPU\translate('total_price')}}:</div>
                            </div>
                            <div>
                                <div class="product-price for-total-price">
                                    <strong id="chosen_price"></strong>
                                </div>
                            </div>

                            <div class="col-12">
                                @if($product['current_stock']<=0)
                                    <h5 class="mt-3" style="color: red">{{\App\CPU\translate('out_of_stock')}}</h5>
                                @endif
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-2">
                            <body onload="viewItemsDetailTrack({{$product}})"></body>
                            <button
                                class="btn btn-secondary element-center btn-gap-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}"
                                onclick="buy_now()"
                                type="button"
                                style="width:37%; height: 45px">
                                <span class="string-limit">{{\App\CPU\translate('buy_now')}}</span>
                            </button>
                            <button
                                class="btn btn-primary element-center btn-gap-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}"
                                onclick="addToCart();addToCartData({{$product}})"
                                type="button"
                                style="width:37%; height: 45px">
                                <span class="string-limit">{{\App\CPU\translate('add_to_cart')}}</span>
                            </button>
                            <button type="button" onclick="addWishlist('{{$product['id']}}')"
                                    class="btn btn-dark for-hover-bg"
                                    style="">
                                <i class="fa fa-heart-o {{Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'}}"
                                   aria-hidden="true"></i>
                                <span class="countWishlist-{{$product['id']}}">{{$countWishlist}}</span>
                            </button>
                        </div>
                    </form>
                    <hr style="padding-bottom: 10px">
                    <div style="text-align:{{Session::get('direction') === "rtl" ? 'right' : 'left'}};"
                         class="sharethis-inline-share-buttons"></div>
                </div>
            </div>

            
            <div class="col-lg-3 col-md-0 col-sm-0 MarginTop">
                <div class="delivary">
                    <div>
                        <h5>
                            Delivery Charge: 
                            </h5>
                        <ul>
                            <li>
                                <i class=" czi-add-location"></i> 
                                Inside Dhaka : Taka 60 (1-5 Days)
                            </li>
                            <li>
                                <i class="czi-send"></i>
                                Outside Dhaka : Taka 120 (1-7 Days)
                            </li>
                            <li>
                                <i class="czi-money-bag"></i>
                                Cash on Delivery available
                            </li>
                        </ul>
                    </div>
    
                    <div>
                        <h5><i class="fa-solid fa-person-walking-arrow-loop-left"></i> Return & Warranty: </h5>
                        <ul>
                            <li>
                                <!-- <i class="fa-solid fa-hand"></i> -->
                                <i class="fa fa-lock"></i>
                                7 Days Returns Change of mind is not applicable
                            </li>
                            <li>
                                <i class="czi-security-prohibition"></i>
                                Warranty not available
                            </li>
                            <li>
                                <i class="czi-dollar-circle"></i>
                                Cash on Delivery available
                            </li>
                        </ul>
                    </div>
                </div>
                        
                <!--<div class="delivary delivary2">-->
                <!--    <div>-->
                <!--        <span>Sold by</span>-->
                <!--        <h5>FRESHED Fashion</h5>-->
                <!--    </div>-->
                            
                <!--    <div class="PdpSellerInfoPc">-->
                <!--        <div>-->
                <!--            <span>Positive Seller Ratings</span>-->
                <!--            <h5>92%</h5>-->
                <!--        </div>-->
                <!--        <div>-->
                <!--            <span>Ship on Time</span>-->
                <!--            <h5>100%</h5>-->
                <!--        </div>-->
                <!--        <div>-->
                <!--            <span>Chat Response Rate</span>-->
                <!--            <h5>80%</h5>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                
                <div class="delivary delivary2">
                    <div>
                        <span>Sold by</span>
                        <h5>
                            @if($product->added_by=='seller')
                                <a href="{{ route('shopView',[$product->seller->id]) }}">
                                    {{$product->seller->shop->name}}
                                </a>
                            @else
                                <a href="{{ route('shopView',[0]) }}">
                                    {{$web_config['name']->value}}
                                </a>

                            @endif
                        </h5>
                    </div>
                    {{--Seller Ratings start--}}
                    @php
                        $id = $product->seller->id;
                        $product_ids = \App\Model\Product::active()
                            ->when($id == 0, function ($query) {
                                return $query->where(['added_by' => 'admin']);
                            })
                            ->when($id != 0, function ($query) use ($id) {
                                return $query->where(['added_by' => 'seller'])
                                    ->where('user_id', $id);
                            })
                            ->pluck('id')->toArray();
                        $sum_rating = \App\Model\Review::whereIn('product_id', $product_ids)->sum('rating');
                        $percentance_add = $sum_rating * 20;
                        $rating_product_count = \App\Model\Review::whereIn('product_id', $product_ids)->count('rating');
                        $data = ($sum_rating === 0) ? 0:$sum_rating / $rating_product_count;
                        $sellerRating = $data * 20;
                    @endphp
                    {{--Seller Ratings start end--}}

                    {{--Ship on time start--}}
                    @php
                        $id = $product->seller->id;
                        $all_order_delivery_ids = \App\Model\Order::
                            when($id == 0, function ($query) {
                                return $query->where(['seller_is' => 'admin']);
                            })
                            ->when($id != 0, function ($query) use ($id) {
                                return $query->where(['seller_is' => 'seller'])
                                    ->where('seller_id', $id)
                                    ->where('order_status', 'delivered');
                            })
                            ->count();

                        $on_time_delivery_ids = \App\Model\Order::whereRaw("TIMESTAMPDIFF(DAY, created_at, updated_at) <= 7")
                        ->where('seller_id', $id)
                         ->where('order_status', 'delivered')
                        ->count();
                        $shipping_on_time = (($on_time_delivery_ids===0) ? 1:$on_time_delivery_ids / $all_order_delivery_ids) * 100;
                    @endphp
                    {{--Ship on time end--}}

                    {{--Chat response rate start--}}
                    @php
                        $shop_id = $product->seller->shop->id;
                        $seller_id = $product->seller->id;
                        $seller_response = \App\Model\Chatting::where('shop_id', $shop_id)->where('seller_id', $seller_id)->where('sent_by_seller', 1)->count();
                        $customer_response = \App\Model\Chatting::where('shop_id', $shop_id)->where('seller_id', $seller_id)->where('sent_by_customer', 1)->count();
                        $chat_response= ( ($seller_response===0) ? 1:$seller_response / $customer_response) * 100;
                    @endphp
                    {{--Chat response rate end--}}

                    <div class="PdpSellerInfoPc">
                        <div>
                            <span>Positive Seller Ratings</span>
                            <h5>{{$sellerRating}}%</h5>
                        </div>
                        <div>
                            <span>Ship on Time</span>
                            <h5>{{number_format($shipping_on_time)}}%</h5>
                        </div>
                        <div>
                            <span>Chat Response Rate</span>
                            <h5>{{$chat_response<100 ? number_format($chat_response): 100 }}%</h5>
                        </div>
                    </div>
                    @if($product->added_by=='seller')
                        <a class="btn btn-secondary element-center btn-gap-right" href="{{ route('shopView',[$product->seller->id]) }}">
                            View Shop
                        </a>
                    @else
                        <a class="btn btn-secondary element-center btn-gap-right" href="{{ route('shopView',[0]) }}">
                            View Shop
                        </a>
                    @endif
                </div>
                
                
            </div>
        </div>
    </div>

    {{--overview--}}
    <div class="container setionPaddingBottom rtl" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
        <div class="row" style="background: white;border-radius: 7px;">
            <div class="col-12">
                <div class="product_overview mt-1">
                    <!-- Tabs-->
                    <ul class="nav nav-tabs d-flex" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#overview" data-toggle="tab" role="tab"
                               style="color: black !important;">
                                {{\App\CPU\translate('OVERVIEW')}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#reviews" data-toggle="tab" role="tab"
                               style="color: black !important;">
                                {{\App\CPU\translate('REVIEWS')}}
                            </a>
                        </li>
                    </ul>
                    <div class="px-4 pt-lg-3 pb-3 mb-3">
                        <div class="tab-content px-lg-3">
                            <!-- Tech specs tab-->
                            <div class="tab-pane fade show active" id="overview" role="tabpanel">
                                <div class="row pt-2 specification">
                                    @if($product->video_url!=null)
                                        <div class="col-12 mb-4">
                                            <iframe width="420" height="315"
                                                    src="{{$product->video_url}}">
                                            </iframe>
                                        </div>
                                    @endif

                                    <div class="col-lg-12 col-md-12">
                                        {!! $product['details'] !!}
                                    </div>
                                </div>
                            </div>
                            <!-- Reviews tab-->
                            <div class="tab-pane fade" id="reviews" role="tabpanel">
                                <div class="row pt-2 pb-3">
                                    <div class="col-lg-4 col-md-5 ">
                                        <h2 class="overall_review mb-2">{{$overallRating[1]}}
                                            &nbsp{{\App\CPU\translate('Reviews')}} </h2>
                                        <div
                                            class="star-rating {{Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'}}">
                                            @if (round($overallRating[0])==5)
                                                @for ($i = 0; $i < 5; $i++)
                                                    <i class="czi-star-filled font-size-sm text-accent {{Session::get('direction') === "rtl" ? 'ml-1' : 'mr-1'}}"></i>
                                                @endfor
                                            @endif
                                            @if (round($overallRating[0])==4)
                                                @for ($i = 0; $i < 4; $i++)
                                                    <i class="czi-star-filled font-size-sm text-accent {{Session::get('direction') === "rtl" ? 'ml-1' : 'mr-1'}}"></i>
                                                @endfor
                                                <i class="czi-star font-size-sm text-muted {{Session::get('direction') === "rtl" ? 'ml-1' : 'mr-1'}}"></i>
                                            @endif
                                            @if (round($overallRating[0])==3)
                                                @for ($i = 0; $i < 3; $i++)
                                                    <i class="czi-star-filled font-size-sm text-accent {{Session::get('direction') === "rtl" ? 'ml-1' : 'mr-1'}}"></i>
                                                @endfor
                                                @for ($j = 0; $j < 2; $j++)
                                                    <i class="czi-star font-size-sm text-accent {{Session::get('direction') === "rtl" ? 'ml-1' : 'mr-1'}}"></i>
                                                @endfor
                                            @endif
                                            @if (round($overallRating[0])==2)
                                                @for ($i = 0; $i < 2; $i++)
                                                    <i class="czi-star-filled font-size-sm text-accent {{Session::get('direction') === "rtl" ? 'ml-1' : 'mr-1'}}"></i>
                                                @endfor
                                                @for ($j = 0; $j < 3; $j++)
                                                    <i class="czi-star font-size-sm text-accent {{Session::get('direction') === "rtl" ? 'ml-1' : 'mr-1'}}"></i>
                                                @endfor
                                            @endif
                                            @if (round($overallRating[0])==1)
                                                @for ($i = 0; $i < 4; $i++)
                                                    <i class="czi-star font-size-sm text-accent {{Session::get('direction') === "rtl" ? 'ml-1' : 'mr-1'}}"></i>
                                                @endfor
                                                <i class="czi-star-filled font-size-sm text-accent {{Session::get('direction') === "rtl" ? 'ml-1' : 'mr-1'}}"></i>
                                            @endif
                                            @if (round($overallRating[0])==0)
                                                @for ($i = 0; $i < 5; $i++)
                                                    <i class="czi-star font-size-sm text-muted {{Session::get('direction') === "rtl" ? 'ml-1' : 'mr-1'}}"></i>
                                                @endfor
                                            @endif
                                        </div>
                                        <span class="d-inline-block align-middle">
                                    {{$overallRating[0]}} {{\App\CPU\translate('Overall')}} {{\App\CPU\translate('rating')}}
                                </span>
                                    </div>
                                    <div class="col-lg-8 col-md-7 pt-sm-3 pt-md-0">
                                        <div class="d-flex align-items-center mb-2">
                                            <div
                                                class="text-nowrap {{Session::get('direction') === "rtl" ? 'ml-3' : 'mr-3'}}"><span
                                                    class="d-inline-block align-middle text-muted">{{\App\CPU\translate('5')}}</span><i
                                                    class="czi-star-filled font-size-xs {{Session::get('direction') === "rtl" ? 'mr-1' : 'ml-1'}}"></i>
                                            </div>
                                            <div class="w-100">
                                                <div class="progress" style="height: 4px;">
                                                    <div class="progress-bar bg-success" role="progressbar"
                                                         style="width: <?php echo $widthRating = ($rating[0] != 0) ? ($rating[0] / $overallRating[1]) * 100 : (0); ?>%;"
                                                         aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <span
                                                class="text-muted {{Session::get('direction') === "rtl" ? 'mr-3' : 'ml-3'}}">
                                        {{$rating[0]}}
                                    </span>
                                        </div>

                                        <div class="d-flex align-items-center mb-2">
                                            <div
                                                class="text-nowrap {{Session::get('direction') === "rtl" ? 'ml-3' : 'mr-3'}}"><span
                                                    class="d-inline-block align-middle text-muted">{{\App\CPU\translate('4')}}</span><i
                                                    class="czi-star-filled font-size-xs {{Session::get('direction') === "rtl" ? 'mr-1' : 'ml-1'}}"></i>
                                            </div>
                                            <div class="w-100">
                                                <div class="progress" style="height: 4px;">
                                                    <div class="progress-bar" role="progressbar"
                                                         style="width: <?php echo $widthRating = ($rating[1] != 0) ? ($rating[1] / $overallRating[1]) * 100 : (0); ?>%; background-color: #a7e453;"
                                                         aria-valuenow="27" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <span
                                                class="text-muted {{Session::get('direction') === "rtl" ? 'mr-3' : 'ml-3'}}">
                                       {{$rating[1]}}
                                    </span>
                                        </div>

                                        <div class="d-flex align-items-center mb-2">
                                            <div
                                                class="text-nowrap {{Session::get('direction') === "rtl" ? 'ml-3' : 'mr-3'}}"><span
                                                    class="d-inline-block align-middle text-muted">{{\App\CPU\translate('3')}}</span><i
                                                    class="czi-star-filled font-size-xs ml-1"></i></div>
                                            <div class="w-100">
                                                <div class="progress" style="height: 4px;">
                                                    <div class="progress-bar" role="progressbar"
                                                         style="width: <?php echo $widthRating = ($rating[2] != 0) ? ($rating[2] / $overallRating[1]) * 100 : (0); ?>%; background-color: #ffda75;"
                                                         aria-valuenow="17" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <span
                                                class="text-muted {{Session::get('direction') === "rtl" ? 'mr-3' : 'ml-3'}}">
                                        {{$rating[2]}}
                                    </span>
                                        </div>

                                        <div class="d-flex align-items-center mb-2">
                                            <div
                                                class="text-nowrap {{Session::get('direction') === "rtl" ? 'ml-3' : 'mr-3'}}"><span
                                                    class="d-inline-block align-middle text-muted">{{\App\CPU\translate('2')}}</span><i
                                                    class="czi-star-filled font-size-xs {{Session::get('direction') === "rtl" ? 'mr-1' : 'ml-1'}}"></i>
                                            </div>
                                            <div class="w-100">
                                                <div class="progress" style="height: 4px;">
                                                    <div class="progress-bar" role="progressbar"
                                                         style="width: <?php echo $widthRating = ($rating[3] != 0) ? ($rating[3] / $overallRating[1]) * 100 : (0); ?>%; background-color: #fea569;"
                                                         aria-valuenow="9" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <span
                                                class="text-muted {{Session::get('direction') === "rtl" ? 'mr-3' : 'ml-3'}}">
                                    {{$rating[3]}}
                                    </span>
                                        </div>

                                        <div class="d-flex align-items-center">
                                            <div
                                                class="text-nowrap {{Session::get('direction') === "rtl" ? 'ml-3' : 'mr-3'}}"><span
                                                    class="d-inline-block align-middle text-muted">{{\App\CPU\translate('1')}}</span><i
                                                    class="czi-star-filled font-size-xs {{Session::get('direction') === "rtl" ? 'mr-1' : 'ml-1'}}"></i>
                                            </div>
                                            <div class="w-100">
                                                <div class="progress" style="height: 4px;">
                                                    <div class="progress-bar bg-danger" role="progressbar"
                                                         style="width: <?php echo $widthRating = ($rating[4] != 0) ? ($rating[4] / $overallRating[1]) * 100 : (0); ?>%;"
                                                         aria-valuenow="4" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <span
                                                class="text-muted {{Session::get('direction') === "rtl" ? 'mr-3' : 'ml-3'}}">
                                       {{$rating[4]}}
                                    </span>
                                        </div>
                                    </div>
                                </div>
                                <hr class="mt-4 pb-4 mb-3">
                                <div class="row pb-4">
                                    <div class="col-12">
                                        @foreach($product->reviews as $productReview)
                                            <div class="single_product_review p-2" style="margin-bottom: 20px">
                                                <div class="product-review d-flex justify-content-between">
                                                    <div
                                                        class="d-flex mb-3 {{Session::get('direction') === "rtl" ? 'pl-5' : 'pr-5'}}">
                                                        <div
                                                            class="media media-ie-fix align-items-center {{Session::get('direction') === "rtl" ? 'ml-4 pl-2' : 'mr-4 pr-2'}}">
                                                            <img style="max-height: 64px;"
                                                                 class="rounded-circle" width="64"
                                                                 onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                                                 src="{{asset("storage/app/public/profile")}}/{{(isset($productReview->user)?$productReview->user->image:'')}}"
                                                                 alt="{{isset($productReview->user)?$productReview->user->f_name:'not exist'}}"/>
                                                            <div
                                                                class="media-body {{Session::get('direction') === "rtl" ? 'pr-3' : 'pl-3'}}">
                                                                <h6 class="font-size-sm mb-0">{{isset($productReview->user)?$productReview->user->f_name:'not exist'}}</h6>
                                                                <div class="d-flex justify-content-between">
                                                                    <div
                                                                        class="product_review_rating">{{$productReview->rating}}</div>
                                                                    <div class="star-rating">
                                                                        @for($inc=0;$inc<5;$inc++)
                                                                            @if($inc<$productReview->rating)
                                                                                <i class="sr-star czi-star-filled active"></i>
                                                                            @else
                                                                                <i class="sr-star czi-star"></i>
                                                                            @endif
                                                                        @endfor
                                                                    </div>
                                                                </div>

                                                                <div class="font-size-ms text-muted">
                                                                    {{$productReview->created_at->format('M d Y')}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <p class="font-size-md mt-3 mb-2">{{$productReview->comment}}</p>
                                                        @if (!empty(json_decode($productReview->attachment)))
                                                            @foreach (json_decode($productReview->attachment) as $key => $photo)
                                                                <img
                                                                    style="cursor: pointer;border-radius: 5px;border:1px;border-color: #7a6969; height: 67px ; margin-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}: 5px;"
                                                                    onclick="showInstaImage('{{asset("storage/app/public/review/$photo")}}')"
                                                                    class="cz-image-zoom"
                                                                    onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                                                    src="{{asset("storage/app/public/review/$photo")}}"
                                                                    alt="Product review" width="67">
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        @if(count($product->reviews)==0)
                                            <div class="card">
                                                <div class="card-body">
                                                    <h6 class="text-danger text-center">{{\App\CPU\translate('product_review_not_available')}}</h6>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Product carousel (You may also like)-->
    <div class="container rtl" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
        <div class="flex-between setionPaddingBottom">
            <div class="feature_header">
                <span>{{ \App\CPU\translate('similar_products')}}</span>
            </div>

            <div class="view_all ">
                <div>
                    @php($category=json_decode($product['category_ids']))
                    <a class="btn btn-outline-accent btn-sm viw-btn-a"
                       href="{{route('products',['id'=> $category[0]->id,'data_from'=>'category','page'=>1])}}">{{ \App\CPU\translate('view_all')}}
                        <i class="czi-arrow-{{Session::get('direction') === "rtl" ? 'left mr-1 ml-n1' : 'right ml-1 mr-n1'}}"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- Grid-->
        
        <!-- Product-->
        <div class="row">
            @if (count($relatedProducts)>0)
                @foreach($relatedProducts as $key => $relatedProduct)
                    <div class="col-xl-2 col-sm-3 col-6" style="margin-bottom: 20px">
                        @include('web-views.partials._single-product',['product'=>$relatedProduct])
                    </div>
                @endforeach
            @else
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="text-danger text-center">{{\App\CPU\translate('similar')}} {{\App\CPU\translate('product_not_available')}}</h6>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="modal fade rtl" id="show-modal-view" tabindex="-1" role="dialog" aria-labelledby="show-modal-image"
         aria-hidden="true" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body" style="display: flex;justify-content: center">
                    <button class="btn btn-default"
                            style="border-radius: 50%;margin-top: -25px;position: absolute;{{Session::get('direction') === "rtl" ? 'left' : 'right'}}: -7px;"
                            data-dismiss="modal">
                        <i class="fa fa-close"></i>
                    </button>
                    <img class="element-center" id="attachment-view" src="">
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')

    <script type="text/javascript">
        cartQuantityInitialize();
        getVariantPrice();
        $('#add-to-cart-form input').on('change', function () {
            getVariantPrice();
        });

        function showInstaImage(link) {
            $("#attachment-view").attr("src", link);
            $('#show-modal-view').modal('toggle')
        }
    </script>

    {{-- Messaging with shop seller --}}
    <script>
        $('#contact-seller').on('click', function (e) {
            // $('#seller_details').css('height', '200px');
            $('#seller_details').animate({'height': '276px'});
            $('#msg-option').css('display', 'block');
        });
        $('#sendBtn').on('click', function (e) {
            e.preventDefault();
            let msgValue = $('#msg-option').find('textarea').val();
            let data = {
                message: msgValue,
                shop_id: $('#msg-option').find('textarea').attr('shop-id'),
                seller_id: $('.msg-option').find('.seller_id').attr('seller-id'),
            }
            if (msgValue != '') {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "post",
                    url: '{{route('messages_store')}}',
                    data: data,
                    success: function (respons) {
                        console.log('send successfully');
                    }
                });
                $('#chatInputBox').val('');
                $('#msg-option').css('display', 'none');
                $('#contact-seller').find('.contact').attr('disabled', '');
                $('#seller_details').animate({'height': '125px'});
                $('#go_to_chatbox').css('display', 'block');
            } else {
                console.log('say something');
            }
        });
        $('#cancelBtn').on('click', function (e) {
            e.preventDefault();
            $('#seller_details').animate({'height': '114px'});
            $('#msg-option').css('display', 'none');
        });
    </script>

    <script type="text/javascript"
            src="https://platform-api.sharethis.com/js/sharethis.js#property=5f55f75bde227f0012147049&product=sticky-share-buttons"
            async="async"></script>
            
    <script type="text/javascript">
        function addToCartData (data) {
            // console.log('data', data);
            // let dataLayer;
            dataLayer.push({ ecommerce: null }); // Clear the previous ecommerce object.
            dataLayer.push({
                event: "add_to_cart",
                ecommerce: {
                    items: [{
                        item_name: data['name'], // Name or ID is required.
                        Item_id: data['id'],
                        currency: 'BDT',
                        price: data['purchase_price'],
                        quantity : data['min_qty'],
                        item_list_id: data['id'],
            // item_brand: data['brand']?.['name'] || "",
            // item_category: data['categories']?. [0]?. ['name'] || "",
            // item_category2: data['categories']?.[1]?.['name'] || "",
            // item_category3: data['categories']?. [2]?.['name'] || "",
            // item_category4: data['categories']?. [3]?.['name'] || "" ,
            // item_variant:"",
                // item_list_name:"",  // If associated with a list selection.
            // item_list_id:"", // If associated with a list selection.
                // index: 0, // If associated with a list selection.


        }]
        }
        });
        }
    </script>
    <script type="text/javascript">
        function viewItemsDetailTrack (data) {
            console.log('viewItemsDetailTrack', data);
            dataLayer.push({ ecommerce: null });  // Clear the previous ecommerce object.
            dataLayer.push({
                event: "view_item",
                ecommerce: {
                    items: [
                        {
                            item_id: data['id'],
                            item_name: data['name'],
                            affiliation: "Google Merchandise Store",
                            coupon: "SUMMER_FUN",
                            currency: "BDT",
                            discount: data['discount'],
                            // index: 0,
                            // item_brand: "Google",
                            // item_category: "Apparel",
                            // item_category2: "Adult",
                            // item_category3: "Shirts",
                            // item_category4: "Crew",
                            // item_category5: "Short sleeve",
                            // item_list_id: "related_products",
                            // item_list_name: "Related Products",
                            // item_variant: "green",
                            // location_id: "ChIJIQBpAG2ahYAR_6128GcTUEo",
                            price: data['purchase_price'],
                            quantity : data['min_qty'],
                        }
                    ]
                }
            });
        }
    </script>
            
@endpush
