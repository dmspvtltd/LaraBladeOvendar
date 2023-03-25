<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Model\OrderDetail;
use App\Model\Seller;
use Illuminate\Http\Request;
use App\CPU\Helpers;

class PaymentController extends Controller
{
    public function due(){
        $data['payment_dues'] =  OrderDetail::where('seller_id', auth('seller')->id())->where('payment_status','unpaid')->paginate(Helpers::pagination_limit());
        return view('seller-views.payment.due',$data);
    }
}
