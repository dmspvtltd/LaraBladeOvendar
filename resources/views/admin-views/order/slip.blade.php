
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Slip</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!--favicon-->
    <link rel="shortcut icon" type="image/x-icon" href="img/LOGO%20Asset%2013ldpi.png">
    <style>
        /* page */
        html {
            font-family: 'Open Sans', sans-serif;
            overflow: auto;
            padding: 0.5in;
            background: #999;
            cursor: default;
        }

        body {
            box-sizing: border-box;
            height: 11in;
            margin: 0 auto;
            overflow: hidden;
            padding: 0.5in;
            width: 8.5in;
            background: #FFF;
            border-radius: 1px;
            box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
        }

        @media print {

            * {
                -webkit-print-color-adjust: exact;
            }

            html {
                background: none;
                padding: 0;
                font-weight: 500;
                font-size: 14px;
            }

            body {
                box-shadow: none;
                margin: 0;
            }

        }

        @page {
            margin: 0;
        }

        /* header */
        /* main css */


        .main-table,
        td {
            border: 2px solid black;
            border-collapse: collapse;
            text-align: center;
            font-weight: 600;
            padding: 3px;
        }

        table {
            width: 100%;
            padding: 0;
            margin: 0;
        }

        table p {
            margin: 0;
            font-size: 18px;
            font-weight: 500;
            line-height: 16px;
            padding-bottom: 5px;
        }

        table h6 {
            margin: 0;
            font-size: 12px;
            font-weight: bold;
        }

        table h4 {
            margin: 0;
            font-size: 25px;
            line-height: 24px;
        }

        .text-left {
            padding: 0 80px;
        }

        .text-left img {
            width: 100%;
        }

        /* end main css */

    </style>
</head>

<body>
    @php
    use App\Model\BusinessSetting;
        $company_phone =BusinessSetting::where('type', 'company_phone')->first()->value;
        $company_email =BusinessSetting::where('type', 'company_email')->first()->value;
        $company_name =BusinessSetting::where('type', 'company_name')->first()->value;
        $company_web_logo =BusinessSetting::where('type', 'company_web_logo')->first()->value;
        $company_mobile_logo =BusinessSetting::where('type', 'company_mobile_logo')->first()->value;
    @endphp
    <section>
        <table class="main-table">
            <tr>
                <td colspan="2">
                    <img src="{{asset("storage/app/public/company/$company_web_logo")}}" alt="" height="70" width="200">
                </td>
                <td colspan="2">
                    <h6>Order Number</h6>
                    <p>{{ $order->id }}</p>
                </td>
                <td colspan="2">
                    <p> {{ date('d-M-y',strtotime($order->created_at)) }}</p>
                </td>
            </tr>
            <tr>
                <td colspan="6" class="text-left">
                    <img src="1.png" alt="">
                    
                </td>
            </tr>
            <tr>
                <td colspan="4" rowspan="6" class="text-left">
                    <img src="2.png" alt="">
                    <h4 class="port-code">Port Code: D-045-0001</h4>
                </td>
                <td colspan="2">DHAKA</td>

            </tr>
            <tr>
                <td colspan="2">Standard</td>

            </tr>
            <tr>
                <td colspan="2">-</td>

            </tr>
            <tr>
                <td colspan="2">-</td>

            </tr>
            <tr>
                <td colspan="2">COD</td>

            </tr>
            <tr>
                <td colspan="2"> {{ number_format($order->order_amount,2) }} </td>

            </tr>
            <tr>
                <td colspan="6" class="text-left">
                    <img src="{{asset('storage/app/public/orders/3.png')}}" alt="">
                    
                </td>
            </tr>
            <tr>
                <td colspan="2" rowspan="3"><img src="{{asset('storage/app/public/orders/4.png')}}" alt=""></td>
                <td colspan="4"><b>Customer:</b>  
                    {{$order->customer['f_name'].' '.$order->customer['l_name']}} ,
                    {{$order->customer['email']}},
                    {{$order->customer['phone']}},
                    {{$order->shippingAddress ? $order->shippingAddress['address'] : ""}},
                    {{$order->shippingAddress ? $order->shippingAddress['city'] : ""}},
                    {{$order->shippingAddress ? $order->shippingAddress['zip'] : ""}},
                    {{$order->shippingAddress ? $order->shippingAddress['country'] : ""}}
                </td>
            </tr>
            <tr>

                <td colspan="4">
                    <b>Seller: </b>  
                </td>

            </tr>
            <tr>
                <td colspan="3"><b>Package Weight: </b>0.20</td>
                <td>1</td>

            </tr>
        </table>
    </section>



</body>

</html>
