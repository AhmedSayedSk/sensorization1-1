<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\AddAdminsRequest;
use App\Http\Requests\RolesRequest;
use App\Http\Requests\SiteSettingRequest;
use App\Http\Controllers\Controller;

use App\User;
use App\Models\Admin\Role;
use App\Models\Admin\Admin;
use App\Models\Product\Product;
use App\Models\Admin\Permission;

use DB;
use Auth;
use Hash;
use Storage;
use Session;

class superAdminController extends Controller
{
    public function __construct(){
        $this->middleware('authenticated:super_admin');
    }

    public function getEditSuperAdmin(){
        $super_admin = User::find(Auth::user()->id);
        return view('back.edit-super-admin')->withSuper_admin($super_admin);
    }

    public function postEditSuperAdmin(EditSuperAdminInfoRequest $request){
        $input = (object) $request->all();

        $superAdmin = User::find(Auth::user()->id);
        $superAdmin->name = $input->name;
        $superAdmin->email = $input->email;

        if($input->change_password == 1){
            if(!Hash::check($input->old_password, $superAdmin->value('password'))){
                return back()->withErrors(["invalid old password."]); 
            } else {
                $superAdmin->password = bcrypt($input->new_password);
            }
        }

        $superAdmin->save();

        Session::flash('message', [
            "type" => "success",
            "content" => "Information was Updated successfully."
        ]);

        return back();
    }

    public function getSiteSetting(){
        $site_setting = json_decode(Storage::get("setting.json"));

        $newStatusTimeOff = trans('admin_setting.timeOff');
        $currencies = trans('admin_setting.currencies');

        return view('back.site-setting')->with(compact(
            'site_setting', 'currencies', 'newStatusTimeOff'
        ));
    }

    public function postSiteSetting(SiteSettingRequest $request){
        $inputs = (object) $request->all();

        $data1 = json_decode(Storage::get("setting.json"));

        $data1->site_name = $inputs->site_name;
        $data1->site_category = $inputs->site_category;
        $data1->customer_service_number = $inputs->customer_service_number;
        $data1->main_currency = $inputs->main_currency;
        $data1->newStatusTimeOff = $inputs->newStatusTimeOff;

        $data2 = json_encode($data1);
        Storage::put("setting.json", $data2);

        Session::flash('flashMessage', [
            "type" => "success",
            "content" => trans('admin_panel.ASSP.T10')
        ]);

        return back();
    }
}
