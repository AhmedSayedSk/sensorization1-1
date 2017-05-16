<?php

namespace App\Http\Controllers\Admin\Clients;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Admin\Admin;
use Auth;

class usersController extends Controller
{
    public function __construct(){
        $this->middleware('admin_function:delete_users', ['only' => 'destroy']);
    }

    public function index(){
        $forbidden_ids = Admin::lists('user_id');
        $users = User::whereNotIn('id', $forbidden_ids)->paginate(50);
    	return view('back.clients.users.view')->withUsers($users);
    }

    public function destroy($id){
    	if(Auth::user()->id != $id){
    		User::destroy($id);
    	}
    	return back();
    }
}
