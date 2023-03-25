<?php

namespace App\Http\Controllers\Admin;

use App\Model\Country;
use App\Model\City;
use Illuminate\Http\Request;
use App\CPU\Helpers;
use App\CPU\ImageManager;
use App\Http\Controllers\Controller;
use App\Model\Admin;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use App\Model\Translation;

class CityController extends Controller
{
    public function add_new()
    {
        $countries = Country::latest()->get();
        return view('admin-views.cities.add-new', compact('countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required',
            'country_id'    => 'required',
        ]);
        
        $city = new City;
        $city->country_id   = $request->country_id[array_search('en', $request->lang)];
        $city->en_name      = $request->name;
        $city->bn_name      = $request->name;
        $city->status       = 1;
        $city->save();

        
        Toastr::success('City added successfully!');
        return back();
    }

    function list(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search'))
        {
            $key = explode(' ', $request['search']);
            $cities = City::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->Where('en_name', 'like', "%{$value}%");
                }
            });
            $query_param = ['search' => $request['search']];
        }else{
            $cities = new City();
        }
        $cities = $cities->latest()->paginate(Helpers::pagination_limit())->appends($query_param);
        return view('admin-views.cities.list', compact('cities','search'));
    }

    public function edit($id)
    {
        $countries = Country::latest()->get();
        $city = City::where(['id' => $id])->withoutGlobalScopes()->first();
        return view('admin-views.cities.edit', compact('city','countries'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'en_name'       => 'required',
            'country_id'    => 'required',
        ]);

        $city = City::find($id);
        $city->country_id = $request->country_id[array_search('en', $request->lang)];
        $city->en_name = $request->name[array_search('en', $request->lang)];
        $city->save();
         

        Toastr::success('City updated successfully!');
        return back();
    }

    public function delete(Request $request)
    {
        $translation = Translation::where('translationable_type','App\Model\Brand')
                                    ->where('translationable_id',$request->id);
        $translation->delete();
        $city = City::find($request->id);
        $city->delete();
        return response()->json();
    }
}
