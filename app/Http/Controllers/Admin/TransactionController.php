<?php

namespace App\Http\Controllers\Admin;

use App\CPU\Helpers;
use App\Model\Order;
use App\Model\AdminWallet;
use App\Model\Transaction;
use App\Model\SellerWallet;
use Illuminate\Http\Request;
use App\Model\OrderTransaction;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    public function list(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $transactions = OrderTransaction::with(['seller', 'customer'])->where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('order_id', 'like', "%{$value}%")
                        ->orWhere('transaction_id', 'like', "%{$value}%");
                }
            });
            $query_param = ['search' => $request['search']];
        } else {
            $transactions = OrderTransaction::with(['seller', 'customer']);
        }
        $status = $request['status'];
        if ($request->has('status')) {
            $key = explode(' ', $request['status']);
            $transactions = $transactions->where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->Where('status', 'like', "%{$value}%");
                }
            });
            $query_param = ['status' => $request['status']];
        }

        $transactions = $transactions->latest()->paginate(Helpers::pagination_limit())->appends($query_param);
        return view('admin-views.transaction.list', compact('transactions', 'search', 'status'));
    }

    public function statusUpdate(Request $request, OrderTransaction $transaction)
    {
        if ($request->status == 'disburse') {

            $order = Order::find($transaction->order_id);
            $order_summary = \App\CPU\OrderManager::order_summary($order);
            $order_amount = $order_summary['subtotal'] - $order_summary['total_discount_on_product'] - $order['discount_amount'];
            $commission = Helpers::sales_commission($order);
            $shipping_model = Helpers::get_business_settings('shipping_method');

            $wallet = AdminWallet::where('admin_id', 1)->first();
            $wallet->commission_earned += $commission;
            if ($shipping_model == 'inhouse_shipping') {
                $wallet->delivery_charge_earned += $order['shipping_cost'];
            }
            $wallet->save();

            if ($order['seller_is'] == 'admin') {
                $wallet = AdminWallet::where('admin_id', 1)->first();
                $wallet->inhouse_earning += $order_amount;
                if ($shipping_model == 'sellerwise_shipping') {
                    $wallet->delivery_charge_earned += $order['shipping_cost'];
                }
                $wallet->total_tax_collected += $order_summary['total_tax'];
                $wallet->save();
            } else {
                $wallet = SellerWallet::where('seller_id', $order['seller_id'])->first();
                $wallet->commission_given += $commission;
                $wallet->total_tax_collected += $order_summary['total_tax'];

                if ($shipping_model == 'sellerwise_shipping') {
                    $wallet->delivery_charge_earned += $order['shipping_cost'];
                    $wallet->collected_cash += $order['order_amount']; //total order amount
                } else {
                    $wallet->total_earning += ($order_amount - $commission) + $order_summary['total_tax'];
                }

                $wallet->save();
            }

            $transaction->status = 'disburse';
            $transaction->save();
            toastr()->success('Comission has been distributed', 'Accepted successfully');
        } else {
            $transaction->status = 'rejected';
            $transaction->save();
            toastr()->warning('Comissions are not distributed', 'Request rejected');
        }

        return back();
    }
}
