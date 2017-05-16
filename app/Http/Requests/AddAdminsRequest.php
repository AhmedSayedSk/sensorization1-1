<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Countries;

class AddAdminsRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $regex = "~^[A-Za-z0-9\(-_.)\s]{1,9999}$~iu";

        return [
            'name' => "required|max:255|regex:$regex",
            'email' => "required|email|max:255|unique:users|regex:$regex",
            'password' => 'required|min:6|confirmed',
        ];
    }
}
