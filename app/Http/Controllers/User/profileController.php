<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\EditUserProfileDataRequest;
use App\Http\Controllers\Controller;

use App\User;
use App\Models\Countries;

use Auth;

class profileController extends Controller
{
    public function __construct(){
        // return message if the user don't make login 
        $this->middleware("auth:,warning,You must make login first before you see your profile.");
    }

    public function getIndex(){
    	$user = User::find(Auth::user()->id);
    	return view("front.$this->frontendNumber.user.profile.dashboard")->with('user', $user);
    }

    public function getEditMyInformation(){
    	$user = User::find(Auth::user()->id);
    	$countries = Countries::lists('name', 'id');
 
    	return view("front.$this->frontendNumber.user.profile.edit")->with(compact(
            'user', 'countries'
        ));
    }

    public function postUpdateInformation(EditUserProfileDataRequest $request){
    	$input = (object) $request->all();

    	$user = User::find(Auth::user()->id);
    	$user->name = $input->name;
    	$user->country_id = $input->country_id;
    	$user->address = $input->address;
    	$user->save();

    	if($request->session()->has('payment_address')) {
    		$request->session()->forget('payment_address');
    		return redirect('/my-cart');
    	} else {
            $request->session()->flash('flashMessage', [
                "type" => "success",
                "content" => trans("frontend.$this->frontendNumber.UP.EI.T8")
            ]);
    		return back();
    	}
    }
}
