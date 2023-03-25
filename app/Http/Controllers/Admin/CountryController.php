<?php

namespace App\Http\Controllers\Admin;

use App\Model\Country;
use Illuminate\Http\Request;
use App\CPU\Helpers;
use App\CPU\ImageManager;
use App\Http\Controllers\Controller;
use App\Model\Admin;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use App\Model\Translation;

class CountryController extends Controller
{
    public function add_new()
    {
        $br = Country::latest()->paginate(Helpers::pagination_limit());
        return view('admin-views.countries.add-new', compact('br'));
    }

    public function store(Request $request)
    {
        $country = new Country;
        $country->en_name = $request->name[array_search('en', $request->lang)];
        $country->bn_name = $request->name[array_search('en', $request->lang)];
        $country->status = 1;
        $country->save();

        
        Toastr::success('Country added successfully!');
        return back();
    }

    function list(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search'))
        {
            $key = explode(' ', $request['search']);
            $br = Country::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->Where('en_name', 'like', "%{$value}%");
                }
            });
            $query_param = ['search' => $request['search']];
        }else{
            $br = new Country();
        }
        $br = $br->latest()->paginate(Helpers::pagination_limit())->appends($query_param);
        return view('admin-views.countries.list', compact('br','search'));
    }

    public function edit($id)
    {
        $country = Country::where(['id' => $id])->withoutGlobalScopes()->first();
        return view('admin-views.countries.edit', compact('country'));
    }

    public function update(Request $request, $id)
    {

        $country = Country::find($id);
        $country->en_name = $request->name[array_search('en', $request->lang)];
         
        $country->save();
         

        Toastr::success('Country updated successfully!');
        return back();
    }

    public function delete(Request $request)
    {
        $translation = Translation::where('translationable_type','App\Model\Brand')
                                    ->where('translationable_id',$request->id);
        $translation->delete();
        $country = Country::find($request->id);
        $country->delete();
        return response()->json();
    }
}
