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

            <h1 class="text-center"><b>Return and Refund Policy</b></h1>
            Thank you for shopping at nillgiri.<br>

            If, for any reason, You are not completely satisfied with a purchase We invite You to review our policy on refunds and returns. This Return and Refund Policy has been created with the help of the TermsFeed Return and Refund Policy Generator.<br><br>
            The following terms are applicable for any products that You purchased with Us.<br><br>

            <h2><b>Interpretation and Definitions</b></h2>

            <h3><b>Interpretation</b></h3>

            The words of which the initial letter is capitalized have meanings defined under the following conditions. The following definitions shall have the same meaning regardless of whether they appear in singular or in plural.
            <br><br><h2><b>Definitions</b></h2>
            For the purposes of this Return and Refund Policy:<br><br>
            Company (referred to as either "the Company", "We", "Us" or "Our" in this Agreement) refers to Nillgiri Online Shopping Mall, Level-01, Block-D, Shop-73, Farmgate, Dhaka...
            Goods refer to the items offered for sale on the Service.
            Orders mean a request by You to purchase Goods from Us.
            Service refers to the Website.
            Website refers to nillgiri, accessible from https://www.nillgiri.com/
            You means the individual accessing or using the Service, or the company, or other legal entity on behalf of which such individual is accessing or using the Service, as applicable.<br><br>
            <h2><b>Your Order Cancellation Rights</b></h2>
            You are entitled to cancel Your Order within 7 days without giving any reason for doing so.
            The deadline for cancelling an Order is 7 days from the date on which You received the Goods or on which a third party you have appointed, who is not the carrier, takes possession of the product delivered.
            In order to exercise Your right of cancellation, You must inform Us of your decision by means of a clear statement. You can inform us of your decision by:
            By visiting this page on our website: https://www.nillgiri.com/
            We will reimburse You no later than 14 days from the day on which We receive the returned Goods. We will use the same means of payment as You used for the Order, and You will not incur any fees for such reimbursement.<br><br>

            <br><h2><b>Conditions for Returns</b></h2>
            In order for the Goods to be eligible for a return, please make sure that:
            The Goods were purchased in the last 7 days
            The Goods are in the original packaging
            The following Goods cannot be returned:
            The supply of Goods made to Your specifications or clearly personalized.
            The supply of Goods which according to their nature are not suitable to be returned, deteriorate rapidly or where the date of expiry is over.
            The supply of Goods which are not suitable for return due to health protection or hygiene reasons and were unsealed after delivery.
            The supply of Goods which are, after delivery, according to their nature, inseparably mixed with other items.
            We reserve the right to refuse returns of any merchandise that does not meet the above return conditions in our sole discretion.
            Only regular priced Goods may be refunded. Unfortunately, Goods on sale cannot be refunded. This exclusion may not apply to You if it is not permitted by applicable law.<br><br>

            <br><h2><b>Returning Goods</b></h2>
            You are responsible for the cost and risk of returning the Goods to Us. You should send the Goods at the following address:
            https://www.nillgiri.com/
            We cannot be held responsible for Goods damaged or lost in return shipment. Therefore, We recommend an insured and trackable mail service. We are unable to issue a refund without actual receipt of the Goods or proof of received return delivery.

            <br><br><h2><b>Gifts</b></h2>
            If the Goods were marked as a gift when purchased and then shipped directly to you, You'll receive a gift credit for the value of your return. Once the returned product is received, a gift certificate will be mailed to You.
            If the Goods weren't marked as a gift when purchased, or the gift giver had the Order shipped to themselves to give it to You later, We will send the refund to the gift giver.

            <br><br><h2><b>Contact Us</b></h2>
            If you have any questions about our Returns and Refunds Policy, please contact us:
            By visiting this page on our website: https://www.nillgiri.com/





        </div>
    </div>
@endsection
