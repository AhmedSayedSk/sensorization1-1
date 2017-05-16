<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Countries;

class EditSuperAdminInfoRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $regex = "~^[A-Za-z0-9\(-_.)\s]{1,9999}$~iu";

        return [
            'name' => "required|min:3|max:255|regex:$regex",
            'email' => "required|email|max:255|regex:$regex",
            'change_password' => "required|boolean",
            'old_password' => "required_if:change_password,1|numeric",
            'new_password' => "required_if:change_password,1|numeric|min:6|confirmed",
        ];
    }
}
