<?php

namespace App\Http\Controllers\Seller;

use App\CPU\ImageManager;
use App\Http\Controllers\Controller;
use App\Model\Shop;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Model\City;
use App\Model\Seller;

class ShopController extends Controller
{
    public function view()
    {

        // $shop = Shop::where(['seller_id' => auth('seller')->id()])->first();
        // if (isset($shop) == false) {
        //     DB::table('shops')->insert([
        //         'seller_id' => auth('seller')->id(),
        //         'name' => auth('seller')->user()->f_name,
        //         'address' => '',
        //         'contact' => auth('seller')->user()->phone,
        //         'image' => 'def.png',
        //         'created_at' => now(),
        //         'updated_at' => now()
        //     ]);
        //     $shop = Shop::where(['seller_id' => auth('seller')->id()])->first();

        // }

        $shop = Shop::where(['seller_id' =>  auth('seller')->id()])->first();
        $seller = Seller::findOrFail($shop->seller_id);
        $cities = City::all();

        return view('seller-views.shop.shopInfo', compact('shop','seller','cities',));
    }

    public function edit($id)
    {

        $shop = Shop::where(['seller_id' =>  auth('seller')->id()])->first();
        $seller = Seller::find($shop->seller_id);

        $cities = City::all();
        return view('seller-views.shop.edit', compact('shop','cities','seller'));
    }

    public function update(Request $request, $id)
    {

        $shop = Shop::find($id);
        $shop->owner_name = $request->owner_name;
        $shop->address = $request->address;
        $shop->save();


       $seller = Seller::findOrFail($shop->seller_id);
       $seller->shop_name =$request->shop_name;
       $seller->f_name =$request->f_name;
       $seller->l_name =$request->l_name;
       $seller->l_name =$request->l_name;
       $seller->email =$request->email;
       $seller->email =$request->email;
       $seller->phone =$request->phone;
       $seller->phone =$request->phone;
       $seller->holiday_mode =$request->holiday_mode;
       $seller->holiday_mode_period_start =$request->holiday_mode_period_start;
       $seller->holiday_mode_period_end =$request->holiday_mode_period_end;
       $seller->city =$request->city;
       $seller->country =$request->country;
       $seller->in_charge_name =$request->in_charge_name;
       $seller->business_registration_number =$request->business_registration_number;
       $seller->nid_number =$request->nid_number;
       $seller->division =$request->division;
       $seller->postcode =$request->postcode;
       $seller->id_type =$request->id_type;
       $seller->account_type =$request->account_type;
       $seller->bkash_name = $request->bkash_name;
       $seller->bkash_number =$request->bkash_number;
       $seller->holder_name =$request->holder_name;
       $seller->account_no =$request->account_no;
       $seller->bank_name =$request->bank_name;
       $seller->branch =$request->branch;
       $seller->bank_routing =$request->bank_routing;
       $seller->war_full_name =$request->war_full_name;
       $seller->war_address =$request->war_address;
       $seller->war_phone =$request->war_phone;
       $seller->war_city_town =$request->war_city_town;
       $seller->war_country =$request->war_country;
       $seller->war_division =$request->war_division;
       $seller->war_city =$request->war_city;
       $seller->war_postcode =$request->war_postcode;

       $seller->return_copy_from_warehouse = $request->return_copy_from_warehouse;

       $seller->return_full_name = $request->return_copy_from_warehouse == 'yes' ? $request->war_full_name : $request->return_full_name;
       $seller->return_address   = $request->return_copy_from_warehouse == 'yes' ? $request->war_address : $request->return_address;
       $seller->return_phone     = $request->return_copy_from_warehouse == 'yes' ? $request->war_phone : $request->return_phone;
       $seller->return_city_town = $request->return_copy_from_warehouse == 'yes' ? $request->war_city_town : $request->return_city_town;
       $seller->return_country   = $request->return_copy_from_warehouse == 'yes' ? $request->war_country : $request->return_country;
       $seller->return_division  = $request->return_copy_from_warehouse == 'yes' ? $request->war_division : $request->return_division;
       $seller->return_city      = $request->return_copy_from_warehouse == 'yes' ? $request->war_city : $request->return_city;
       $seller->return_postcode  = $request->return_copy_from_warehouse == 'yes' ? $request->war_postcode : $request->return_postcode;

        if ($request->hasFile('business_registration_number')) {
            // if(!empty($seller->business_registration_number)) {
            //     unlink(public_path($seller->business_registration_number));
            // }
            $photo_name = time().rand().'.'.$request->business_registration_number->extension();
            $request->business_registration_number->move(public_path('uploads/nid/'), $photo_name);
            $seller->business_registration_number = 'public/uploads/nid/'. $photo_name;
        }

       if ($request->hasFile('id_front_side')) {
            // if($seller->id_front_side) {
            //     unlink(public_path($seller->id_front_side));
            // }
            $photo_name = time().rand().'.'.$request->id_front_side->extension();
            $request->id_front_side->move(public_path('uploads/nid/'), $photo_name);
            $seller->id_front_side = 'public/uploads/nid/'. $photo_name;
        }

        if ($request->hasFile('id_back_side')) {
            // if($seller->id_back_side) {
            //     unlink(public_path($seller->id_back_side));
            // }
            $photo_name = time().rand().'.'.$request->id_back_side->extension();
            $request->id_back_side->move(public_path('uploads/nid/'), $photo_name);
            $seller->id_back_side = 'public/uploads/nid/'. $photo_name;
        }


        if($request->hasFile('cheque_copy')) {
            if($seller->cheque_copy) {
                unlink(public_path($seller->cheque_copy));
            }
            $photo_name = time().rand().'.'.$request->cheque_copy->extension();
            $request->cheque_copy->move(public_path('uploads/cheque/'), $photo_name);
            $seller->cheque_copy = 'public/uploads/cheque/'. $photo_name;
        }

        $seller->save();

        Toastr::info('Shop updated successfully!');
        return redirect()->route('seller.shop.view');
    }

}
