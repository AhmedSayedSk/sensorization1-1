<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EditNormalAdminRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $regex = "~^[A-Za-z0-9\(-_.)\s]{1,9999}$~iu";

        return [
            "user_name" => "required|min:5|max:255|regex:$regex",
            //'user_email' => "required|email|max:255|regex:$regex",
        ];
    }
}
