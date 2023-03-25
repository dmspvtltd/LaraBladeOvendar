<?php

namespace App\Http\Controllers\Admin;

use App\Model\City;
use App\Model\Shop;
use App\CPU\Convert;
use App\CPU\Helpers;
use App\Model\Order;
use App\Model\Review;
use App\Model\Seller;
use App\Model\Product;
use App\CPU\ImageManager;
use App\CPU\BackEndHelper;
use App\Model\OrderDetail;
use App\Model\SellerWallet;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Model\WithdrawRequest;
use App\Model\OrderTransaction;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class SellerController extends Controller
{
    public function index(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $sellers = Seller::with(['orders', 'product'])
                ->where(function ($q) use ($key) {
                    foreach ($key as $value) {
                        $q->orWhere('f_name', 'like', "%{$value}%")
                            ->orWhere('l_name', 'like', "%{$value}%")
                            ->orWhere('phone', 'like', "%{$value}%")
                            ->orWhere('email', 'like', "%{$value}%");
                    }
                });
            $query_param = ['search' => $request['search']];
        } else {
            $sellers = Seller::with(['orders', 'product']);
        }
        $sellers = $sellers->latest()->paginate(Helpers::pagination_limit())->appends($query_param);
        return view('admin-views.seller.index', compact('sellers', 'search'));
    }
    

    public function destroy($id)
        {
            $delete = Seller::find($id);
            $delete->delete();
            return back();
            Toastr::success('Inactiv seller delete Successfully');
        }


    public function view(Request $request, $id, $tab = null)
    {
       
        $seller = Seller::findOrFail($id);
        $shop = Shop::where('seller_id',$seller->id)->first();
        if ($tab == 'order') {
            $id = $seller->id;
            $orders = Order::where(['seller_is'=>'seller'])->where(['seller_id'=>$id])->latest()->paginate(Helpers::pagination_limit());
            // $orders->map(function ($data) {
            //     $value = 0;
            //     foreach ($data->details as $detail) {
            //         $value += ($detail['price'] * $detail['qty']) + $detail['tax'] - $detail['discount'];
            //     }
            //     $data['total_sum'] = $value;
            //     return $data;
            // });
            return view('admin-views.seller.view.order', compact('seller', 'orders'));
        } else if ($tab == 'product') {
            $products = Product::where('added_by', 'seller')->where('user_id', $seller->id)->paginate(Helpers::pagination_limit());
            return view('admin-views.seller.view.product', compact('seller', 'products'));
        } else if ($tab == 'setting') {
            $commission = $request['commission'];
            if ($request->has('commission')) {
                request()->validate([
                    'commission' => 'required | numeric | min:1',
                ]);

                if ($request['commission_status'] == 1 && $request['commission'] == null) {
                    Toastr::error('You did not set commission percentage field.');
                    //return back();
                } else {
                    $seller = Seller::find($id);
                    $seller->sales_commission_percentage = $request['commission_status'] == 1 ? $request['commission'] : null;
                    $seller->save();

                    Toastr::success('Commission percentage for this seller has been updated.');
                }
            }
            $commission = 0;
            if ($request->has('gst')) {
                if ($request['gst_status'] == 1 && $request['gst'] == null) {
                    Toastr::error('You did not set GST number field.');
                    //return back();
                } else {
                    $seller = Seller::find($id);
                    $seller->gst = $request['gst_status'] == 1 ? $request['gst'] : null;
                    $seller->save();

                    Toastr::success('GST number for this seller has been updated.');
                }
            }

            //return back();
            return view('admin-views.seller.view.setting', compact('seller'));
        } else if ($tab == 'transaction') {
            $transactions = OrderTransaction::where('seller_is','seller')->where('seller_id',$seller->id);

            $query_param = [];
            $search = $request['search'];
            if ($request->has('search'))
            {
                $key = explode(' ', $request['search']);
                $transactions = $transactions->where(function ($q) use ($key) {
                    foreach ($key as $value) {
                        $q->Where('order_id', 'like', "%{$value}%")
                            ->orWhere('transaction_id', 'like', "%{$value}%");
                    }
                });
                $query_param = ['search' => $request['search']];
            }else{
                $transactions = $transactions;
            }
            $status = $request['status'];
            if ($request->has('status'))
            {
                $key = explode(' ', $request['status']);
                $transactions = $transactions->where(function ($q) use ($key) {
                    foreach ($key as $value) {
                        $q->Where('status', 'like', "%{$value}%");
                    }
                });
                $query_param = ['status' => $request['status']];
            }
               $transactions = $transactions->latest()->paginate(Helpers::pagination_limit())->appends($query_param);

            return view('admin-views.seller.view.transaction', compact('seller', 'transactions','search','status'));

        } else if ($tab == 'review') {
            $sellerId = $seller->id;

            $query_param = [];
            $search = $request['search'];
            if ($request->has('search')) {
                $key = explode(' ', $request['search']);
                $product_id = Product::where('added_by','seller')->where('user_id',$sellerId)->where(function ($q) use ($key) {
                    foreach ($key as $value) {
                        $q->where('name', 'like', "%{$value}%");
                    }
                })->pluck('id')->toArray();

                $reviews = Review::with(['product'])
                    ->whereIn('product_id',$product_id);

                $query_param = ['search' => $request['search']];
            } else {
                $reviews = Review::with(['product'])->whereHas('product', function ($query) use ($sellerId) {
                    $query->where('user_id', $sellerId)->where('added_by', 'seller');
                });
            }
            //dd($reviews->count());
            $reviews = $reviews->paginate(Helpers::pagination_limit())->appends($query_param);

            return view('admin-views.seller.view.review', compact('seller', 'reviews', 'search'));
        }
        return view('admin-views.seller.view', compact('seller','shop'));
    }

    public function sellerEdit($id){
        $shop = Shop::findOrFail($id);
        $seller = Seller::findOrFail($shop->seller_id);
        $cities = City::all();

        return view('admin-views.seller.edit', compact('shop','seller','cities',));
    }

    public function sellerUpdate(Request $request, $id)
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
        return redirect()->route('admin.sellers.view',$seller->id);
    }

    public function updateStatus(Request $request)
    {
        $order = Seller::findOrFail($request->id);
        $order->status = $request->status;
        if ($request->status == "approved") {
            Toastr::success('Seller has been approved successfully');
        } else if ($request->status == "rejected") {
            Toastr::info('Seller has been rejected successfully');
        } else if ($request->status == "suspended") {
            $order->auth_token = Str::random(80);
            Toastr::info('Seller has been suspended successfully');
        }
        $order->save();
        return back();
    }

    public function order_list($seller_id)
    {
        $orders = Order::where('seller_id', $seller_id)->where('seller_is', 'seller');

        $orders = $orders->latest()->paginate(Helpers::pagination_limit());
        $seller = Seller::findOrFail($seller_id);
        return view('admin-views.seller.order-list', compact('orders', 'seller'));
    }

    public function product_list($seller_id)
    {
        $product = Product::where(['user_id' => $seller_id, 'added_by' => 'seller'])->latest()->paginate(Helpers::pagination_limit());
        $seller = Seller::findOrFail($seller_id);
        return view('admin-views.seller.porduct-list', compact('product', 'seller'));
    }

    public function order_details($order_id, $seller_id)
    {
        $order = Order::with('shipping')->where(['id' => $order_id])->first();
        return view('admin-views.seller.order-details', compact('order', 'seller_id'));
    }

    public function withdraw()
    {
        $all = session()->has('withdraw_status_filter') && session('withdraw_status_filter') == 'all' ? 1 : 0;
        $active = session()->has('withdraw_status_filter') && session('withdraw_status_filter') == 'approved' ? 1 : 0;
        $denied = session()->has('withdraw_status_filter') && session('withdraw_status_filter') == 'denied' ? 1 : 0;
        $pending = session()->has('withdraw_status_filter') && session('withdraw_status_filter') == 'pending' ? 1 : 0;

        $withdraw_req = WithdrawRequest::with(['seller'])
            ->when($all, function ($query) {
                return $query;
            })
            ->when($active, function ($query) {
                return $query->where('approved', 1);
            })
            ->when($denied, function ($query) {
                return $query->where('approved', 2);
            })
            ->when($pending, function ($query) {
                return $query->where('approved', 0);
            })
            ->orderBy('id', 'desc')
            ->latest()
            ->paginate(Helpers::pagination_limit());

        return view('admin-views.seller.withdraw', compact('withdraw_req'));
    }

    public function withdraw_view($withdraw_id, $seller_id)
    {
        $seller = WithdrawRequest::with(['seller'])->where(['id' => $withdraw_id])->first();
        return view('admin-views.seller.withdraw-view', compact('seller'));
    }

    public function withdrawStatus(Request $request, $id)
    {
        $withdraw = WithdrawRequest::find($id);
        $withdraw->approved = $request->approved;
        $withdraw->transaction_note = $request['note'];
        if ($request->approved == 1) {
            SellerWallet::where('seller_id', $withdraw->seller_id)->increment('withdrawn', $withdraw['amount']);
            SellerWallet::where('seller_id', $withdraw->seller_id)->decrement('pending_withdraw', $withdraw['amount']);
            $withdraw->save();
            Toastr::success('Seller Payment has been approved successfully');
            return redirect()->route('admin.sellers.withdraw_list');
        }

        SellerWallet::where('seller_id', $withdraw->seller_id)->increment('total_earning', $withdraw['amount']);
        SellerWallet::where('seller_id', $withdraw->seller_id)->decrement('pending_withdraw', $withdraw['amount']);
        $withdraw->save();
        Toastr::info('Seller Payment request has been Denied successfully');
        return redirect()->route('admin.sellers.withdraw_list');

    }

    public function sales_commission_update(Request $request, $id)
    {
        if ($request['status'] == 1 && $request['commission'] == null) {
            Toastr::error('You did not set commission percentage field.');
            return back();
        }

        $seller = Seller::find($id);
        $seller->sales_commission_percentage = $request['status'] == 1 ? $request['commission'] : null;
        $seller->save();

        Toastr::success('Commission percentage for this seller has been updated.');
        return back();
    }
}
