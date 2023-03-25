<?php

namespace App\Http\Controllers\Seller;

use App\CPU\ImageManager;
use App\Http\Controllers\Controller;
use App\Model\Seller;
use App\Model\Shop;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use function App\CPU\translate;

class ProfileController extends Controller
{
    public function view()
    {
        $data = Seller::where('id', auth('seller')->id())->first();
        return view('seller-views.profile.view', compact('data'));
    }

    public function edit($id)
    {
        if (auth('seller')->id() != $id) {
            Toastr::warning(translate('you_can_not_change_others_profile'));
            return back();
        }
        $data = Seller::where('id', auth('seller')->id())->first();
        $shopData = Shop::where('seller_id', auth('seller')->id())->first();
        return view('seller-views.profile.edit', compact('data','shopData'));
    }

    public function update(Request $request, $id)
    {
        $seller = Seller::find(auth('seller')->id());
        $seller->f_name         = $request->f_name;
        $seller->l_name         = $request->l_name;
        $seller->phone          = $request->phone;
        $seller->nid_number     = $request->nid_number;


        if ($request->image) {
            $seller->image = ImageManager::update('seller/', $seller->image, 'png', $request->file('image'));
        }

        if ($request->nid_front) {
            $seller->nid_front = ImageManager::update('seller/', $seller->nid_front, 'png', $request->file('nid_front'));
        }

        if ($request->nid_back) {
            $seller->nid_back = ImageManager::update('seller/', $seller->nid_back, 'png', $request->file('nid_back'));
        }

        $seller->save();

        Toastr::info('Profile updated successfully!');
        return back();
    }
    
    public function shop_image_update(Request $request)
    {
        $shopImage = Shop::where('seller_id', auth('seller')->id())->first();
        if ($request->shop) {
            $shopImage->image = ImageManager::update('shop/', $shopImage->image, 'png', $request->file('shop'));
        }
        if ($request->banner) {
            $shopImage->banner = ImageManager::update('shop/banner/', $shopImage->banner, 'png', $request->file('banner'));
        }
        $shopImage->save();

        Toastr::info('Shop image updated successfully!');
        return back();
    }

    public function settings_password_update(Request $request)
    {
        $request->validate([
            'password' => 'required|same:confirm_password|min:8',
            'confirm_password' => 'required',
        ]);

        $seller = Seller::find(auth('seller')->id());
        $seller->password = bcrypt($request['password']);
        $seller->save();
        Toastr::success('Seller password updated successfully!');
        return back();
    }

    public function bank_update(Request $request, $id)
    {
        $bank = Seller::find(auth('seller')->id());
        $bank->bank_name = $request->bank_name;
        $bank->branch = $request->branch;
        $bank->bank_routing = $request->bank_routing;
        $bank->holder_name = $request->holder_name;
        $bank->account_no = $request->account_no;
        $bank->save();
        Toastr::success('Bank Info updated');
        return redirect()->route('seller.profile.view');
    }

    public function bank_edit($id)
    {
        if (auth('seller')->id() != $id) {
            Toastr::warning(translate('you_can_not_change_others_info'));
            return back();
        }
        $data = Seller::where('id', auth('seller')->id())->first();
        return view('seller-views.profile.bankEdit', compact('data'));
    }

}
