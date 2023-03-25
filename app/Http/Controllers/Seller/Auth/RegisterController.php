<?php

namespace App\Http\Controllers\Seller\Auth;

use App\CPU\Helpers;
use App\CPU\ImageManager;
use App\Http\Controllers\Controller;
use App\Model\BusinessSetting;
use App\Model\PhoneOrEmailVerification;
use App\Model\Seller;
use App\Model\Shop;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use function App\CPU\translate;

class RegisterController extends Controller
{
    public function create()
    {
        return view('seller-views.auth.register');
    }

    public function store(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'phone' => 'required|unique:sellers',
            'busness_type' => 'required',
            'shop_name' => 'required',
            'email' => 'required|unique:sellers',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
        ]);

        DB::transaction(function ($r) use ($request) {

            $seller = new Seller();

            $countdata = Seller::count();

            if($countdata>0)
            {
                $lastdata = Seller::latest()->first();
                $selleruid = "NG".(substr($lastdata->selleruid,2)+1);
                $seller->selleruid = $selleruid;
            }
            else{
                $selleruid = "NG2200001";
                $seller->selleruid = $selleruid;
            }



            $seller->f_name = $request->f_name;
            $seller->l_name = $request->l_name;
            $seller->phone  = $request->phone;
            $seller->email  = $request->email;
            $seller->shop_name = $request->shop_name;
            $seller->busness_type = $request->busness_type;
            $seller->password = bcrypt($request->password);
            $seller->status = "pending";
            $seller->save();

            $shop = new Shop();
            $shop->seller_id = $seller->id;
            $shop->name = $request->shop_name;
            $shop->contact = $request->phone;
            $shop->save();

            DB::table('seller_wallets')->insert([
                'seller_id' => $seller['id'],
                'withdrawn' => 0,
                'commission_given' => 0,
                'total_earning' => 0,
                'pending_withdraw' => 0,
                'delivery_charge_earned' => 0,
                'collected_cash' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

//            $phone_verification = Helpers::get_business_settings('phone_verification');
//
//            if ($phone_verification && !$seller->is_phone_verified) {
////                dd($seller->id);
//                return redirect()->route('shop.seller.check', [$seller->id]);
//            }

        });


        $lastdata = Seller::latest()->first();
        $phone_verification = Helpers::get_business_settings('phone_verification');

        if ($phone_verification && !$lastdata->is_phone_verified) {
            return redirect()->route('shop.seller.check', [$lastdata->id]);
        }

        Toastr::success('Shop apply successfully!');
        return redirect()->route('seller.auth.login');
    }

    public static function check($id)
    {
        $user = Seller::find($id);

        $token = rand(1000, 9999);
        DB::table('phone_or_email_verifications')->insert([
            'phone_or_email' => $user->phone,
            'token' => $token,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $phone_verification = Helpers::get_business_settings('phone_verification');
        if ($phone_verification && !$user->is_phone_verified) {

//            SMS_module::send($user->phone, $token);

            $data = [
                "api_key" => "R2000263639ebd62451268.51442360",
                "type" => "text",
                "contacts" => $user->phone,
                "senderid" => "8809601004769",
                "msg" => $token,
            ];
            Http::get('http://isms.mimsms.com/smsapi', $data );
            $response = translate('please_check_your_SMS_for_OTP');
            Toastr::success($response);
        }

        return view('seller-views.auth.verify', compact('user'));
    }

    public static function verify(Request $request)
    {
        Validator::make($request->all(), [
            'token' => 'required',
        ]);

        $email_status = BusinessSetting::where('type', 'email_verification')->first()->value;
        $phone_status = BusinessSetting::where('type', 'phone_verification')->first()->value;

        $user = Seller::find($request->id);
        $verify = PhoneOrEmailVerification::where(['phone_or_email' => $user->phone, 'token' => $request['token']])->first();

        if ($email_status == 1 || ($email_status == 0 && $phone_status == 0)) {
            if (isset($verify)) {
                try {
                    $user->is_email_verified = 1;
                    $user->save();
                    $verify->delete();
                } catch (\Exception $exception) {
                    Toastr::info('Try again');
                }

                Toastr::success(translate('verification_done_successfully'));

            } else {
                Toastr::error(translate('Verification_code_or_OTP mismatched'));
                return redirect()->back();
            }

        } else {
            if (isset($verify)) {
                try {
                    $user->is_phone_verified = 1;
                    $user->save();
                    $verify->delete();
                } catch (\Exception $exception) {
                    Toastr::info('Try again');
                }

                Toastr::success('Verification Successfully Done');
            } else {
                Toastr::error('Verification code/ OTP mismatched');
            }

        }

        return redirect(route('seller.auth.login'));
    }
}
