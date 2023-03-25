<?php

namespace App\Http\Controllers\Seller;

use App\CPU\Helpers;
use App\Http\Controllers\Controller;
use App\Model\OrderTransaction;
use App\Model\Transaction;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

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

        $transactions = $transactions->where('seller_id', auth('seller')->id())->latest()->paginate(Helpers::pagination_limit())->appends($query_param);
        return view('seller-views.transaction.list', compact('transactions', 'search', 'status'));
    }

    public function make_invoice(Request $request)
    {
        $transactions = OrderTransaction::where('status', 'pending')->findMany($request->ids);

        if ($transactions->count()) {
            foreach ($transactions as $transaction) {
                if ($transaction->status != 'pending') continue;
                $transaction->status = 'requested';
                $transaction->save();
            }
            Toastr::success('Invoice generated');
        } else {
            Toastr::error('you can generate only pending invoices', 'invalid selection');
        }

        return back();
    }
}
