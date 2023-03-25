<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Http\Controllers\Controller;
use App\Model\Seller;
use App\Model\SellerWallet;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Gregwar\Captcha\CaptchaBuilder;
use App\CPU\Helpers;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:seller', ['except' => ['logout']]);
    }

    public function login()
    {

        return view('seller-views.auth.login');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required|min:6'
        ]);
        //recaptcha validation
        // $recaptcha = Helpers::get_business_settings('recaptcha');
        // if (isset($recaptcha) && $recaptcha['status'] == 1) {
        //     try {
        //         $request->validate([
        //             'g-recaptcha-response' => [
        //                 function ($attribute, $value, $fail) {
        //                     $secret_key = Helpers::get_business_settings('recaptcha')['secret_key'];
        //                     $response = $value;
        //                     $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . $secret_key . '&response=' . $response;
        //                     $response = \file_get_contents($url);
        //                     $response = json_decode($response);
        //                     if (!$response->success) {
        //                         $fail(\App\CPU\translate('ReCAPTCHA Failed'));
        //                     }
        //                 },
        //             ],
        //         ]);
        //     } catch (\Exception $exception) {}
        // } else if ($recaptcha['status'] == 0) {
        //     $builder = new CaptchaBuilder();
        //     $builder->setPhrase(session()->get('custome_recaptcha'));
        //     if (!$builder->testPhrase($request->custome_recaptcha)) {
        //         Toastr::error(\App\CPU\translate('ReCAPTCHA Failed'));
        //         return back();
        //     }
        // }

//        $se = Seller::where(['email' => $request['email']])->first(['status']);
        $se = Seller::where(['email' => $request['email']])->orWhere(['phone' => $request['email']])->first();
        if ($se == !null){
            if ($se->is_phone_verified == 1){
                if (isset($se) && auth('seller')->attempt(['email' => $se->email, 'password' => $request->password], $request->remember)) {
                    Toastr::info('Welcome to your dashboard!');
                    if (SellerWallet::where('seller_id', auth('seller')->id())->first() == false) {
                        DB::table('seller_wallets')->insert([
                            'seller_id' => auth('seller')->id(),
                            'withdrawn' => 0,
                            'commission_given' => 0,
                            'total_earning' => 0,
                            'pending_withdraw' => 0,
                            'delivery_charge_earned' => 0,
                            'collected_cash' => 0,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                    return redirect()->route('seller.dashboard.index');
                } elseif (isset($se) && $se['status'] == 'suspended') {
                    return redirect()->back()->withInput($request->only('email', 'remember'))
                        ->withErrors(['Your account has been suspended!.']);
                }
            }else{
                return redirect()->route('shop.seller.check', [$se->id]);
            }
        }

        return redirect()->back()->withInput($request->only('email', 'remember'))
            ->withErrors(['Credentials does not match.']);
    }

    public function logout(Request $request)
    {
        auth()->guard('seller')->logout();

        $request->session()->invalidate();

        return redirect()->route('seller.auth.login');
    }
}
